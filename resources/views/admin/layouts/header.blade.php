<header class="app-header">
    <div class="main-header-container container-fluid">
        <div class="header-content-left">
            <div class="header-element">
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
            </div>
        </div>

        @php
            $pendingServicesCount = \App\Models\ServiceRequest::where('status', 'Pending')->count();
            $pendingReferralsCount = \App\Models\Referral::where('stage', 'Pending')->count();
            $pendingWithdrawCount = \App\Models\WalletTransaction::where('type', 'Payout')->where('status', 'Pending')->count();
            $pendingInquiriesCount = \App\Models\Inquiry::where('status', 'Pending')->count();
            $totalAdminNotifications = $pendingServicesCount + $pendingReferralsCount + $pendingWithdrawCount + $pendingInquiriesCount;
        @endphp

        <div class="header-content-right d-flex align-items-center gap-3">
            <!-- ADMIN NOTIFICATION BELL & DROPDOWN -->
            <div class="header-element dropdown me-2">
                <a href="javascript:void(0);" class="header-link dropdown-toggle position-relative d-flex align-items-center justify-content-center" id="mainHeaderNotifications" data-bs-toggle="dropdown" aria-expanded="false" style="width:38px; height:38px; border-radius:50%; background:#f1f5f9; text-decoration:none;">
                    <i class="ti ti-bell fs-20 text-dark"></i>
                    @if($totalAdminNotifications > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.68rem; padding: 3px 6px;">
                            {{ $totalAdminNotifications }}
                        </span>
                    @endif
                </a>
                <ul class="main-header-dropdown dropdown-menu dropdown-menu-end p-0 overflow-hidden shadow-lg border-0" aria-labelledby="mainHeaderNotifications" style="width: 320px;">
                    <li class="p-3 bg-primary text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-white fw-bold fs-14"><i class="ti ti-bell me-2"></i>Admin Notifications</h6>
                        <span class="badge bg-light text-primary fw-bold">{{ $totalAdminNotifications }} New</span>
                    </li>
                    <div class="list-group list-group-flush" style="max-height: 340px; overflow-y: auto;">
                        <a href="{{ route('admin.service-requests.index') }}" class="list-group-item list-group-item-action d-flex align-items-center py-2 px-3">
                            <div class="avatar avatar-sm rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:34px; height:34px; min-width:34px; background:#fef3c7; color:#d97706;">
                                <i class="ti ti-tools fs-16"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold fs-13 text-dark">New Service Requests</p>
                                <span class="text-muted fs-11">{{ $pendingServicesCount }} pending tickets</span>
                            </div>
                            <span class="badge bg-warning rounded-pill">{{ $pendingServicesCount }}</span>
                        </a>

                        <a href="{{ route('admin.referrals.index') }}" class="list-group-item list-group-item-action d-flex align-items-center py-2 px-3">
                            <div class="avatar avatar-sm rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:34px; height:34px; min-width:34px; background:#e0f2fe; color:#0284c7;">
                                <i class="ti ti-users fs-16"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold fs-13 text-dark">New Referrals</p>
                                <span class="text-muted fs-11">{{ $pendingReferralsCount }} pending reviews</span>
                            </div>
                            <span class="badge bg-info rounded-pill">{{ $pendingReferralsCount }}</span>
                        </a>

                        <a href="{{ route('admin.withdraw-requests.index') }}" class="list-group-item list-group-item-action d-flex align-items-center py-2 px-3">
                            <div class="avatar avatar-sm rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:34px; height:34px; min-width:34px; background:#dcfce7; color:#16a34a;">
                                <i class="ti ti-wallet fs-16"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold fs-13 text-dark">New Withdraw Requests</p>
                                <span class="text-muted fs-11">{{ $pendingWithdrawCount }} pending payouts</span>
                            </div>
                            <span class="badge bg-success rounded-pill">{{ $pendingWithdrawCount }}</span>
                        </a>

                        <a href="{{ route('admin.inquiries.index') }}" class="list-group-item list-group-item-action d-flex align-items-center py-2 px-3">
                            <div class="avatar avatar-sm rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:34px; height:34px; min-width:34px; background:#e0e7ff; color:#4338ca;">
                                <i class="ti ti-mail fs-16"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold fs-13 text-dark">New Inquiries</p>
                                <span class="text-muted fs-11">{{ $pendingInquiriesCount }} pending inquiries</span>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ $pendingInquiriesCount }}</span>
                        </a>
                    </div>
                </ul>
            </div>

            <!-- PROFILE DROPDOWN -->
            <div class="header-element">
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="me-sm-2 me-0">
                            @if(auth()->check() && isset(auth()->user()->avatar_url['250']))
                                <img src="{{ auth()->user()->avatar_url['250'] }}" alt="img" width="32" height="32" class="rounded-circle">
                            @else
                                <div class="avatar avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:32px;height:32px;font-weight:600;">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div class="d-sm-block d-none">
                            <p class="fw-semibold mb-0 lh-1"> Hi, {{ auth()->user()->name ?? 'Admin' }}</p>
                            <span class="op-7 fw-normal d-block fs-11">Super Admin</span>
                        </div>
                    </div>
                </a>
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                    @if(auth()->check())
                        <li><a class="dropdown-item d-flex" href="{{ route('admin.users.edit', auth()->user()->uuid ?? auth()->user()->id) }}"><i class="ti ti-user-circle fs-18 me-2 op-7"></i>Update Profile</a></li>
                        <li><a class="dropdown-item d-flex" href="{{ route('admin.users.changePassword.index', auth()->user()->uuid ?? auth()->user()->id) }}"><i class="ti ti-key fs-18 me-2 op-7"></i>Change Password </a></li>
                    @endif
                    <li><a class="dropdown-item d-flex" href="{{ route('admin.setting.create') }}"><i class="ti ti-manual-gearbox fs-18 me-2 op-7"></i>Setting </a></li>
                    <li><hr class="dropdown-divider my-0"></li>
                    <li><a class="dropdown-item d-flex text-danger" href="{{ route('admin.logout') }}"><i class="ti ti-logout fs-18 me-2 op-7"></i>Logout Admin</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
