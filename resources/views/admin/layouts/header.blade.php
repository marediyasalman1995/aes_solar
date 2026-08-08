<header class="app-header">
    <div class="main-header-container container-fluid">
        <div class="header-content-left">
            <div class="header-element">
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
            </div>
        </div>

        <div class="header-content-right">
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
