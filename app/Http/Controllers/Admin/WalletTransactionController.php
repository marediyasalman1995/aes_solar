<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WalletTransactionDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\CustomerNotification;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class WalletTransactionController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('permission:wallet-transactions.index')->only(['index']);
        $this->middleware('permission:wallet-transactions.create')->only(['create', 'store']);
        $this->middleware('permission:wallet-transactions.edit')->only(['edit', 'update', 'updateStatus']);
        $this->middleware('permission:wallet-transactions.view')->only(['show']);
        $this->middleware('permission:wallet-transactions.delete')->only(['destroy']);
    }

    public function index(WalletTransactionDataTable $walletTransactionDataTable)
    {
        return $walletTransactionDataTable->render('admin.wallet_transactions.index');
    }

    public function create()
    {
        $customers = User::where('user_type', 'customer')->orWhereNull('user_type')->get();
        return view('admin.wallet_transactions.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:Credit,Debit',
            'amount' => 'required|numeric|min:1',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        $user = User::findOrFail($request->user_id);
        $amount = floatval($request->amount);

        if ($request->type == 'Credit') {
            $user->wallet_balance += $amount;
        } else {
            $user->wallet_balance = max(0, $user->wallet_balance - $amount);
        }
        $user->save();

        $tx = WalletTransaction::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'amount' => $amount,
            'title' => $request->title,
            'description' => $request->description ?? 'Admin transaction',
            'reference_type' => 'Manual',
            'status' => 'Credited',
        ]);

        CustomerNotification::create([
            'user_id' => $user->id,
            'title' => 'Wallet ' . $request->type . ': ₹' . number_format($amount, 2),
            'message' => $request->title . ($request->description ? ' (' . $request->description . ')' : ''),
            'type' => 'wallet',
        ]);

        DB::commit();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Wallet transaction recorded successfully!');

        if ($request->ajax()) {
            return Response::json(['message' => 'Wallet transaction recorded successfully.', 'back_url' => route('admin.wallet-transactions.index')]);
        }

        return redirect()->route('admin.wallet-transactions.index');
    }

    public function updateStatus(Request $request, WalletTransaction $walletTransaction)
    {
        $request->validate([
            'status' => 'required|in:Credited,Pending,Approved,Rejected',
        ]);

        DB::beginTransaction();
        $oldStatus = $walletTransaction->status;
        $walletTransaction->status = $request->status;

        // If a Payout request is approved, deduct balance if not yet deducted
        if ($walletTransaction->type == 'Payout' && $request->status == 'Approved' && $oldStatus != 'Approved') {
            $user = $walletTransaction->user;
            if ($user) {
                $user->wallet_balance = max(0, $user->wallet_balance - $walletTransaction->amount);
                $user->save();

                CustomerNotification::create([
                    'user_id' => $user->id,
                    'title' => 'Payout Approved: ₹' . number_format($walletTransaction->amount, 2),
                    'message' => 'Your payout request for ₹' . number_format($walletTransaction->amount, 2) . ' has been approved and disbursed.',
                    'type' => 'wallet',
                ]);
            }
        }

        $walletTransaction->save();
        DB::commit();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Transaction status updated successfully!');

        return redirect()->back();
    }
}
