@extends('emails.layout')
@section('title', 'Admin Alert: New Service Request')
@section('email_content')
    <h1>🔔 New Service Request Logged</h1>
    <p>Hello Admin,</p>
    <p>A new customer service ticket has been submitted on the AES Solar portal.</p>
    <div class="card">
        <p><strong>Ticket No:</strong> {{ $ticket->ticket_no }}</p>
        <p><strong>Customer:</strong> {{ $user->name }} ({{ $user->mobile }})</p>
        <p><strong>Issue Type:</strong> {{ $ticket->issue_type }}</p>
        <p><strong>Preferred Visit Date:</strong> {{ $ticket->preferred_date ? $ticket->preferred_date->format('d M Y') : 'N/A' }}</p>
        <p><strong>Description:</strong> {{ $ticket->description ?? 'N/A' }}</p>
        <p><strong>Status:</strong> <span class="badge badge-info">{{ $ticket->status }}</span></p>
    </div>
    <div style="text-align: center; margin-top: 25px;">
        <a href="{{ route('admin.service-requests.index') }}" class="btn">View Service Requests in Admin</a>
    </div>
@endsection
