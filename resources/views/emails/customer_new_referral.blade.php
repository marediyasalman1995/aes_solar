@extends('emails.layout')
@section('title', 'Referral Submitted Successfully — AES Energy')
@section('email_content')
    <h1>🎉 Referral Submitted Successfully!</h1>
    <p>Hello {{ $user->name }},</p>
    <p>Thank you for referring your friend to AES Energy Rooftop Solar. Your referral has been successfully received and is currently under review by our solar team.</p>
    <div class="card">
        <p><strong>Friend / Referee Name:</strong> {{ $referral->referee_name }}</p>
        <p><strong>Mobile Number:</strong> {{ $referral->referee_mobile }}</p>
        <p><strong>City:</strong> {{ $referral->referee_city ?? 'Pune' }}</p>
        <p><strong>Referral Reward:</strong> ₹{{ number_format($referral->reward_amount, 2) }}</p>
        <p><strong>Status:</strong> <span class="badge badge-warning" style="background:#fef3c7; color:#92400e; padding:4px 8px; border-radius:6px; font-weight:600;">Pending Review</span></p>
    </div>
    <p style="font-size:0.92rem; color:#475569; margin-top:16px;">
        💡 <strong>How it works:</strong> Our technical team will reach out to {{ $referral->referee_name }} for a free rooftop solar survey and quotation. Once their solar installation is commissioned and approved, your reward of <strong>₹{{ number_format($referral->reward_amount, 2) }}</strong> will be credited directly to your AES Reward Wallet!
    </p>
    <div style="text-align: center; margin-top: 25px;">
        <a href="{{ route('customer.dashboard') }}#tab-refer" class="btn">Track Referral Status</a>
    </div>
@endsection
