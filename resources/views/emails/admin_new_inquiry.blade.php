@extends('emails.layout')
@section('title', 'Admin Alert: New Website Inquiry')
@section('email_content')
    <h1>📩 New Website Inquiry Received</h1>
    <p>Hello Admin,</p>
    <p>A visitor has submitted a new inquiry form on the website.</p>
    <div class="card">
        <p><strong>Name:</strong> {{ $inquiry->name }}</p>
        <p><strong>Email:</strong> {{ $inquiry->email }}</p>
        <p><strong>Phone:</strong> {{ $inquiry->phone }}</p>
        <p><strong>City / Pincode:</strong> {{ $inquiry->city }} - {{ $inquiry->pincode }}</p>
        <p><strong>Inquiry Type:</strong> {{ $inquiry->type }}</p>
        <p><strong>Monthly Bill:</strong> {{ $inquiry->monthly_bill ?? 'N/A' }}</p>
        <p><strong>Message:</strong> {{ $inquiry->message ?? 'N/A' }}</p>
    </div>
    <div style="text-align: center; margin-top: 25px;">
        <a href="{{ route('admin.inquiries.index') }}" class="btn">View Inquiries in Admin</a>
    </div>
@endsection
