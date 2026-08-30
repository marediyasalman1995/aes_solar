@extends('emails.layout')

@section('title', 'Welcome to AES Energy Solar Portal')

@section('email_content')
    <h1>Welcome to AES Energy Solar Portal!</h1>
    <p>Dear {{ $user->name }},</p>
    <p>Your solar customer profile has been successfully created. You can now access the AES One Portal to monitor your rooftop solar plant setup, documents, warranties, and referral earnings.</p>
    
    <div class="card">
        <p style="margin: 0; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Your Portal Login Information:</p>
        <p style="margin: 0; font-size: 14px;"><b>Registered Email:</b> {{ $user->email }}</p>
        <p style="margin: 0; font-size: 14px;"><b>Registered Mobile:</b> {{ $user->mobile }}</p>
    </div>
    
    <p><b>How to login:</b></p>
    <ol style="font-size: 14px; color: #475569; padding-left: 20px; margin-bottom: 24px;">
        <li style="margin-bottom: 8px;">Click the button below to visit the customer portal login page.</li>
        <li style="margin-bottom: 8px;">Enter your registered email address and click "Send Verification Code".</li>
        <li style="margin-bottom: 8px;">Enter the 4-digit OTP code received in your inbox to securely log in. No password required!</li>
    </ol>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('login') }}" class="btn">Access Customer Portal</a>
    </div>
    
    <p>Thank you for choosing AES Solar Energy as your partner in clean energy!</p>
@endsection
