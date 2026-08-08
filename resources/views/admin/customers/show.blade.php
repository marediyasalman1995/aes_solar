@extends('admin.layouts.master')

@section('title')
    Customer Details — {{ $customer->name }}
@endsection

@section('page_headers')
    <h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg> Customer Profile: <b>{{ $customer->name }}</b></h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
    <li class="breadcrumb-item active">{{ $customer->name }}</li>
@endsection

@section('page_buttons')
    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary btn-sm me-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg> Back to Customers
    </a>
    <a href="{{ route('admin.customers.edit', $customer->uuid) }}" class="btn btn-primary my_btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg> Edit Profile
    </a>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <!-- TOP 4 KPI CARDS -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="card custom-card h-100 shadow-none border">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-success-transparent text-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-wallet"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" /><path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" /></svg>
                            </div>
                            <div class="flex-fill">
                                <span class="fs-12 text-muted fw-semibold">Reward Wallet Balance</span>
                                <h4 class="fw-bold mb-0 text-success">₹{{ number_format($customer->wallet_balance, 2) }}</h4>
                                <a href="javascript:void(0);" class="fs-11 text-success fw-semibold" data-bs-toggle="modal" data-bs-target="#adjustWalletModal">
                                    + Adjust Wallet
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="card custom-card h-100 shadow-none border">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-primary-transparent text-primary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-sun"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                            </div>
                            <div class="flex-fill">
                                <span class="fs-12 text-muted fw-semibold">Solar Sites / Plants</span>
                                <h4 class="fw-bold mb-0 text-primary">{{ $customer->sites->count() }} Site(s)</h4>
                                <a href="javascript:void(0);" class="fs-11 text-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#addSiteModal">
                                    + Add New Site
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="card custom-card h-100 shadow-none border">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-warning-transparent text-warning rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-gift"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 8m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" /><path d="M12 8l0 13" /><path d="M19 12v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-7" /><path d="M7.5 8a2.5 2.5 0 0 1 0 -5a4.8 8 0 0 1 4.5 5a4.8 8 0 0 1 4.5 -5a2.5 2.5 0 0 1 0 5" /></svg>
                            </div>
                            <div class="flex-fill">
                                <span class="fs-12 text-muted fw-semibold">Referral Code</span>
                                <h5 class="fw-bold mb-0 text-warning">{{ $customer->referral_code ?? '—' }}</h5>
                                <span class="text-muted fs-11">{{ $customer->referrals->count() }} Referrals Logged</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="card custom-card h-100 shadow-none border">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-danger-transparent text-danger rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-tools"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21h4l13 -13a1.5 1.5 0 0 0 -4 -4l-13 13v4" /><path d="M14.5 5.5l4 4" /><path d="M12 8l-5 -5l-4 4l5 5" /><path d="M7 8l-1.5 1.5" /><path d="M16 12l5 5l-4 4l-5 -5" /><path d="M16 17l-1.5 1.5" /></svg>
                            </div>
                            <div class="flex-fill">
                                <span class="fs-12 text-muted fw-semibold">Service Requests</span>
                                <h4 class="fw-bold mb-0 text-dark">{{ $customer->serviceRequests->count() }} Total</h4>
                                <span class="text-danger fs-11 fw-semibold">
                                    {{ $customer->serviceRequests->whereIn('status', ['Pending', 'Scheduled', 'In Progress'])->count() }} Open Tickets
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CUSTOMER PROFILE CARD -->
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="card-title mb-0 fw-semibold">Customer Information</h5>
                <span class="badge {{ $customer->status == 1 ? 'bg-success-transparent text-success' : 'bg-danger-transparent text-danger' }} fs-12 px-3 py-1">
                    {{ $customer->status == 1 ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <span class="text-muted fs-12 d-block">Full Name</span>
                        <span class="fw-semibold fs-14">{{ $customer->name }}</span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted fs-12 d-block">Mobile Number</span>
                        <span class="fw-semibold fs-14">{{ $customer->mobile ?? '—' }}</span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted fs-12 d-block">Email Address</span>
                        <span class="fw-semibold fs-14">{{ $customer->email ?? '—' }}</span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted fs-12 d-block">Referral Code</span>
                        <span class="badge bg-info-transparent text-info fw-bold fs-13">{{ $customer->referral_code }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-muted fs-12 d-block">Installation Address</span>
                        <span class="fw-semibold fs-14">{{ $customer->address ?? '—' }}</span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted fs-12 d-block">City / State</span>
                        <span class="fw-semibold fs-14">{{ $customer->city ?? 'Pune' }}, {{ $customer->state ?? 'Maharashtra' }}</span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted fs-12 d-block">Registered On</span>
                        <span class="fw-semibold fs-14">{{ $customer->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODULE TABS -->
        <div class="card">
            <div class="card-header bg-white border-bottom">
                <ul class="nav nav-tabs card-header-tabs" id="customerTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active fw-semibold" id="sites-tab" data-bs-toggle="tab" href="#sites" role="tab">
                            ☀️ Solar Plants / Sites ({{ $customer->sites->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" id="wallet-tab" data-bs-toggle="tab" href="#wallet" role="tab">
                            💰 Reward Wallet History ({{ $customer->walletTransactions->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" id="referrals-tab" data-bs-toggle="tab" href="#referrals" role="tab">
                            👥 Referrals ({{ $customer->referrals->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" id="services-tab" data-bs-toggle="tab" href="#services" role="tab">
                            🛠️ Service Requests ({{ $customer->serviceRequests->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" id="documents-tab" data-bs-toggle="tab" href="#documents" role="tab">
                            📄 Warranties &amp; Documents ({{ $customer->documents->count() }})
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body tab-content" id="customerTabContent">
                <!-- 1. SITES TAB -->
                <div class="tab-pane fade show active" id="sites" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">Customer Solar Sites (Multi-Site Enabled)</h6>
                        <button class="btn btn-sm btn-primary my_btn" data-bs-toggle="modal" data-bs-target="#addSiteModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Add Plant Site
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Site Code / Name</th>
                                    <th>Capacity</th>
                                    <th>System Type</th>
                                    <th>Installation Date</th>
                                    <th>Inverter &amp; Panels</th>
                                    <th>Monthly Avg</th>
                                    <th>CO₂ Offset</th>
                                    <th>Location</th>
                                    <th style="width: 80px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->sites as $site)
                                    <tr>
                                        <td>
                                            <b>{{ $site->site_name }}</b>
                                            <div class="text-muted fs-11">{{ $site->site_code }}</div>
                                        </td>
                                        <td><span class="badge bg-primary-transparent text-primary fw-semibold">{{ $site->capacity_kw }} kW</span></td>
                                        <td><span class="badge bg-info-transparent text-info">{{ $site->system_type }}</span></td>
                                        <td>{{ $site->installation_date ? $site->installation_date->format('M d, Y') : '—' }}</td>
                                        <td>
                                            <small>
                                                {{ $site->inverter_details ?? 'AES Hybrid 5kW' }}<br>
                                                <span class="text-muted">{{ $site->panel_details ?? 'Mono PERC 540W' }}</span>
                                            </small>
                                        </td>
                                        <td><b>{{ $site->monthly_avg_kwh }} kWh</b></td>
                                        <td><b>{{ $site->co2_offset_ton }} Tons</b></td>
                                        <td>{{ $site->city ?? $customer->city }}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('admin.customer-sites.edit', $site->uuid) }}" title="Edit Site" data-bs-toggle="tooltip" class="text-secondary me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </a>
                                            <a href="javascript:void(0);" title="Delete Site" data-bs-toggle="tooltip" class="text-danger" onclick="ajaxCallDelete('{{ route('admin.customer-sites.destroy', $site->uuid) }}', 'Delete this site?', 'sites-table')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-3">No sites configured for this customer yet. Click "+ Add Plant Site" above.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 2. WALLET TAB -->
                <div class="tab-pane fade" id="wallet" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">Reward Wallet Balance: <span class="text-success">₹{{ number_format($customer->wallet_balance, 2) }}</span></h6>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#adjustWalletModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Credit / Debit Wallet
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Title / Remarks</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Reference</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->walletTransactions as $tx)
                                    <tr>
                                        <td>{{ $tx->created_at->format('M d, Y - h:i A') }}</td>
                                        <td><b>{{ $tx->title }}</b><br><small class="text-muted">{{ $tx->description }}</small></td>
                                        <td>
                                            <span class="badge {{ $tx->type == 'Credit' ? 'bg-success-transparent text-success' : 'bg-danger-transparent text-danger' }}">
                                                {{ $tx->type }}
                                            </span>
                                        </td>
                                        <td class="fw-bold {{ $tx->type == 'Credit' ? 'text-success' : 'text-danger' }}">
                                            {{ $tx->type == 'Credit' ? '+' : '-' }}₹{{ number_format($tx->amount, 2) }}
                                        </td>
                                        <td>{{ $tx->reference_type ?? 'Manual' }}</td>
                                        <td><span class="badge bg-success-transparent text-success">{{ $tx->status }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">No wallet transactions logged.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 3. REFERRALS TAB -->
                <div class="tab-pane fade" id="referrals" role="tabpanel">
                    <h6 class="fw-bold mb-3">Referrals Submitted by {{ $customer->name }}</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Referee Name</th>
                                    <th>Mobile Number</th>
                                    <th>City</th>
                                    <th>Date</th>
                                    <th>Stage</th>
                                    <th>Reward Amount</th>
                                    <th>Reward Status</th>
                                    <th style="width: 80px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->referrals as $ref)
                                    <tr>
                                        <td><b>{{ $ref->referee_name }}</b></td>
                                        <td>{{ $ref->referee_mobile }}</td>
                                        <td>{{ $ref->referee_city ?? '—' }}</td>
                                        <td>{{ $ref->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge {{ $ref->stage == 'Installed' ? 'bg-success-transparent text-success' : ($ref->stage == 'Rejected' ? 'bg-danger-transparent text-danger' : 'bg-warning-transparent text-warning') }}">
                                                {{ $ref->stage }}
                                            </span>
                                        </td>
                                        <td><b class="text-primary">₹{{ number_format($ref->reward_amount, 2) }}</b></td>
                                        <td><span class="badge {{ $ref->reward_status == 'Credited' ? 'bg-success-transparent text-success' : 'bg-secondary-transparent text-secondary' }}">{{ $ref->reward_status }}</span></td>
                                        <td style="text-align: center;">
                                            <a href="javascript:void(0);" title="Update Stage & Reward" data-bs-toggle="tooltip" class="text-primary" onclick="openReferralStageModal('{{ $ref->id }}', '{{ $ref->stage }}', '{{ $ref->reward_amount }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-3">No referrals submitted by this customer yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 4. SERVICE REQUESTS TAB -->
                <div class="tab-pane fade" id="services" role="tabpanel">
                    <h6 class="fw-bold mb-3">Service Requests Raised by Customer</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Plant / Site</th>
                                    <th>Issue Type</th>
                                    <th>Preferred Date</th>
                                    <th>Raised On</th>
                                    <th>Status</th>
                                    <th>Technician Notes</th>
                                    <th style="width: 80px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->serviceRequests as $srv)
                                    <tr>
                                        <td><b>{{ $srv->ticket_no }}</b></td>
                                        <td>{{ optional($srv->site)->site_name ?? 'Primary Site' }}</td>
                                        <td><span class="badge bg-info-transparent text-info">{{ $srv->issue_type }}</span></td>
                                        <td>{{ $srv->preferred_date ? $srv->preferred_date->format('M d, Y') : '—' }}</td>
                                        <td>{{ $srv->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge {{ $srv->status == 'Resolved' ? 'bg-success-transparent text-success' : ($srv->status == 'In Progress' ? 'bg-primary-transparent text-primary' : 'bg-warning-transparent text-warning') }}">
                                                {{ $srv->status }}
                                            </span>
                                        </td>
                                        <td><small class="text-muted">{{ $srv->admin_notes ?? '—' }}</small></td>
                                        <td style="text-align: center;">
                                            <a href="javascript:void(0);" title="Update Service Status" data-bs-toggle="tooltip" class="text-primary" onclick="openServiceModal('{{ $srv->id }}', '{{ $srv->status }}', '{{ addslashes($srv->admin_notes ?? '') }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-3">No service requests logged for this customer.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 5. DOCUMENTS TAB -->
                <div class="tab-pane fade" id="documents" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">Warranties, Certificates &amp; Documents</h6>
                        <button class="btn btn-sm btn-primary my_btn" data-bs-toggle="modal" data-bs-target="#addDocModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Add Document
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Doc Type</th>
                                    <th>Document Title</th>
                                    <th>Site</th>
                                    <th>Validity</th>
                                    <th>Notes</th>
                                    <th>Uploaded On</th>
                                    <th style="width: 80px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->documents as $doc)
                                    <tr>
                                        <td><span class="badge bg-primary-transparent text-primary">{{ $doc->doc_type }}</span></td>
                                        <td>
                                            <b>{{ $doc->title }}</b>
                                            @if($doc->file_path)
                                                <a href="{{ asset($doc->file_path) }}" target="_blank" download class="badge bg-danger-transparent text-danger ms-1" title="Download PDF" data-bs-toggle="tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 17v-6" /><path d="M9.5 14.5l2.5 2.5l2.5 -2.5" /></svg> PDF
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ optional($doc->site)->site_name ?? 'All Sites' }}</td>
                                        <td>{{ $doc->valid_until ? $doc->valid_until->format('M d, Y') : 'Lifetime' }}</td>
                                        <td><small class="text-muted">{{ $doc->notes ?? '—' }}</small></td>
                                        <td>{{ $doc->created_at->format('M d, Y') }}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('admin.customer-documents.edit', $doc->uuid) }}" title="Edit Document" data-bs-toggle="tooltip" class="text-secondary me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </a>
                                            <a href="javascript:void(0);" title="Delete Document" data-bs-toggle="tooltip" class="text-danger" onclick="ajaxCallDelete('{{ route('admin.customer-documents.destroy', $doc->uuid) }}', 'Delete this document?', 'docs-table')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-3">No documents added yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 1. MODAL: ADD SITE -->
<div class="modal fade" id="addSiteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.customers.add-site', $customer->uuid) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Solar Plant Site for {{ $customer->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Site / Plant Name</label>
                        <input type="text" name="site_name" class="form-control" placeholder="e.g. Warehouse Plant / Farmhouse 10kW" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Capacity (kW)</label>
                        <input type="number" step="0.1" name="capacity_kw" class="form-control" value="5.0" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">System Type</label>
                        <select name="system_type" class="form-control" required>
                            <option value="On-Grid">On-Grid</option>
                            <option value="Off-Grid">Off-Grid</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Inverter Details</label>
                        <input type="text" name="inverter_details" class="form-control" placeholder="e.g. Growatt 5kW Hybrid Inverter">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Panel Details</label>
                        <input type="text" name="panel_details" class="form-control" placeholder="e.g. Mono PERC 540W Tier-1 (10 Modules)">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Installation Address</label>
                        <input type="text" name="address" class="form-control" value="{{ $customer->address }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" value="{{ $customer->city ?? 'Pune' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Installation Date</label>
                        <input type="date" name="installation_date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Solar Site</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 2. MODAL: ADJUST WALLET -->
<div class="modal fade" id="adjustWalletModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.customers.adjust-wallet', $customer->uuid) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Adjust Reward Wallet Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Current Balance:</label>
                        <h4 class="text-success fw-bold">₹{{ number_format($customer->wallet_balance, 2) }}</h4>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Action Type</label>
                        <select name="type" class="form-control" required>
                            <option value="Credit">Credit (Add Balance)</option>
                            <option value="Debit">Debit (Deduct Balance)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount (₹)</label>
                        <input type="number" step="1" min="1" name="amount" class="form-control" placeholder="e.g. 500" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Transaction Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Milestone Bonus / Referral Reward" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description / Remarks</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Optional notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 3. MODAL: UPDATE REFERRAL STAGE -->
<div class="modal fade" id="referralStageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="referralStageForm" method="POST" action="">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update Referral Stage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Referral Stage</label>
                        <select name="stage" id="refStageSelect" class="form-control" required>
                            <option value="Contacted">Contacted</option>
                            <option value="Site Survey Done">Site Survey Done</option>
                            <option value="Quotation Shared">Quotation Shared</option>
                            <option value="Installed">Installed (Auto-Credits Reward to Wallet!)</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Reward Amount (₹)</label>
                        <input type="number" name="reward_amount" id="refRewardInput" class="form-control" value="500">
                        <small class="text-muted">Will be credited automatically when stage is set to "Installed".</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Optional remarks"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Referral</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 4. MODAL: UPDATE SERVICE REQUEST -->
<div class="modal fade" id="serviceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="serviceForm" method="POST" action="">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update Service Ticket Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="srvStatusSelect" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Scheduled">Scheduled</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Resolved">Resolved</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Technician / Admin Notes</label>
                        <textarea name="admin_notes" id="srvNotesInput" class="form-control" rows="3" placeholder="Technician visit notes or resolution details"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Save Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 5. MODAL: ADD DOCUMENT -->
<div class="modal fade" id="addDocModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.customers.add-document', $customer->uuid) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Document / Warranty for {{ $customer->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Document Type</label>
                        <select name="doc_type" class="form-control" required>
                            <option value="Panel Warranty">Panel Warranty</option>
                            <option value="Inverter Warranty">Inverter Warranty</option>
                            <option value="Installation Agreement">Installation Agreement</option>
                            <option value="Net-Metering Approval">Net-Metering Approval</option>
                            <option value="Invoice">Invoice</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Document Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. 25-Year Panel Warranty Certificate" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Document File (PDF / DOC / Image)</label>
                        <input type="file" name="document_file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Site</label>
                        <select name="customer_site_id" class="form-control">
                            <option value="">All Sites</option>
                            @foreach($customer->sites as $site)
                                <option value="{{ $site->id }}">{{ $site->site_name }} ({{ $site->capacity_kw }} kW)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Valid Until</label>
                        <input type="date" name="valid_until" class="form-control" value="{{ date('Y-m-d', strtotime('+10 years')) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Optional notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Document</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('stackedScripts')
<script>
    function openReferralStageModal(id, stage, reward) {
        document.getElementById('referralStageForm').action = "{{ url('admin/customers/referrals') }}/" + id + "/update-stage";
        document.getElementById('refStageSelect').value = stage;
        document.getElementById('refRewardInput').value = reward;
        new bootstrap.Modal(document.getElementById('referralStageModal')).show();
    }

    function openServiceModal(id, status, notes) {
        document.getElementById('serviceForm').action = "{{ url('admin/customers/services') }}/" + id + "/update";
        document.getElementById('srvStatusSelect').value = status;
        document.getElementById('srvNotesInput').value = notes;
        new bootstrap.Modal(document.getElementById('serviceModal')).show();
    }
</script>
@endpush
@endsection
