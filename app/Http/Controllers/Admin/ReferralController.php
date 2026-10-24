<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ReferralDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\CustomerNotification;
use App\Models\Referral;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class ReferralController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('permission:referrals.index')->only(['index']);
        $this->middleware('permission:referrals.create')->only(['create', 'store']);
        $this->middleware('permission:referrals.edit')->only(['edit', 'update']);
        $this->middleware('permission:referrals.view')->only(['show']);
        $this->middleware('permission:referrals.delete')->only(['destroy']);
    }

    public function index(ReferralDataTable $referralDataTable)
    {
        return $referralDataTable->render('admin.referrals.index');
    }

    public function show(Referral $referral)
    {
        $referral->load('referrer');
        return view('admin.referrals.show', compact('referral'));
    }

    public function update(Request $request, Referral $referral)
    {
        $request->validate([
            'stage' => 'required|in:Pending,Contacted,Site Survey Done,Quotation Shared,Installed,Rejected',
            'reward_amount' => 'nullable|numeric|min:0',
            'reward_status' => 'required|in:Pending,Credited,None',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();

        $oldRewardStatus = $referral->reward_status;
        $referral->stage = $request->stage;
        if ($request->has('reward_amount') && $request->reward_amount !== null) {
            $referral->reward_amount = $request->reward_amount;
        }
        $referral->reward_status = $request->reward_status;
        $referral->notes = $request->notes;
        $referral->save();

        $referrer = $referral->referrer;

        if ($referrer) {
            if ($request->reward_status === 'Credited' && $referral->reward_amount > 0) {
                $tx = WalletTransaction::firstOrNew([
                    'reference_type' => 'Referral',
                    'reference_id' => $referral->id,
                ]);

                $tx->user_id = $referrer->id;
                $tx->type = 'Credit';
                $tx->amount = $referral->reward_amount;
                $tx->title = 'Referral Reward — ' . $referral->referee_name;
                $tx->description = 'Reward for referral ' . $referral->referee_name . ($referral->stage == 'Installed' ? ' (Solar Installed)' : '');
                $tx->status = 'Credited';
                $tx->save();

                if ($oldRewardStatus !== 'Credited') {
                    CustomerNotification::create([
                        'user_id' => $referrer->id,
                        'title' => 'Referral Reward Credited: ₹' . number_format($referral->reward_amount, 2),
                        'message' => '₹' . number_format($referral->reward_amount, 2) . ' credited to your wallet for referral ' . $referral->referee_name . '.',
                        'type' => 'referral',
                    ]);

                    if ($referrer->email) {
                        \App\MyClasses\MailHelper::sendMail($referrer->email, 'Referral Bonus Credited: ₹' . number_format($referral->reward_amount, 2), 'emails.wallet_credited', [
                            'user' => $referrer,
                            'amount' => $referral->reward_amount,
                            'title' => 'Referral Reward — ' . $referral->referee_name,
                            'description' => 'Reward for referral ' . $referral->referee_name
                        ]);
                    }
                }
            } else {
                // If not credited, remove any wallet transaction for this referral
                WalletTransaction::where('reference_type', 'Referral')
                    ->where('reference_id', $referral->id)
                    ->forceDelete();
            }

            $referrer->recalculateWalletBalance();
        }

        DB::commit();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Referral updated successfully!');

        if ($request->ajax()) {
            return Response::json(['message' => 'Referral updated successfully.', 'back_url' => route('admin.referrals.index')]);
        }

        return redirect()->route('admin.referrals.index');
    }

    public function destroy(Referral $referral)
    {
        DB::beginTransaction();
        $referrer = $referral->referrer;

        // Remove associated wallet transaction
        WalletTransaction::where('reference_type', 'Referral')
            ->where('reference_id', $referral->id)
            ->forceDelete();

        $referral->delete();

        if ($referrer) {
            $referrer->recalculateWalletBalance();
        }
        DB::commit();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Referral deleted successfully!');

        return Response::json(['message' => 'Referral deleted successfully.']);
    }
}
