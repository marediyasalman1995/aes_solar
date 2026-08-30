@extends('emails.layout')

@section('title', 'Reward Credited to Wallet')

@section('email_content')
    <h1>Congratulations! Rewards Credited</h1>
    <p>Dear {{ $user->name }},</p>
    <p>We are happy to inform you that your reward wallet has been credited with an earning.</p>
    
    <div class="card">
        <p style="margin: 0; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Transaction Details:</p>
        <p style="margin: 0; font-size: 14px;"><b>Credit Amount:</b> <span style="font-weight: 700; color: #15803d;">₹{{ number_format($amount, 2) }}</span></p>
        <p style="margin: 0; font-size: 14px;"><b>Transaction:</b> {{ $title }}</p>
        @if(!empty($description))
            <p style="margin: 0; font-size: 14px;"><b>Description:</b> {{ $description }}</p>
        @endif
        <p style="margin: 0; font-size: 14px; margin-top: 8px;"><b>Updated Wallet Balance:</b> <b>₹{{ number_format($user->wallet_balance, 2) }}</b></p>
    </div>
    
    <p>You can check your transactional statements, referral list, and make payout requests from your portal dashboard.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('login') }}" class="btn">View Wallet Balance</a>
    </div>
@endsection
