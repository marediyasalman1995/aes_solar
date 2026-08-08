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
            'stage' => 'required|in:Contacted,Site Survey Done,Quotation Shared,Installed,Rejected',
            'reward_amount' => 'nullable|numeric|min:0',
            'reward_status' => 'required|in:Pending,Credited,None',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();

        $oldStage = $referral->stage;
        $referral->stage = $request->stage;
        $referral->reward_amount = $request->reward_amount ?? $referral->reward_amount;
        $referral->notes = $request->notes;

        // Auto credit on install
        if (($request->stage == 'Installed' || $request->reward_status == 'Credited') && $referral->reward_status != 'Credited' && $referral->reward_amount > 0) {
            $referral->reward_status = 'Credited';
            $referrer = $referral->referrer;

            if ($referrer) {
                $referrer->wallet_balance += $referral->reward_amount;
                $referrer->save();

                WalletTransaction::create([
                    'user_id' => $referrer->id,
                    'type' => 'Credit',
                    'amount' => $referral->reward_amount,
                    'title' => 'Referral Reward — ' . $referral->referee_name,
                    'description' => 'Reward for solar installation by ' . $referral->referee_name,
                    'reference_type' => 'Referral',
                    'reference_id' => $referral->id,
                    'status' => 'Credited',
                ]);

                CustomerNotification::create([
                    'user_id' => $referrer->id,
                    'title' => 'Referral Reward Credited: ₹' . number_format($referral->reward_amount, 2),
                    'message' => '₹' . number_format($referral->reward_amount, 2) . ' credited to your wallet for ' . $referral->referee_name . '\'s solar installation.',
                    'type' => 'referral',
                ]);
            }
        } else {
            $referral->reward_status = $request->reward_status;
        }

        $referral->save();
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
        $referral->delete();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Referral deleted successfully!');

        return Response::json(['message' => 'Referral deleted successfully.']);
    }
}
