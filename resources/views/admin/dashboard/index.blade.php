@extends('admin.layouts.master')

@section('title')
    Dashboard - {{ config('app.name') }}
@endsection

@section('page_headers')
    <h4><i class="ri-dashboard-line me-1"></i> AES Energy Executive Dashboard</h4>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <!-- 6 KEY METRIC CARDS -->
        <div class="row mb-4">
            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-primary-transparent text-primary rounded-circle me-3 d-flex align-items-center justify-content-center">
                                <i class="ri-user-star-line fs-20"></i>
                            </div>
                            <div>
                                <span class="text-muted fs-12">Total Customers</span>
                                <h4 class="fw-bold mb-0 text-dark">{{ $totalCustomers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-info-transparent text-info rounded-circle me-3 d-flex align-items-center justify-content-center">
                                <i class="ri-sun-line fs-20"></i>
                            </div>
                            <div>
                                <span class="text-muted fs-12">Solar Sites / Plants</span>
                                <h4 class="fw-bold mb-0 text-primary">{{ $totalSites }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-warning-transparent text-warning rounded-circle me-3 d-flex align-items-center justify-content-center">
                                <i class="ri-flashlight-line fs-20"></i>
                            </div>
                            <div>
                                <span class="text-muted fs-12">Total Capacity</span>
                                <h4 class="fw-bold mb-0 text-warning">{{ round($totalCapacity, 1) }} kW</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-success-transparent text-success rounded-circle me-3 d-flex align-items-center justify-content-center">
                                <i class="ri-gift-line fs-20"></i>
                            </div>
                            <div>
                                <span class="text-muted fs-12">Total Referrals</span>
                                <h4 class="fw-bold mb-0 text-success">{{ $totalReferrals }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-purple-transparent text-purple rounded-circle me-3 d-flex align-items-center justify-content-center" style="background:rgba(147, 51, 234, 0.12); color:#9333ea;">
                                <i class="ri-wallet-3-line fs-20"></i>
                            </div>
                            <div>
                                <span class="text-muted fs-12">Rewards Credited</span>
                                <h4 class="fw-bold mb-0 text-purple" style="color:#9333ea;">₹{{ number_format($totalRewards, 0) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-2 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-md bg-danger-transparent text-danger rounded-circle me-3 d-flex align-items-center justify-content-center">
                                <i class="ri-customer-service-2-line fs-20"></i>
                            </div>
                            <div>
                                <span class="text-muted fs-12">Open Service Tickets</span>
                                <h4 class="fw-bold mb-0 text-danger">{{ $openServiceRequests }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2-COLUMN TABLES: RECENT CUSTOMERS & RECENT INQUIRIES -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card custom-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Recent Registered Customers</h6>
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-xs btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Code</th>
                                        <th>Sites</th>
                                        <th>Wallet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentCustomers as $rc)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.customers.show', $rc->uuid) }}" class="fw-bold">
                                                    {{ $rc->name }}
                                                </a>
                                            </td>
                                            <td>{{ $rc->mobile }}</td>
                                            <td><span class="badge bg-info-transparent text-info">{{ $rc->referral_code }}</span></td>
                                            <td>{{ $rc->sites_count }} Site(s)</td>
                                            <td class="text-success fw-bold">₹{{ number_format($rc->wallet_balance, 0) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-muted">No customers yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card custom-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Recent Public Website Inquiries</h6>
                        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-xs btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentInquiries as $inq)
                                        <tr>
                                            <td><b>{{ $inq->name }}</b></td>
                                            <td>{{ $inq->phone }}</td>
                                            <td>{{ $inq->subject }}</td>
                                            <td>{{ $inq->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center text-muted">No website inquiries yet.</td></tr>
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
