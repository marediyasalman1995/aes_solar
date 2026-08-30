@extends('emails.layout')

@section('title', 'Service Request Raised Successfully')

@section('email_content')
    <h1>Service Request Logged</h1>
    <p>Dear {{ $user->name }},</p>
    <p>Your support ticket has been successfully registered. We will look into it shortly and update you with the schedule.</p>
    
    <div class="card">
        <p style="margin: 0; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Ticket Details:</p>
        <p style="margin: 0; font-size: 14px;"><b>Ticket Number:</b> {{ $ticket->ticket_no }}</p>
        <p style="margin: 0; font-size: 14px;"><b>Issue Category:</b> {{ $ticket->issue_type }}</p>
        @if($ticket->preferred_date)
            <p style="margin: 0; font-size: 14px;"><b>Preferred Date:</b> {{ \Carbon\Carbon::parse($ticket->preferred_date)->format('M d, Y') }}</p>
        @endif
        @if($ticket->description)
            <p style="margin: 0; font-size: 14px;"><b>Description:</b> {{ $ticket->description }}</p>
        @endif
        <p style="margin: 0; font-size: 14px;"><b>Current Status:</b> <span class="badge badge-info">{{ $ticket->status }}</span></p>
    </div>
    
    <p>You can track the live status of this service request at any time by logging into the portal.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('login') }}" class="btn">Track Request</a>
    </div>
@endsection
