@extends('admin.layouts.master')

@section('title')
    Record Wallet Transaction - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4><i class="ri-add-line me-1"></i> Record Customer Wallet Transaction</h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.wallet-transactions.index') }}">Wallet Transactions</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Transaction Details</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.wallet-transactions.store') }}">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Customer <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-control" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" {{ old('user_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }} ({{ $c->mobile }}) — Balance: ₹{{ number_format($c->wallet_balance, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Transaction Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option value="Credit">Credit (Add Balance)</option>
                                <option value="Debit">Debit (Deduct Balance)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Amount (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="1" min="1" name="amount" class="form-control" placeholder="500" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Transaction Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Milestone Bonus / Referral Reward" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description / Remarks</label>
                            <input type="text" name="description" class="form-control" placeholder="Optional notes for customer">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i> Save Transaction</button>
                    <a href="{{ route('admin.wallet-transactions.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
