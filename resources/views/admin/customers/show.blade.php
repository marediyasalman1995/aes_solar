@extends('admin.layouts.master')

@section('title')
    Customer Details — {{ $customer->name }}
@endsection

@section('page_headers')
    <div class="d-flex align-items-center gap-2">
        <div class="avatar avatar-md rounded-circle bg-primary-transparent text-primary fw-bold d-flex align-items-center justify-content-center" style="width:42px; height:42px; font-size:1rem;">
            {{ strtoupper(substr($customer->name, 0, 2)) }}
        </div>
        <div>
            <h4 class="mb-0 text-dark fw-bold" style="font-size:1.3rem;">
                Customer Profile: <span class="text-primary">{{ $customer->name }}</span>
            </h4>
            <span class="text-muted fs-12">Customer Account &amp; Multi-Plant Solar Management Portal</span>
        </div>
    </div>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
    <li class="breadcrumb-item active">{{ $customer->name }}</li>
@endsection

@section('page_buttons')
    <div class="d-flex align-items-center gap-2 ms-auto">
        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg> Back to Customers
        </a>
        <a href="{{ route('admin.customers.edit', $customer->uuid) }}" class="btn btn-primary my_btn shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg> Edit Profile
        </a>
    </div>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        
        <!-- TOP 4 DISTINCT COLOR KPI SUMMARY CARDS -->
        <div class="row g-3 mb-4">
            
            <!-- 1. WALLET BALANCE (EMERALD GREEN) -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card custom-card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 100%); border-left: 4px solid #10b981 !important; border-radius: 14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-secondary fs-12 fw-bold text-uppercase" style="letter-spacing:.04em; color:#475569;">Reward Wallet</span>
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg, #059669, #10b981); color:#fff;">
                                <i class="ri-wallet-3-line fs-18"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#047857; font-size:1.65rem;">₹{{ number_format($customer->wallet_balance, 2) }}</h3>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <span class="text-muted fs-11">Customer Credits</span>
                            <a href="javascript:void(0);" class="badge bg-success text-white px-2 py-1 text-decoration-none shadow-sm" data-bs-toggle="modal" data-bs-target="#adjustWalletModal">
                                <i class="ri-add-line"></i> Adjust Wallet
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. SOLAR SITES (CYAN / TEAL) -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card custom-card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #f0fdfa 0%, #ffffff 100%); border-left: 4px solid #0d9488 !important; border-radius: 14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-secondary fs-12 fw-bold text-uppercase" style="letter-spacing:.04em; color:#475569;">Solar Plants</span>
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg, #0d9488, #14b8a6); color:#fff;">
                                <i class="ri-sun-line fs-18"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#115e59; font-size:1.65rem;">{{ $customer->sites->count() }} <span class="fs-13 fw-normal text-muted">Site(s)</span></h3>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <span class="text-muted fs-11">{{ $customer->sites->sum('capacity_kw') }} kW Total</span>
                            <a href="javascript:void(0);" class="badge bg-info text-white px-2 py-1 text-decoration-none shadow-sm" data-bs-toggle="modal" data-bs-target="#addSiteModal">
                                <i class="ri-add-line"></i> Add New Site
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. REFERRAL CODE (SOLAR GOLD / AMBER) -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card custom-card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #fffbeb 0%, #ffffff 100%); border-left: 4px solid #f59e0b !important; border-radius: 14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-secondary fs-12 fw-bold text-uppercase" style="letter-spacing:.04em; color:#475569;">Referral Code</span>
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg, #d97706, #f59e0b); color:#fff;">
                                <i class="ri-gift-line fs-18"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge bg-warning text-dark px-3 py-2 fw-bold fs-13" style="letter-spacing:0.04em; white-space:nowrap;">
                                {{ $customer->referral_code ?? 'NO-CODE' }}
                            </span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <span class="text-muted fs-11">{{ $customer->referrals->count() }} Referrals Logged</span>
                            <span class="badge bg-warning-transparent text-warning fw-semibold fs-11">Earn ₹500/install</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. SERVICE REQUESTS (CORAL ROSE RED) -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card custom-card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #fff1f2 0%, #ffffff 100%); border-left: 4px solid #f43f5e !important; border-radius: 14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-secondary fs-12 fw-bold text-uppercase" style="letter-spacing:.04em; color:#475569;">Service Requests</span>
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg, #e11d48, #f43f5e); color:#fff;">
                                <i class="ri-customer-service-2-line fs-18"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#be123c; font-size:1.65rem;">{{ $customer->serviceRequests->count() }} <span class="fs-13 fw-normal text-muted">Total</span></h3>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <span class="badge {{ $customer->serviceRequests->whereIn('status', ['Pending', 'Scheduled', 'In Progress'])->count() > 0 ? 'bg-danger text-white' : 'bg-success text-white' }} px-2 py-1">
                                {{ $customer->serviceRequests->whereIn('status', ['Pending', 'Scheduled', 'In Progress'])->count() }} Open Tickets
                            </span>
                            <span class="text-muted fs-11">Support Queue</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- CUSTOMER INFORMATION CARD -->
        <div class="card custom-card shadow-sm border-0 mb-4" style="border-radius:16px;">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-xs bg-primary-transparent text-primary rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ri-information-line"></i>
                    </div>
                    <h6 class="card-title mb-0 fw-bold text-dark fs-15">Customer Information</h6>
                </div>
                <span class="badge {{ $customer->status == 1 ? 'bg-success text-white' : 'bg-danger text-white' }} fs-12 px-3 py-1 rounded-pill">
                    <i class="ri-checkbox-circle-line me-1"></i>{{ $customer->status == 1 ? 'Active Account' : 'Inactive' }}
                </span>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-3 col-sm-6">
                        <span class="text-muted fs-12 fw-bold text-uppercase d-block mb-1" style="letter-spacing:0.04em;">Full Name</span>
                        <h6 class="fw-bold text-dark mb-0 fs-14">{{ $customer->name }}</h6>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <span class="text-muted fs-12 fw-bold text-uppercase d-block mb-1" style="letter-spacing:0.04em;">Mobile Number</span>
                        @if($customer->mobile)
                            <a href="tel:{{ $customer->mobile }}" class="fw-bold text-dark text-hover-primary fs-14">
                                <i class="ri-phone-line text-primary me-1"></i>{{ $customer->mobile }}
                            </a>
                        @else
                            <span class="text-muted fs-14">—</span>
                        @endif
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <span class="text-muted fs-12 fw-bold text-uppercase d-block mb-1" style="letter-spacing:0.04em;">Email Address</span>
                        @if($customer->email)
                            <a href="mailto:{{ $customer->email }}" class="fw-bold text-dark text-hover-primary fs-14">
                                <i class="ri-mail-line text-info me-1"></i>{{ $customer->email }}
                            </a>
                        @else
                            <span class="text-muted fs-14">—</span>
                        @endif
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <span class="text-muted fs-12 fw-bold text-uppercase d-block mb-1" style="letter-spacing:0.04em;">Referral Code</span>
                        <span class="badge bg-primary-transparent text-primary fw-bold fs-13 px-2 py-1">{{ $customer->referral_code ?? '—' }}</span>
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <span class="text-muted fs-12 fw-bold text-uppercase d-block mb-1" style="letter-spacing:0.04em;">Installation Address</span>
                        <span class="fw-semibold text-dark fs-14">
                            <i class="ri-map-pin-line text-danger me-1"></i>{{ $customer->address ?? 'Baner, Pune, Maharashtra' }}
                        </span>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <span class="text-muted fs-12 fw-bold text-uppercase d-block mb-1" style="letter-spacing:0.04em;">City / State</span>
                        <span class="fw-semibold text-dark fs-14">{{ $customer->city ?? 'Pune' }}, {{ $customer->state ?? 'Maharashtra' }}</span>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <span class="text-muted fs-12 fw-bold text-uppercase d-block mb-1" style="letter-spacing:0.04em;">Account Created</span>
                        <span class="fw-semibold text-dark fs-14">{{ $customer->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODULE TABS CARD -->
        <div class="card custom-card shadow-sm border-0" style="border-radius:16px;">
            <div class="card-header bg-white border-bottom p-0">
                <ul class="nav nav-tabs card-header-tabs m-0 px-3 pt-2" id="customerTab" role="tablist" style="border-bottom:none;">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold py-3 px-4" id="sites-tab" data-bs-toggle="tab" href="#sites" role="tab">
                            ☀️ Solar Plants / Sites ({{ $customer->sites->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold py-3 px-4" id="wallet-tab" data-bs-toggle="tab" href="#wallet" role="tab">
                            💰 Reward Wallet History ({{ $customer->walletTransactions->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold py-3 px-4" id="referrals-tab" data-bs-toggle="tab" href="#referrals" role="tab">
                            👥 Referrals ({{ $customer->referrals->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold py-3 px-4" id="services-tab" data-bs-toggle="tab" href="#services" role="tab">
                            🛠️ Service Requests ({{ $customer->serviceRequests->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold py-3 px-4" id="documents-tab" data-bs-toggle="tab" href="#documents" role="tab">
                            📄 Warranties &amp; Documents ({{ $customer->documents->count() }})
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4 tab-content" id="customerTabContent">
                
                <!-- 1. SITES TAB -->
                <div class="tab-pane fade show active" id="sites" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div>
                            <h6 class="fw-bold text-dark mb-0 fs-15">Customer Solar Sites &amp; Generation</h6>
                            <span class="text-muted fs-12">Multi-site plant assets linked to this customer account</span>
                        </div>
                        <button class="btn btn-sm btn-primary my_btn shadow-sm ms-auto" data-bs-toggle="modal" data-bs-target="#addSiteModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Add Plant Site
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="width:100%;">
                            <thead class="table-light">
                                <tr class="fs-12 text-muted text-uppercase fw-bold">
                                    <th style="padding-left:18px;">Site Name / Code</th>
                                    <th>Capacity</th>
                                    <th>System Type</th>
                                    <th>Installed On</th>
                                    <th>Inverter &amp; Panels</th>
                                    <th>Monthly Avg</th>
                                    <th>CO₂ Offset</th>
                                    <th>Location</th>
                                    <th style="padding-right:18px; text-align:right;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->sites as $site)
                                    <tr>
                                        <td style="padding-left:18px;">
                                            <b class="text-dark d-block fs-13">{{ $site->site_name }}</b>
                                            <span class="badge bg-secondary-transparent text-dark fs-11">{{ $site->site_code }}</span>
                                        </td>
                                        <td><span class="badge bg-primary text-white fw-bold px-2 py-1">{{ $site->capacity_kw }} kW</span></td>
                                        <td><span class="badge bg-info-transparent text-info px-2 py-1 fw-bold">{{ $site->system_type }}</span></td>
                                        <td><span class="text-dark fs-12 fw-medium">{{ $site->installation_date ? $site->installation_date->format('M d, Y') : '—' }}</span></td>
                                        <td>
                                            <div class="fs-12 fw-semibold text-dark">{{ $site->inverter_details ?? 'AES Hybrid 5kW' }}</div>
                                            <div class="text-muted fs-11">{{ $site->panel_details ?? 'Mono PERC 540W' }}</div>
                                        </td>
                                        <td><b class="text-dark fs-13">{{ $site->monthly_avg_kwh }} kWh</b></td>
                                        <td><span class="badge bg-success-transparent text-success fw-bold">{{ $site->co2_offset_ton }} Tons</span></td>
                                        <td><span class="text-muted fs-12">{{ $site->city ?? $customer->city }}</span></td>
                                        <td style="padding-right:18px; text-align:right;">
                                            <a href="{{ route('admin.customer-sites.edit', $site->uuid) }}" title="Edit Site" data-bs-toggle="tooltip" class="btn btn-sm btn-icon btn-light text-primary me-1">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                            <a href="javascript:void(0);" title="Delete Site" data-bs-toggle="tooltip" class="btn btn-sm btn-icon btn-light text-danger" onclick="ajaxCallDelete('{{ route('admin.customer-sites.destroy', $site->uuid) }}', 'Delete this site?', 'sites-table')">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="ri-sun-line fs-24 d-block mb-1"></i>
                                            No sites configured for this customer yet. Click "+ Add Plant Site" above.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 2. WALLET TAB -->
                <div class="tab-pane fade" id="wallet" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div>
                            <h6 class="fw-bold text-dark mb-0 fs-15">Reward Wallet Balance: <span class="text-success">₹{{ number_format($customer->wallet_balance, 2) }}</span></h6>
                            <span class="text-muted fs-12">Credits for successful referrals, surveys &amp; milestone rewards</span>
                        </div>
                        <button class="btn btn-sm btn-success shadow-sm ms-auto" data-bs-toggle="modal" data-bs-target="#adjustWalletModal">
                            <i class="ri-wallet-3-line me-1"></i> Credit / Debit Wallet
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="width:100%;">
                            <thead class="table-light">
                                <tr class="fs-12 text-muted text-uppercase fw-bold">
                                    <th style="padding-left:18px;">Date &amp; Time</th>
                                    <th>Transaction Details</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Reference</th>
                                    <th style="padding-right:18px; text-align:right;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->walletTransactions as $tx)
                                    <tr>
                                        <td style="padding-left:18px;">
                                            <span class="text-dark fs-12 fw-medium">{{ $tx->created_at->format('M d, Y — h:i A') }}</span>
                                        </td>
                                        <td>
                                            <b class="text-dark d-block fs-13">{{ $tx->title }}</b>
                                            <small class="text-muted fs-11">{{ $tx->description }}</small>
                                        </td>
                                        <td>
                                            <span class="badge {{ $tx->type == 'Credit' ? 'bg-success text-white' : 'bg-danger text-white' }} px-2 py-1 fw-bold">
                                                {{ $tx->type }}
                                            </span>
                                        </td>
                                        <td class="fw-bold fs-14 {{ $tx->type == 'Credit' ? 'text-success' : 'text-danger' }}">
                                            {{ $tx->type == 'Credit' ? '+' : '-' }}₹{{ number_format($tx->amount, 2) }}
                                        </td>
                                        <td><span class="badge bg-secondary-transparent text-dark">{{ $tx->reference_type ?? 'Manual' }}</span></td>
                                        <td style="padding-right:18px; text-align:right;">
                                            <span class="badge bg-success-transparent text-success fw-bold">{{ $tx->status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="ri-wallet-line fs-24 d-block mb-1"></i>
                                            No wallet transactions logged for this customer.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 3. REFERRALS TAB -->
                <div class="tab-pane fade" id="referrals" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-bold text-dark mb-0 fs-15">Referrals Submitted by {{ $customer->name }}</h6>
                            <span class="text-muted fs-12">Leads and friends who registered using {{ $customer->referral_code }}</span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="width:100%;">
                            <thead class="table-light">
                                <tr class="fs-12 text-muted text-uppercase fw-bold">
                                    <th style="padding-left:18px;">Referee Name</th>
                                    <th>Mobile Number</th>
                                    <th>City</th>
                                    <th>Date</th>
                                    <th>Stage</th>
                                    <th>Reward Amount</th>
                                    <th>Reward Status</th>
                                    <th style="padding-right:18px; text-align:right;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->referrals as $ref)
                                    <tr>
                                        <td style="padding-left:18px;"><b class="text-dark fs-13">{{ $ref->referee_name }}</b></td>
                                        <td><span class="text-dark fs-12 fw-medium">{{ $ref->referee_mobile }}</span></td>
                                        <td><span class="text-muted fs-12">{{ $ref->referee_city ?? '—' }}</span></td>
                                        <td><span class="text-muted fs-12">{{ $ref->created_at->format('M d, Y') }}</span></td>
                                        <td>
                                            <span class="badge {{ $ref->stage == 'Installed' || $ref->stage == 'Commissioned' ? 'bg-success text-white' : ($ref->stage == 'Rejected' ? 'bg-danger text-white' : 'bg-warning text-dark') }} px-2 py-1 fw-bold">
                                                {{ $ref->stage }}
                                            </span>
                                        </td>
                                        <td><b class="text-primary fs-13">₹{{ number_format($ref->reward_amount, 2) }}</b></td>
                                        <td>
                                            <span class="badge {{ $ref->reward_status == 'Credited' ? 'bg-success-transparent text-success' : 'bg-secondary-transparent text-dark' }} fw-bold">
                                                {{ $ref->reward_status }}
                                            </span>
                                        </td>
                                        <td style="padding-right:18px; text-align:right;">
                                            <a href="javascript:void(0);" title="Update Stage & Reward" data-bs-toggle="tooltip" class="btn btn-sm btn-icon btn-light text-primary" onclick="openReferralStageModal('{{ $ref->id }}', '{{ $ref->stage }}', '{{ $ref->reward_amount }}')">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="ri-gift-line fs-24 d-block mb-1"></i>
                                            No referrals submitted by this customer yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 4. SERVICE REQUESTS TAB -->
                <div class="tab-pane fade" id="services" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-bold text-dark mb-0 fs-15">Service Requests Raised by Customer</h6>
                            <span class="text-muted fs-12">Panel cleaning, inverter health checks &amp; warranty support</span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="width:100%;">
                            <thead class="table-light">
                                <tr class="fs-12 text-muted text-uppercase fw-bold">
                                    <th style="padding-left:18px;">Ticket #</th>
                                    <th>Plant / Site</th>
                                    <th>Issue Type</th>
                                    <th>Preferred Date</th>
                                    <th>Raised On</th>
                                    <th>Status</th>
                                    <th>Technician Notes</th>
                                    <th style="padding-right:18px; text-align:right;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->serviceRequests as $srv)
                                    <tr>
                                        <td style="padding-left:18px;"><b class="text-dark fs-13">{{ $srv->ticket_no }}</b></td>
                                        <td><span class="badge bg-secondary-transparent text-dark">{{ optional($srv->site)->site_name ?? 'Primary Site' }}</span></td>
                                        <td><span class="badge bg-info-transparent text-info fw-bold">{{ $srv->issue_type }}</span></td>
                                        <td><span class="text-dark fs-12 fw-medium">{{ $srv->preferred_date ? $srv->preferred_date->format('M d, Y') : '—' }}</span></td>
                                        <td><span class="text-muted fs-12">{{ $srv->created_at->format('M d, Y') }}</span></td>
                                        <td>
                                            <span class="badge {{ $srv->status == 'Resolved' ? 'bg-success text-white' : ($srv->status == 'In Progress' ? 'bg-primary text-white' : 'bg-warning text-dark') }} px-2 py-1 fw-bold">
                                                {{ $srv->status }}
                                            </span>
                                        </td>
                                        <td><small class="text-muted fs-11">{{ $srv->admin_notes ?? '—' }}</small></td>
                                        <td style="padding-right:18px; text-align:right;">
                                            <a href="javascript:void(0);" title="Update Service Status" data-bs-toggle="tooltip" class="btn btn-sm btn-icon btn-light text-primary" onclick="openServiceModal('{{ $srv->id }}', '{{ $srv->status }}', '{{ addslashes($srv->admin_notes ?? '') }}')">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="ri-customer-service-line fs-24 d-block mb-1"></i>
                                            No service requests logged for this customer.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 5. DOCUMENTS TAB -->
                <div class="tab-pane fade" id="documents" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div>
                            <h6 class="fw-bold text-dark mb-0 fs-15">Warranties, Certificates &amp; Documents</h6>
                            <span class="text-muted fs-12">Tier-1 panel warranties, inverter certificates, Net-metering approval PDFs</span>
                        </div>
                        <button class="btn btn-sm btn-primary my_btn shadow-sm ms-auto" data-bs-toggle="modal" data-bs-target="#addDocModal">
                            <i class="ri-file-add-line me-1"></i> Add Document
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="width:100%;">
                            <thead class="table-light">
                                <tr class="fs-12 text-muted text-uppercase fw-bold">
                                    <th style="padding-left:18px;">Doc Type</th>
                                    <th>Document Title</th>
                                    <th>Site</th>
                                    <th>Validity</th>
                                    <th>Notes</th>
                                    <th>Uploaded On</th>
                                    <th style="padding-right:18px; text-align:right;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->documents as $doc)
                                    <tr>
                                        <td style="padding-left:18px;"><span class="badge bg-primary-transparent text-primary fw-bold">{{ $doc->doc_type }}</span></td>
                                        <td>
                                            <b class="text-dark fs-13">{{ $doc->title }}</b>
                                            @if($doc->file_path)
                                                <a href="{{ asset($doc->file_path) }}" target="_blank" download class="badge bg-danger text-white ms-1 text-decoration-none shadow-sm" title="Download PDF" data-bs-toggle="tooltip">
                                                    <i class="ri-download-line me-1"></i> PDF
                                                </a>
                                            @endif
                                        </td>
                                        <td><span class="badge bg-secondary-transparent text-dark">{{ optional($doc->site)->site_name ?? 'All Sites' }}</span></td>
                                        <td><span class="text-dark fs-12 fw-medium">{{ $doc->valid_until ? $doc->valid_until->format('M d, Y') : 'Lifetime' }}</span></td>
                                        <td><small class="text-muted fs-11">{{ $doc->notes ?? '—' }}</small></td>
                                        <td><span class="text-muted fs-12">{{ $doc->created_at->format('M d, Y') }}</span></td>
                                        <td style="padding-right:18px; text-align:right;">
                                            <a href="{{ route('admin.customer-documents.edit', $doc->uuid) }}" title="Edit Document" data-bs-toggle="tooltip" class="btn btn-sm btn-icon btn-light text-primary me-1">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                            <a href="javascript:void(0);" title="Delete Document" data-bs-toggle="tooltip" class="btn btn-sm btn-icon btn-light text-danger" onclick="ajaxCallDelete('{{ route('admin.customer-documents.destroy', $doc->uuid) }}', 'Delete this document?', 'docs-table')">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="ri-file-text-line fs-24 d-block mb-1"></i>
                                            No documents added yet. Click "+ Add Document" above.
                                        </td>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;">
            <form method="POST" action="{{ route('admin.customers.add-site', $customer->uuid) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add Solar Plant Site for {{ $customer->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Site / Plant Name</label>
                        <input type="text" name="site_name" class="form-control" placeholder="e.g. Warehouse Plant / Farmhouse 10kW" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Capacity (kW)</label>
                        <input type="number" step="0.1" name="capacity_kw" class="form-control" value="5.0" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">System Type</label>
                        <select name="system_type" class="form-control" required>
                            <option value="On-Grid">On-Grid</option>
                            <option value="Off-Grid">Off-Grid</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Inverter Details</label>
                        <input type="text" name="inverter_details" class="form-control" placeholder="e.g. Growatt 5kW Hybrid Inverter">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Panel Details</label>
                        <input type="text" name="panel_details" class="form-control" placeholder="e.g. Mono PERC 540W Tier-1 (10 Modules)">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Installation Address</label>
                        <input type="text" name="address" class="form-control" value="{{ $customer->address }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">City</label>
                        <input type="text" name="city" class="form-control" value="{{ $customer->city ?? 'Pune' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Installation Date</label>
                        <input type="date" name="installation_date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Solar Site</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 2. MODAL: ADJUST WALLET -->
<div class="modal fade" id="adjustWalletModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;">
            <form method="POST" action="{{ route('admin.customers.adjust-wallet', $customer->uuid) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Adjust Reward Wallet Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 mb-3 rounded" style="background:#ecfdf5; border:1px solid #a7f3d0;">
                        <span class="fs-12 text-muted fw-bold text-uppercase d-block">Current Wallet Balance:</span>
                        <h3 class="text-success fw-bold mb-0">₹{{ number_format($customer->wallet_balance, 2) }}</h3>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Action Type</label>
                        <select name="type" class="form-control" required>
                            <option value="Credit">Credit (Add Balance)</option>
                            <option value="Debit">Debit (Deduct Balance)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Amount (₹)</label>
                        <input type="number" step="1" min="1" name="amount" class="form-control" placeholder="e.g. 500" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Transaction Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Milestone Bonus / Referral Reward" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description / Remarks</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Optional notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 3. MODAL: UPDATE REFERRAL STAGE -->
<div class="modal fade" id="referralStageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;">
            <form id="referralStageForm" method="POST" action="">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Update Referral Stage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Referral Stage</label>
                        <select name="stage" id="refStageSelect" class="form-control" required>
                            <option value="Contacted">Contacted</option>
                            <option value="Site Survey Done">Site Survey Done</option>
                            <option value="Quotation Shared">Quotation Shared</option>
                            <option value="Installed">Installed (Auto-Credits Reward to Wallet!)</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Reward Amount (₹)</label>
                        <input type="number" name="reward_amount" id="refRewardInput" class="form-control" value="500">
                        <small class="text-muted">Will be credited automatically when stage is set to "Installed".</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Notes</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Optional remarks"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Referral</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 4. MODAL: UPDATE SERVICE REQUEST -->
<div class="modal fade" id="serviceModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;">
            <form id="serviceForm" method="POST" action="">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Update Service Ticket Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" id="srvStatusSelect" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Scheduled">Scheduled</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Resolved">Resolved</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Technician / Admin Notes</label>
                        <textarea name="admin_notes" id="srvNotesInput" class="form-control" rows="3" placeholder="Technician visit notes or resolution details"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info text-white">Save Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 5. MODAL: ADD DOCUMENT -->
<div class="modal fade" id="addDocModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;">
            <form method="POST" action="{{ route('admin.customers.add-document', $customer->uuid) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add Document / Warranty for {{ $customer->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Document Type</label>
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
                        <label class="form-label fw-bold">Document Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. 25-Year Panel Warranty Certificate" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Document File (PDF / DOC / Image)</label>
                        <input type="file" name="document_file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Select Site</label>
                        <select name="customer_site_id" class="form-control">
                            <option value="">All Sites</option>
                            @foreach($customer->sites as $site)
                                <option value="{{ $site->id }}">{{ $site->site_name }} ({{ $site->capacity_kw }} kW)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Valid Until</label>
                        <input type="date" name="valid_until" class="form-control" value="{{ date('Y-m-d', strtotime('+10 years')) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Notes</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Optional notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
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
