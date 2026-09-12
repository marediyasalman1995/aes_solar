@extends('emails.layout')
@section('title', 'Admin Alert: New Withdrawal Request')
@section('email_content')
    <h1>💰 New Payout / Withdrawal Request</h1>
    <p>Hello Admin,</p>
    <p>A customer has requested a payout withdrawal from their AES Reward Wallet.</p>
    <div class="card">
        <p><strong>Customer Name:</strong> {{ $user->name }} ({{ $user->mobile }})</p>
        <p><strong>Requested Amount:</strong> <strong style="color: #0284c7; font-size: 18px;">₹{{ number_format($amount, 2) }}</strong></p>
        <p><strong>UPI / Bank Details:</strong> {{ $tx->description }}</p>
        <p><strong>Status:</strong> <span class="badge badge-info">Pending Approval</span></p>
    </div>
    <div style="text-align: center; margin-top: 25px;">
        <a href="{{ route('admin.withdraw-requests.index') }}" class="btn">Process Withdrawal in Admin</a>
    </div>
@endsection
