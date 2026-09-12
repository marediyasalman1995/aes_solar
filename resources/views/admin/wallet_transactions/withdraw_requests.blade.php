@extends('admin.layouts.master')

@section('title')
    Withdrawal Requests — {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4 class="mb-0 text-dark fw-bold">Customer Withdrawal / Payout Requests</h4>
    <span class="text-muted fs-12">Review customer payout requests (Default status: Pending, Min ₹1,000)</span>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.wallet-transactions.index') }}">Wallet Transactions</a></li>
    <li class="breadcrumb-item active">Withdrawal Requests</li>
@endsection

@section('page_buttons')
    <a class="btn btn-outline-primary shadow-sm" href="{{ route('admin.wallet-transactions.index') }}">
        <i class="ri-history-line me-1"></i> All Wallet Transactions
    </a>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        @include('flash::message')
                        @include('admin.wallet_transactions.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
