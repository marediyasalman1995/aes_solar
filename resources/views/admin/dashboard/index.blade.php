@extends('admin.layouts.master')

@section('title')
    Dashboard — {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4 class="mb-1 text-dark fw-bold" style="font-size:1.35rem;">
        <i class="ri-dashboard-line text-primary me-1"></i>
        Executive Solar Dashboard
    </h4>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Executive Overview</li>
@endsection

@section('page_buttons')
    <div class="d-flex gap-2 flex-wrap ms-auto">
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary my_btn shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Add Customer
        </a>
        <a href="{{ route('admin.customer-sites.create') }}" class="btn btn-info my_btn shadow-sm text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg> Add Plant Site
        </a>
    </div>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        
        <!-- 6 DISTINCT COLOR KPI SUMMARY CARDS -->
        <div class="row g-3 mb-4">
            
            <!-- 1. TOTAL CUSTOMERS (ROYAL BLUE) -->
            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #eef4ff 0%, #ffffff 100%); border-left: 4px solid #2563eb !important; border-radius: 14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-secondary fs-12 fw-bold text-uppercase" style="letter-spacing:.04em; color:#475569;">Customers</span>
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg, #2563eb, #3b82f6); color:#fff;">
                                <i class="ri-user-star-line fs-18"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#1e3a8a; font-size:1.65rem;">{{ $totalCustomers }}</h3>
                        <div class="d-flex align-items-center fs-11 mt-1">
                            <span class="badge bg-primary text-white me-1 px-2 py-1"><i class="ri-check-line"></i> Active</span>
                            <span class="fw-semibold text-dark">Registered</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. SOLAR PLANTS / SITES (CYAN / TEAL) -->
            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #f0fdfa 0%, #ffffff 100%); border-left: 4px solid #0d9488 !important; border-radius: 14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-secondary fs-12 fw-bold text-uppercase" style="letter-spacing:.04em; color:#475569;">Solar Plants</span>
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg, #0d9488, #14b8a6); color:#fff;">
                                <i class="ri-sun-line fs-18"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#115e59; font-size:1.65rem;">{{ $totalSites }}</h3>
                        <div class="d-flex align-items-center fs-11 mt-1">
                            <span class="badge bg-info text-white me-1 px-2 py-1">Grid Sites</span>
                            <span class="fw-semibold text-dark">Installed Rooftops</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. TOTAL CAPACITY (SOLAR GOLD / AMBER) -->
            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #fffbeb 0%, #ffffff 100%); border-left: 4px solid #f59e0b !important; border-radius: 14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-secondary fs-12 fw-bold text-uppercase" style="letter-spacing:.04em; color:#475569;">Total Capacity</span>
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg, #d97706, #f59e0b); color:#fff;">
                                <i class="ri-flashlight-line fs-18"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#b45309; font-size:1.65rem;">{{ round($totalCapacity, 1) }} <span class="fs-13 fw-bold text-secondary">kW</span></h3>
                        <div class="d-flex align-items-center fs-11 mt-1">
                            <span class="badge bg-warning text-dark me-1 px-2 py-1 fw-bold">~{{ number_format($monthlyGenUnits) }} u/mo</span>
                            <span class="fw-semibold text-dark">Generation</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. TOTAL REFERRALS (EMERALD GREEN) -->
            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #ecfdf5 0%, #ffffff 100%); border-left: 4px solid #10b981 !important; border-radius: 14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-secondary fs-12 fw-bold text-uppercase" style="letter-spacing:.04em; color:#475569;">Referrals</span>
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg, #059669, #10b981); color:#fff;">
                                <i class="ri-gift-line fs-18"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#047857; font-size:1.65rem;">{{ $totalReferrals }}</h3>
                        <div class="d-flex align-items-center fs-11 mt-1">
                            <span class="badge bg-success text-white me-1 px-2 py-1"><i class="ri-arrow-up-line"></i> Referrals</span>
                            <span class="fw-semibold text-dark">Network</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. REWARDS CREDITED (ROYAL VIOLET) -->
            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #faf5ff 0%, #ffffff 100%); border-left: 4px solid #8b5cf6 !important; border-radius: 14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-secondary fs-12 fw-bold text-uppercase" style="letter-spacing:.04em; color:#475569;">Rewards Paid</span>
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg, #7c3aed, #8b5cf6); color:#fff;">
                                <i class="ri-wallet-3-line fs-18"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#6d28d9; font-size:1.65rem;">₹{{ number_format($totalRewards, 0) }}</h3>
                        <div class="d-flex align-items-center fs-11 mt-1">
                            <span class="badge text-white me-1 px-2 py-1" style="background:#7c3aed;">Wallet</span>
                            <span class="fw-semibold text-dark">Customer Earnings</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. SERVICE TICKETS (CORAL ROSE RED) -->
            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #fff1f2 0%, #ffffff 100%); border-left: 4px solid #f43f5e !important; border-radius: 14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-secondary fs-12 fw-bold text-uppercase" style="letter-spacing:.04em; color:#475569;">Open Tickets</span>
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg, #e11d48, #f43f5e); color:#fff;">
                                <i class="ri-customer-service-2-line fs-18"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#be123c; font-size:1.65rem;">{{ $openServiceRequests }}</h3>
                        <div class="d-flex align-items-center fs-11 mt-1">
                            <span class="badge {{ $openServiceRequests > 0 ? 'bg-danger text-white' : 'bg-success text-white' }} me-1 px-2 py-1">
                                {{ $openServiceRequests > 0 ? 'Action Needed' : 'All Clear' }}
                            </span>
                            <span class="fw-semibold text-dark">Service Queue</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ENVIRONMENTAL & CLEAN ENERGY IMPACT STRIP (HIGH CONTRAST TEXT) -->
        <div class="card custom-card border-0 mb-4 shadow-sm" style="background: linear-gradient(120deg, #093753 0%, #0d5f96 60%, #15803d 100%); border-radius: 16px;">
            <div class="card-body py-3 px-4">
                <div class="row align-items-center text-center text-md-start">
                    <div class="col-md-3 mb-3 mb-md-0">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                            <div style="font-size:2.2rem;">🌱</div>
                            <div>
                                <h5 class="mb-0 text-white fw-bold" style="letter-spacing:-0.01em;">Clean Energy Impact</h5>
                                <span class="d-block text-white-50 fs-12 mt-1">Environmental contribution</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 text-center border-start border-white-50 my-1 py-1">
                        <span class="d-block text-white fw-semibold fs-11 text-uppercase mb-1" style="letter-spacing:0.05em; opacity:0.9;">CO₂ Carbon Offset</span>
                        <h3 class="mb-0 text-white fw-bold" style="font-size:1.55rem;">{{ $co2SavedTons }} <span class="fs-13 fw-normal text-white-50">Tons/yr</span></h3>
                    </div>
                    <div class="col-md-3 col-6 text-center border-start border-white-50 my-1 py-1">
                        <span class="d-block text-white fw-semibold fs-11 text-uppercase mb-1" style="letter-spacing:0.05em; opacity:0.9;">Equivalent Trees</span>
                        <h3 class="mb-0 text-white fw-bold" style="font-size:1.55rem;">🌳 {{ number_format($treesPlantedEquiv) }} <span class="fs-13 fw-normal text-white-50">Planted</span></h3>
                    </div>
                    <div class="col-md-3 col-12 text-center text-md-end border-start border-white-50 mt-3 mt-md-0 py-1">
                        <span class="d-block text-white fw-semibold fs-11 text-uppercase mb-1" style="letter-spacing:0.05em; opacity:0.9;">Est. Monthly Bill Savings</span>
                        <h3 class="mb-0 fw-bold" style="font-size:1.55rem; color:#fef08a;">₹{{ number_format($estimatedMonthlySavings) }} <span class="fs-13 fw-normal text-white-50">/ mo</span></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- INTERACTIVE GRAPHICAL CHARTS SECTION -->
        <div class="row g-3 mb-4">
            
            <!-- CHART 1: SOLAR CAPACITY & MONTHLY GENERATION -->
            <div class="col-xl-8">
                <div class="card custom-card h-100 shadow-sm border-0" style="border-radius:16px;">
                    <div class="card-header d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                        <div class="d-flex flex-column">
                            <h6 class="card-title mb-1 fw-bold text-dark fs-15 d-block">Solar Capacity &amp; Generation Trends</h6>
                            <span class="text-muted fs-12 d-block">Installed kW capacity growth and clean energy output (kWh)</span>
                        </div>
                        <span class="badge bg-primary-transparent text-primary px-3 py-2 rounded-pill ms-auto">
                            <i class="ri-line-chart-line me-1"></i> 6 Months Overview
                        </span>
                    </div>
                    <div class="card-body">
                        <div id="solarAnalyticsChart" style="min-height: 310px;"></div>
                    </div>
                </div>
            </div>

            <!-- CHART 2: REFERRAL PIPELINE & CONVERSION -->
            <div class="col-xl-4">
                <div class="card custom-card h-100 shadow-sm border-0" style="border-radius:16px;">
                    <div class="card-header d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                        <div class="d-flex flex-column">
                            <h6 class="card-title mb-1 fw-bold text-dark fs-15 d-block">Referral Pipeline</h6>
                            <span class="text-muted fs-12 d-block">Stages from lead to commissioning</span>
                        </div>
                        <a href="{{ route('admin.referrals.index') }}" class="btn btn-xs btn-outline-primary rounded-pill ms-auto">View All</a>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div id="referralPipelineChart" style="min-height: 230px;"></div>
                        
                        <!-- Mini Breakdown list -->
                        <div class="mt-2 pt-2 border-top">
                            <div class="row text-center g-2">
                                <div class="col-3">
                                    <span class="text-muted fs-11 d-block fw-semibold">Lead</span>
                                    <b class="text-dark fs-13">{{ $referralStages['Lead'] }}</b>
                                </div>
                                <div class="col-3">
                                    <span class="text-muted fs-11 d-block fw-semibold">Survey</span>
                                    <b class="text-info fs-13">{{ $referralStages['Survey Scheduled'] }}</b>
                                </div>
                                <div class="col-3">
                                    <span class="text-muted fs-11 d-block fw-semibold">Install</span>
                                    <b class="text-warning fs-13">{{ $referralStages['Installation'] }}</b>
                                </div>
                                <div class="col-3">
                                    <span class="text-muted fs-11 d-block fw-semibold">Live</span>
                                    <b class="text-success fs-13">{{ $referralStages['Commissioned'] }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- 2-COLUMN RECENT ACTIVITY TABLES -->
        <div class="row g-3">
            
            <!-- RECENT CUSTOMERS TABLE -->
            <div class="col-xl-6">
                <div class="card custom-card shadow-sm border-0 h-100" style="border-radius:16px;">
                    <div class="card-header d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-primary-transparent text-primary rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-user-follow-line"></i>
                            </div>
                            <h6 class="card-title mb-0 fw-bold text-dark fs-15">Recent Registered Customers</h6>
                        </div>
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-primary rounded-pill ms-auto">
                            View All <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 360px;">
                            <table class="table table-hover align-middle mb-0" style="width:100%;">
                                <thead class="table-light">
                                    <tr class="fs-12 text-muted text-uppercase fw-bold">
                                        <th style="padding-left:18px;">Customer</th>
                                        <th>Mobile</th>
                                        <th>Referral Code</th>
                                        <th>Plants</th>
                                        <th style="padding-right:18px; text-align:right;">Wallet Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentCustomers as $rc)
                                        <tr>
                                            <td style="padding-left:18px;">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar avatar-sm rounded-circle bg-primary-transparent text-primary fw-bold d-flex align-items-center justify-content-center" style="width:34px; height:34px; font-size:0.8rem;">
                                                        {{ strtoupper(substr($rc->name, 0, 2)) }}
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('admin.customers.show', $rc->uuid) }}" class="fw-bold text-dark text-hover-primary d-block fs-13">
                                                            {{ $rc->name }}
                                                        </a>
                                                        <span class="text-muted fs-11">{{ $rc->email ?? 'No email' }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fs-12 fw-semibold text-dark">{{ $rc->mobile }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary-transparent text-primary px-2 py-1 fw-bold">{{ $rc->referral_code }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info-transparent text-info px-2 py-1 fw-bold">{{ $rc->sites_count }} Site(s)</span>
                                            </td>
                                            <td style="padding-right:18px; text-align:right;">
                                                <b class="text-success fs-13">₹{{ number_format($rc->wallet_balance, 0) }}</b>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">
                                                <i class="ri-user-unfollow-line fs-24 d-block mb-1"></i>
                                                No customers registered yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RECENT INQUIRIES TABLE -->
            <div class="col-xl-6">
                <div class="card custom-card shadow-sm border-0 h-100" style="border-radius:16px;">
                    <div class="card-header d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-info-transparent text-info rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-mail-line"></i>
                            </div>
                            <h6 class="card-title mb-0 fw-bold text-dark fs-15">Recent Website Inquiries</h6>
                        </div>
                        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm btn-outline-primary rounded-pill ms-auto">
                            View All <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 360px;">
                            <table class="table table-hover align-middle mb-0" style="width:100%;">
                                <thead class="table-light">
                                    <tr class="fs-12 text-muted text-uppercase fw-bold">
                                        <th style="padding-left:18px;">Lead Name</th>
                                        <th>Phone</th>
                                        <th>Requirement</th>
                                        <th style="padding-right:18px; text-align:right;">Received</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentInquiries as $inq)
                                        <tr>
                                            <td style="padding-left:18px;">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar avatar-sm rounded-circle bg-info-transparent text-info fw-bold d-flex align-items-center justify-content-center" style="width:34px; height:34px; font-size:0.8rem;">
                                                        {{ strtoupper(substr($inq->name, 0, 2)) }}
                                                    </div>
                                                    <div>
                                                        <b class="text-dark d-block fs-13">{{ $inq->name }}</b>
                                                        <span class="text-muted fs-11">{{ $inq->email }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="tel:{{ $inq->phone }}" class="text-dark fs-12 fw-semibold">
                                                    <i class="ri-phone-line text-primary me-1"></i>{{ $inq->phone }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 180px;" title="{{ $inq->subject }}">
                                                    <span class="badge bg-secondary-transparent text-dark fw-medium">{{ $inq->subject }}</span>
                                                </div>
                                            </td>
                                            <td style="padding-right:18px; text-align:right;">
                                                <span class="text-muted fs-12">{{ $inq->created_at->format('d M, Y') }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                <i class="ri-inbox-line fs-24 d-block mb-1"></i>
                                                No website inquiries yet.
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
</div>
@endsection

@push('stackedScripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 1. Solar Analytics Area Chart
        var optionsCapacity = {
            series: [{
                name: 'Total Installed Capacity (kW)',
                type: 'area',
                data: {!! json_encode($chartCapacityData) !!}
            }, {
                name: 'Monthly Energy Output (kWh)',
                type: 'line',
                data: {!! json_encode($chartGenerationData) !!}
            }],
            chart: {
                height: 310,
                type: 'line',
                toolbar: { show: false },
                zoom: { enabled: false },
                fontFamily: 'inherit'
            },
            colors: ['#0f6aa8', '#16a34a'],
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: [2, 3]
            },
            fill: {
                type: ['gradient', 'solid'],
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: {!! json_encode($chartMonths) !!},
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: [{
                title: { text: 'Installed Capacity (kW)', style: { color: '#0f6aa8', fontSize: '11px', fontWeight: 600 } },
                labels: {
                    formatter: function (val) { return val + ' kW'; }
                }
            }, {
                opposite: true,
                title: { text: 'Generated Units (kWh)', style: { color: '#16a34a', fontSize: '11px', fontWeight: 600 } },
                labels: {
                    formatter: function (val) { return val + ' u'; }
                }
            }],
            tooltip: {
                shared: true,
                intersect: false
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right'
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4
            }
        };

        var chartCapacity = new ApexCharts(document.querySelector("#solarAnalyticsChart"), optionsCapacity);
        chartCapacity.render();

        // 2. Referral Pipeline Donut Chart
        var optionsPipeline = {
            series: {!! json_encode(array_values($referralStages)) !!},
            chart: {
                height: 230,
                type: 'donut',
                fontFamily: 'inherit'
            },
            labels: {!! json_encode(array_keys($referralStages)) !!},
            colors: ['#3b82f6', '#0d9488', '#f59e0b', '#10b981'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '72%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total Leads',
                                color: '#475569',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " Referrals";
                    }
                }
            }
        };

        var chartPipeline = new ApexCharts(document.querySelector("#referralPipelineChart"), optionsPipeline);
        chartPipeline.render();
    });
</script>
@endpush
