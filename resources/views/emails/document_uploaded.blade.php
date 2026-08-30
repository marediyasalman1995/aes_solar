@extends('emails.layout')

@section('title', 'New Plan/Warranty Document Available')

@section('email_content')
    <h1>New Document Available for Download</h1>
    <p>Dear {{ $user->name }},</p>
    <p>A new plan, warranty, net-metering, or invoice document has been successfully uploaded to your account on the AES One portal.</p>
    
    <div class="card">
        <p style="margin: 0; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Document Details:</p>
        <p style="margin: 0; font-size: 14px;"><b>Document Title:</b> {{ $title }}</p>
        <p style="margin: 0; font-size: 14px;"><b>Document Type:</b> {{ $doc_type }}</p>
        @if(!empty($notes))
            <p style="margin: 0; font-size: 14px;"><b>Notes:</b> {{ $notes }}</p>
        @endif
    </div>
    
    <p>You can securely view and download this document by logging in to the portal and navigating to the <b>Warranties &amp; Docs</b> tab.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('login') }}" class="btn">Download Document</a>
    </div>
@endsection
