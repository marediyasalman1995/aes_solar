@extends('emails.layout')

@section('title', 'Your Verification Code')

@section('email_content')
    <h1>Login Verification Code</h1>
    <p>Hello,</p>
    <p>You requested a one-time verification code (OTP) to log in to the AES One solar portal. Please find your verification code below:</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <span style="display: inline-block; font-size: 32px; font-weight: 800; letter-spacing: 6px; padding: 12px 30px; background-color: #f1f5f9; border: 2px dashed #0284c7; border-radius: 8px; color: #0b3d5c;">{{ $otp }}</span>
    </div>
    
    <p>This verification code is valid for 10 minutes. For security, please do not share this OTP with anyone.</p>
    <p>If you did not request this login verification code, you can safely ignore this email.</p>
@endsection
