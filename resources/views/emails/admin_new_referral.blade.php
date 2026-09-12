@extends('emails.layout')
@section('title', 'Admin Alert: New Referral Submitted')
@section('email_content')
    <h1>👥 New Customer Referral Submitted</h1>
    <p>Hello Admin,</p>
    <p>A customer has submitted a new referral lead on the portal.</p>
    <div class="card">
        <p><strong>Referrer Customer:</strong> {{ $user->name }} ({{ $user->mobile }})</p>
        <p><strong>Referee Name:</strong> {{ $referral->referee_name }}</p>
        <p><strong>Referee Mobile:</strong> {{ $referral->referee_mobile }}</p>
        <p><strong>City:</strong> {{ $referral->referee_city }}</p>
        <p><strong>Potential Reward:</strong> ₹{{ number_format($referral->reward_amount, 2) }}</p>
        <p><strong>Stage:</strong> <span class="badge badge-info">{{ $referral->stage }}</span></p>
    </div>
    <div style="text-align: center; margin-top: 25px;">
        <a href="{{ route('admin.referrals.index') }}" class="btn">View Referrals in Admin</a>
    </div>
@endsection
