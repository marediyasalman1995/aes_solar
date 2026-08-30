@extends('emails.layout')

@section('title', 'Solar Plant Site Setup Completed')

@section('email_content')
    <h1>Solar Plant Site Configured Successfully</h1>
    <p>Dear {{ $user->name }},</p>
    <p>We are pleased to inform you that a solar plant site has been successfully set up and associated with your account on the AES One portal.</p>
    
    <div class="card">
        <p style="margin: 0; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Solar Plant Site Details:</p>
        <p style="margin: 0; font-size: 14px;"><b>Site Name:</b> {{ $site->site_name }}</p>
        <p style="margin: 0; font-size: 14px;"><b>System Type:</b> {{ $site->system_type }}</p>
        <p style="margin: 0; font-size: 14px;"><b>Capacity:</b> {{ $site->capacity_kw }} kW</p>
        @if($site->installation_date)
            <p style="margin: 0; font-size: 14px;"><b>Installation Date:</b> {{ \Carbon\Carbon::parse($site->installation_date)->format('M d, Y') }}</p>
        @endif
        @if($site->inverter_details)
            <p style="margin: 0; font-size: 14px;"><b>Inverter:</b> {{ $site->inverter_details }}</p>
        @endif
        @if($site->panel_details)
            <p style="margin: 0; font-size: 14px;"><b>Solar Panels:</b> {{ $site->panel_details }}</p>
        @endif
    </div>
    
    <p>You can view full real-time metrics, estimated CO2 offset, and generation metrics on your dashboard.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('login') }}" class="btn">View Plant on Portal</a>
    </div>
@endsection
