@extends('emails.layout')
@section('title', 'Thank You for Your Inquiry — AES Energy')
@section('email_content')
    <h1>☀️ Thank You for Contacting AES Energy!</h1>
    <p>Hello {{ $inquiry->name }},</p>
    <p>We have successfully received your solar inquiry regarding <strong>{{ $inquiry->type }} Solutions</strong>. A dedicated solar engineering advisor will review your requirements and reach out to you shortly.</p>
    <div class="card">
        <p><strong>Your Name:</strong> {{ $inquiry->name }}</p>
        <p><strong>Contact Phone:</strong> {{ $inquiry->phone }}</p>
        <p><strong>Location:</strong> {{ $inquiry->city }} ({{ $inquiry->pincode }})</p>
        <p><strong>Inquiry Type:</strong> {{ $inquiry->type }}</p>
        @if(!empty($inquiry->monthly_bill))
            <p><strong>Estimated Monthly Bill:</strong> {{ $inquiry->monthly_bill }}</p>
        @endif
        @if(!empty($inquiry->message))
            <p><strong>Message / Requirement:</strong> {{ $inquiry->message }}</p>
        @endif
        <p><strong>Status:</strong> <span class="badge badge-info" style="background:#e0f2fe; color:#0369a1; padding:4px 8px; border-radius:6px; font-weight:600;">Pending Review</span></p>
    </div>
    <p style="font-size:0.92rem; color:#475569; margin-top:16px;">
        Our team can assist you with rooftop solar assessment, PM Surya Ghar subsidy claim (up to ₹78,000 direct DBT), net-metering approvals, and tier-1 solar panel options.
    </p>
    <div style="text-align: center; margin-top: 25px;">
        <a href="{{ route('home') }}" class="btn">Visit AES Energy Website</a>
    </div>
@endsection
