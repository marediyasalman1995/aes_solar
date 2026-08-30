@extends('emails.layout')

@section('title', 'Service Ticket Status Update')

@section('email_content')
    <h1>Service Ticket Status Updated</h1>
    <p>Dear {{ $user->name }},</p>
    <p>Your support ticket has been updated with a new status.</p>
    
    <div class="card">
        <p style="margin: 0; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Ticket Details:</p>
        <p style="margin: 0; font-size: 14px;"><b>Ticket Number:</b> {{ $ticket->ticket_no }}</p>
        <p style="margin: 0; font-size: 14px;"><b>Issue Category:</b> {{ $ticket->issue_type }}</p>
        <p style="margin: 0; font-size: 14px;"><b>Updated Status:</b> <span class="badge badge-success">{{ $ticket->status }}</span></p>
        @if($ticket->admin_notes)
            <p style="margin: 0; font-size: 14px; margin-top: 8px;"><b>Technician/Admin Notes:</b></p>
            <p style="margin: 0; font-size: 14px; color: #475569; font-style: italic;">"{{ $ticket->admin_notes }}"</p>
        @endif
    </div>
    
    <p>You can check updates or log supplementary information in the portal.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('login') }}" class="btn">View Ticket Updates</a>
    </div>
@endsection
