<!DOCTYPE html>
<html lang="en" style="overflow-y: scroll !important; height: auto !important;">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>AES One Dashboard — AES Energy</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/frontend.css') }}?v={{ time() }}">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
  select, option, input, textarea, button {
    font-family: 'Poppins', sans-serif !important;
  }
  .site-selector-pill {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #e8f4fd;
    border: 1.5px solid #b7dcf7;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 0.84rem;
    font-weight: 600;
    color: #0284c7;
  }
  .site-selector-pill select {
    background: transparent;
    border: none;
    font-weight: 600;
    color: #0284c7;
    font-size: 0.84rem;
    cursor: pointer;
    outline: none;
  }
  .dash-nav-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 18px;
    color: #475569;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.92rem;
    transition: all 0.2s;
    cursor: pointer;
    border: none;
    background: transparent;
    width: 100%;
    text-align: left;
  }
  .dash-nav-btn:hover {
    background: #f1f5f9;
    color: #0284c7;
  }
  .dash-nav-btn.active {
    background: #0284c7;
    color: #ffffff;
    font-weight: 600;
  }
  .dash-tab-content {
    display: none;
  }
  .dash-tab-content.active {
    display: block;
    animation: fadeIn 0.3s ease-in-out;
  }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
  }
  .modal-overlay.active {
    display: flex;
  }
  .modal-card {
    background: #fff;
    border-radius: 20px;
    max-width: 460px;
    width: 90%;
    padding: 30px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
  }
  @media (max-width: 768px) {
    .table-responsive {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      margin-bottom: 1rem;
    }
    .table-responsive table {
      width: 100%;
      min-width: 500px;
    }
  }
  @media (max-width: 600px) {
    .user-name-text {
      display: none !important;
    }
    .user-chip {
      padding: 0 !important;
      border-radius: 50% !important;
      background: transparent !important;
      border-color: transparent !important;
      box-shadow: none !important;
    }
    .profile-grid {
      grid-template-columns: 1fr !important;
    }
    #serviceRequestForm {
      grid-template-columns: 1fr !important;
    }
    .doc-row {
      flex-direction: column !important;
      align-items: flex-start !important;
      gap: 12px !important;
    }
    .doc-row .btn {
      width: 100% !important;
      justify-content: center !important;
    }
    table {
      font-size: 0.76rem !important;
    }
    th, td {
      padding: 8px 6px !important;
    }
  }
  .chart-tooltip {
    position: absolute;
    background: rgba(15, 23, 42, 0.95);
    color: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.72rem;
    font-weight: 500;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.15s ease;
    z-index: 9999;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transform: translate(-50%, -100%);
    margin-top: -10px;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }
  .chart-tooltip::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 50%;
    transform: translateX(-50%) rotate(45deg);
    width: 8px;
    height: 8px;
    background: rgba(15, 23, 42, 0.95);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
</style>
</head>
<body style="overflow-y: visible !important; height: auto !important; overflow-x: hidden !important; position: relative !important;">

<div id="dashboardView" class="view">
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <a href="{{ route('home') }}" class="brand" style="padding: 10px 18px 24px; display: flex; align-items: center;">
      <img src="{{ \App\MyClasses\GeneralHelperFunctions::getSetting('header_logo') }}" alt="AES Energy" style="height: 63px; width: auto; object-fit: contain; display: block;">
    </a>

    <nav class="side-menu">
      <button class="dash-nav-btn active" data-tab="tab-home" onclick="switchDashboardTab('tab-home', this)">
        <i class="ri-home-4-line" style="font-size:1.1rem; width: 20px; text-align: center;"></i> Dashboard
      </button>
      <button class="dash-nav-btn" data-tab="tab-wallet" onclick="switchDashboardTab('tab-wallet', this)">
        <i class="ri-wallet-3-line" style="font-size:1.1rem; width: 20px; text-align: center;"></i> AES Reward Wallet
      </button>
      <button class="dash-nav-btn" data-tab="tab-refer" onclick="switchDashboardTab('tab-refer', this)">
        <i class="ri-group-line" style="font-size:1.1rem; width: 20px; text-align: center;"></i> Refer &amp; Earn
      </button>
      <button class="dash-nav-btn" data-tab="tab-service" onclick="switchDashboardTab('tab-service', this)">
        <i class="ri-tools-line" style="font-size:1.1rem; width: 20px; text-align: center;"></i> Service Request
      </button>
      <button class="dash-nav-btn" data-tab="tab-warranty" onclick="switchDashboardTab('tab-warranty', this)">
        <i class="ri-file-shield-2-line" style="font-size:1.1rem; width: 20px; text-align: center;"></i> Warranty &amp; Docs
      </button>
      <button class="dash-nav-btn" data-tab="tab-plant" onclick="switchDashboardTab('tab-plant', this)">
        <i class="ri-bubble-chart-line" style="font-size:1.1rem; width: 20px; text-align: center;"></i> My Solar Plant
      </button>
      <button class="dash-nav-btn" data-tab="tab-profile" onclick="switchDashboardTab('tab-profile', this)">
        <i class="ri-user-line" style="font-size:1.1rem; width: 20px; text-align: center;"></i> My Profile
      </button>
      <button class="dash-nav-btn" data-tab="tab-notifications" onclick="switchDashboardTab('tab-notifications', this)">
        <i class="ri-notification-3-line" style="font-size:1.1rem; width: 20px; text-align: center;"></i> Notifications
        @php $unreadCount = $notifications->where('is_read', false)->count(); @endphp
        @if($unreadCount > 0)
          <span class="badge" style="background:#ef4444;color:#fff;margin-left:auto;font-size:0.75rem;padding:2px 8px;border-radius:10px;">{{ $unreadCount }}</span>
        @endif
      </button>
    </nav>

    <div style="margin-top: auto; padding: 20px 18px 0; border-top: 1px solid #e2e8f0;">
      <a href="{{ route('customer.logout') }}" class="dash-nav-btn" style="color: #ef4444; text-decoration: none; display: flex; align-items: center; gap: 12px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="ri-logout-box-r-line" style="font-size:1.1rem; width: 20px; text-align: center;"></i> Logout AES One
      </a>
      <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="dash-main">
    <!-- Topbar -->
    <div class="dash-topbar">
      <button class="burger" id="dashBurger" onclick="toggleSidebar()" style="display:none;"><span></span><span></span><span></span></button>
      <div>
        <h1>Good afternoon, {{ explode(' ', $user->name)[0] }} 👋</h1>
        <div class="sub">Here's how your solar plant &amp; rewards are doing</div>
      </div>

      <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap; justify-content:space-between;">
        <!-- Multi-site selector -->
        <div class="site-selector-pill">
          <span>☀️ Plant:</span>
          <form id="siteSwitchForm" method="POST" action="{{ route('customer.switchSite') }}" style="margin:0;">
            @csrf
            <select name="site_id" onchange="document.getElementById('siteSwitchForm').submit();">
              @foreach($sites as $site)
                <option value="{{ $site->id }}" {{ $site->id == $activeSite->id ? 'selected' : '' }}>
                  {{ $site->site_name }} ({{ $site->capacity_kw }} kW)
                </option>
              @endforeach
            </select>
          </form>
        </div>

        <div class="user-chip">
          <div class="avatar">
            @php
              $parts = explode(' ', $user->name);
              $initials = strtoupper(substr($parts[0] ?? 'A', 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
            @endphp
            {{ $initials }}
          </div>
          <span class="user-name-text">{{ $user->name }}</span>
        </div>
      </div>
    </div>

    <!-- MAIN DASHBOARD TABS -->
    <main id="dash-content" class="dash-section" style="padding-top:10px;">

      <!-- 1. DASHBOARD HOME -->
      <div id="tab-home" class="dash-tab-content active">
        <!-- TOP CARD: Available Reward Balance -->
        <div class="wallet-hero">
          <div>
            <div class="lbl"><i class="ri-wallet-3-fill text-warning" style="margin-right:6px;"></i> Available Reward Balance</div>
            <div class="amount">₹<span class="counter" data-target="{{ round($user->wallet_balance) }}">{{ number_format($user->wallet_balance, 0) }}</span></div>
          </div>
          <button class="btn btn-amber" onclick="switchDashboardTab('tab-refer', document.querySelector('[data-tab=\'tab-refer\']'))">
            Refer More Friends →
          </button>
        </div>

        <!-- STATS GRID -->
        <div class="stat-grid">
          <div class="stat-card" style="cursor:pointer;" onclick="switchDashboardTab('tab-plant', document.querySelector('[data-tab=\'tab-plant\']'))">
            <div class="ic"><i class="ri-flashlight-fill text-warning"></i></div>
            <div class="val"><span class="counter" data-target="{{ round($activeSite->monthly_avg_kwh ?? 612) }}">{{ round($activeSite->monthly_avg_kwh ?? 612) }}</span> kWh</div>
            <div class="lbl">Generated this month ({{ $activeSite->site_name }})</div>
          </div>
          <div class="stat-card" style="cursor:pointer;" onclick="switchDashboardTab('tab-wallet', document.querySelector('[data-tab=\'tab-wallet\']'))">
            <div class="ic"><i class="ri-lightbulb-fill text-success"></i></div>
            <div class="val">₹<span class="counter" data-target="{{ round($estimatedSavings) }}">{{ number_format($estimatedSavings, 0) }}</span></div>
            <div class="lbl">Bill savings (est.)</div>
          </div>
          <div class="stat-card" style="cursor:pointer;" onclick="switchDashboardTab('tab-refer', document.querySelector('[data-tab=\'tab-refer\']'))">
            <div class="ic"><i class="ri-group-fill text-primary"></i></div>
            <div class="val"><span class="counter" data-target="{{ $totalReferred }}">{{ $totalReferred }}</span></div>
            <div class="lbl">Friends referred</div>
          </div>
          <div class="stat-card" style="cursor:pointer;" onclick="switchDashboardTab('tab-service', document.querySelector('[data-tab=\'tab-service\']'))">
            <div class="ic"><i class="ri-tools-fill text-info"></i></div>
            <div class="val"><span class="counter" data-target="{{ $openServiceRequestsCount }}">{{ $openServiceRequestsCount }}</span></div>
            <div class="lbl">Open service requests</div>
          </div>
        </div>

        <div class="two-col">
          <!-- Daily Solar Generation Curve Panel -->
          <div class="panel">
            <h3><i class="ri-sun-line text-amber" style="margin-right:6px;"></i> Daily Solar Generation Curve</h3>
            
            <!-- Quick metrics row -->
            <div style="display: flex; gap: 20px; margin-bottom: 20px; background: #f8fafc; padding: 14px 18px; border-radius: 12px; border: 1px solid #e2e8f0;">
              <div style="flex: 1;">
                <span style="font-size: 0.76rem; color: var(--muted); text-transform: uppercase; font-weight: 600; display: block; margin-bottom: 2px;">
                  <span class="pulse-dot" style="background:#22c55e; width: 8px; height: 8px; display: inline-block; border-radius: 50%; margin-right: 4px; vertical-align: middle;"></span>Current Output
                </span>
                <b id="liveCurrentOutput" style="font-size: 1.3rem; color: var(--blue-900);">0.0 kW</b>
              </div>
              <div style="flex: 1; border-left: 1px solid #e2e8f0; padding-left: 20px;">
                <span style="font-size: 0.76rem; color: var(--muted); text-transform: uppercase; font-weight: 600; display: block; margin-bottom: 2px;">Peak Today</span>
                <b id="livePeakOutput" style="font-size: 1.3rem; color: var(--blue-900);">0.0 kW</b>
              </div>
              <div style="flex: 1; border-left: 1px solid #e2e8f0; padding-left: 20px;">
                <span style="font-size: 0.76rem; color: var(--muted); text-transform: uppercase; font-weight: 600; display: block; margin-bottom: 2px;">Total Today</span>
                <b id="liveTotalToday" style="font-size: 1.3rem; color: #16a34a;">0.0 kWh</b>
              </div>
            </div>

            @php
              $dailyPoints = [];
              $peakKw = ($activeSite->capacity_kw ?? 6.4) * 0.8;
              for ($i = 0; $i <= 12; $i++) {
                  $pct = $i / 12;
                  $x = 50 + $pct * 400;
                  $y = 130 - 110 * sin($pct * M_PI);
                  $kw = $peakKw * sin($pct * M_PI);
                  $hourNum = 6 + $i;
                  $ampm = $hourNum >= 12 ? ($hourNum > 12 ? ($hourNum - 12) . ' PM' : '12 PM') : $hourNum . ' AM';
                  $dailyPoints[] = [
                      'x' => round($x, 1),
                      'y' => round($y, 1),
                      'kw' => round($kw, 2),
                      'time' => $ampm
                  ];
              }
            @endphp

            <!-- SVG Sun Curve Chart -->
            <div style="position: relative; background: #f8fafc; border-radius: 14px; border: 1px solid #e2e8f0; padding: 10px 10px 5px; overflow: hidden;">
              <svg width="100%" height="150" viewBox="0 0 500 150" style="display: block;">
                <defs>
                  <linearGradient id="solarGradient" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="var(--amber)" stop-opacity="0.45"/>
                    <stop offset="100%" stop-color="var(--amber)" stop-opacity="0.0"/>
                  </linearGradient>
                  <linearGradient id="curveStroke" x1="0" y1="0" x2="1" y2="0">
                    <stop offset="0%" stop-color="var(--blue-400)"/>
                    <stop offset="50%" stop-color="var(--amber)"/>
                    <stop offset="100%" stop-color="var(--blue-600)"/>
                  </linearGradient>
                  <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                    <feGaussianBlur stdDeviation="3" result="blur" />
                    <feComposite in="SourceGraphic" in2="blur" operator="over" />
                  </filter>
                </defs>

                <!-- Grid helper lines -->
                <line x1="50" y1="130" x2="450" y2="130" stroke="#cbd5e1" stroke-width="1" />
                <line x1="250" y1="20" x2="250" y2="130" stroke="#cbd5e1" stroke-width="1.5" stroke-dasharray="4,4" />

                <!-- Filled solar curve -->
                <path d="M 50 130 C 150 130, 190 20, 250 20 C 310 20, 350 130, 450 130 Z" fill="url(#solarGradient)" />

                <!-- Stroke line curve -->
                <path id="solarCurvePath" d="M 50 130 C 150 130, 190 20, 250 20 C 310 20, 350 130, 450 130" fill="none" stroke="url(#curveStroke)" stroke-width="4.5" stroke-linecap="round" />

                <!-- Hourly vertex dots -->
                @foreach($dailyPoints as $dp)
                  <circle cx="{{ $dp['x'] }}" cy="{{ $dp['y'] }}" r="4" fill="#fff" stroke="var(--amber)" stroke-width="2" class="daily-point" data-label="{{ $dp['time'] }}" data-value="{{ $dp['kw'] }} kW" style="cursor: pointer;" />
                @endforeach

                <!-- Text labels -->
                <text x="50" y="145" fill="var(--muted)" font-size="10" font-weight="600" text-anchor="middle">6:00 AM</text>
                <text x="250" y="145" fill="var(--muted)" font-size="10" font-weight="600" text-anchor="middle">12:00 PM</text>
                <text x="450" y="145" fill="var(--muted)" font-size="10" font-weight="600" text-anchor="middle">6:00 PM</text>

                <!-- Current time tracker dot -->
                <circle id="solarTrackerDot" cx="50" cy="130" r="7" fill="var(--amber)" stroke="#fff" stroke-width="2" filter="url(#glow)" style="display: none;" />
              </svg>
            </div>
            <span style="color:var(--muted);font-size:.78rem;margin-top:10px;display:block;text-align:center;">Solar curve simulates current time-of-day output based on plant capacity ({{ $activeSite->capacity_kw }} kW).</span>
          </div>

          <!-- Recent Activity Panel -->
          <div class="panel">
            <h3><i class="ri-notification-3-line text-primary" style="margin-right:6px;"></i> Recent activity</h3>
            @forelse($notifications->take(4) as $notif)
              <div class="notif-item {{ !$notif->is_read ? 'unread' : '' }}">
                <span class="dot"></span>
                <div>
                  <b>{{ $notif->title }}</b>
                  <span>{{ $notif->message }}</span>
                </div>
              </div>
            @empty
              <p style="color:var(--muted);font-size:0.88rem;margin:10px 0;">No new notifications right now.</p>
            @endforelse
          </div>
        </div>
      </div>

      <!-- 2. REWARD WALLET -->
      <div id="tab-wallet" class="dash-tab-content">
        <div class="wallet-hero">
          <div>
            <div class="lbl"><i class="ri-wallet-3-fill text-warning" style="margin-right:6px;"></i> AES Reward Wallet Balance</div>
            <div class="amount">₹<span class="counter" data-target="{{ round($user->wallet_balance) }}">{{ number_format($user->wallet_balance, 0) }}</span></div>
            <div style="font-size: 0.82rem; color: rgba(255,255,255,0.88); margin-top: 4px;">
              Max Withdrawable: <b>₹{{ number_format(max(0, round($user->wallet_balance - 5000)), 0) }}</b> (₹5,000 min balance retained)
            </div>
          </div>
          <button class="btn btn-amber" style="padding: 12px 26px; font-weight: 700; font-size: 0.95rem; border-radius: 30px; box-shadow: 0 6px 20px rgba(0,0,0,0.18);" onclick="openPayoutModal()">
            <i class="ri-hand-coin-line" style="font-size:1.1rem; margin-right:4px;"></i> Request Withdrawal →
          </button>
        </div>

        <!-- MY WITHDRAWAL REQUESTS & STATUS TABLE -->
        <div class="panel" style="margin-bottom: 24px;">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
            <h3><i class="ri-hand-coin-line text-warning" style="margin-right:6px;"></i> My Withdrawal Requests &amp; Status</h3>
            <button class="btn btn-primary" style="padding: 6px 14px; font-size: 0.82rem;" onclick="openPayoutModal()">+ New Request</button>
          </div>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Request Date</th>
                  <th>Requested Amount</th>
                  <th>Payout / Bank Details</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($payoutRequests as $payout)
                  <tr>
                    <td><b>{{ $payout->created_at->format('d M Y, h:i A') }}</b></td>
                    <td style="font-weight:700; color:#0284c7;">₹{{ number_format($payout->amount, 0) }}</td>
                    <td>{{ $payout->description }}</td>
                    <td>
                      <span class="badge {{ $payout->status == 'Approved' || $payout->status == 'Credited' ? 'success' : ($payout->status == 'Pending' ? 'pending' : 'failed') }}">
                        {{ $payout->status }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" style="text-align:center; color:var(--muted); padding: 18px 10px;">
                      No withdrawal requests submitted yet. Click <b>Request Withdrawal</b> to submit your request.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- WALLET CREDIT & DEBIT HISTORY TABLE -->
        <div class="panel">
          <h3><i class="ri-history-line text-primary" style="margin-right:6px;"></i> Wallet Credit &amp; Debit History</h3>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($walletTransactions as $tx)
                  <tr>
                    <td>{{ $tx->created_at->format('d M Y') }}</td>
                    <td>{{ $tx->title }} <br><span style="color:var(--muted);font-size:0.8rem;">{{ $tx->description }}</span></td>
                    <td>{{ $tx->type }}</td>
                    <td style="font-weight:600; color: {{ $tx->type == 'Credit' ? '#16a34a' : '#ef4444' }};">
                      {{ $tx->type == 'Credit' ? '+' : '-' }}₹{{ number_format($tx->amount, 0) }}
                    </td>
                    <td>
                      <span class="badge {{ $tx->status == 'Credited' || $tx->status == 'Approved' ? 'success' : ($tx->status == 'Pending' ? 'pending' : 'failed') }}">
                        {{ $tx->status }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align:center;color:var(--muted);">No transactions yet. Start referring friends to earn rewards!</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- 3. REFER & EARN -->
      <div id="tab-refer" class="dash-tab-content">
        <div class="refer-hero">
          <div>
            <span class="eyebrow" style="color:var(--blue-600);font-weight:700;">Your unique code</span>
            <div class="code-box" style="margin-top:10px;">
              <span id="refCode">{{ $user->referral_code }}</span>
              <button class="copy-btn" id="copyBtn" onclick="copyReferralCode()">Copy</button>
            </div>
            <div class="share-row">
              <a class="share-btn wa" href="https://api.whatsapp.com/send?text=Hey!%20I%20installed%20rooftop%20solar%20with%20AES%20Energy%20and%20cut%20my%20bill%20to%20almost%20zero.%20Use%20my%20referral%20code%20*{{ $user->referral_code }}*%20to%20get%20a%20free%20site%20survey%20and%20subsidy%20help:%20{{ url('/?ref=' . $user->referral_code) }}" target="_blank">
                <i class="ri-whatsapp-fill" style="margin-right:4px;"></i> WhatsApp
              </a>
              <a class="share-btn sms" href="sms:?body=Check%20out%20AES%20Energy%20for%20rooftop%20solar.%20Use%20my%20referral%20code%20{{ $user->referral_code }}:%20{{ url('/?ref=' . $user->referral_code) }}">
                <i class="ri-chat-1-line" style="margin-right:4px;"></i> SMS
              </a>
              <a class="share-btn link" href="#" onclick="copyShareLink(); return false;">
                <i class="ri-link-m" style="margin-right:4px;"></i> Copy Link
              </a>
            </div>
          </div>
          <div>
            <div class="flow-row">
              <div class="flow-step"><div class="ic"><i class="ri-group-line"></i></div><span>You Refer</span><div class="flow-line"></div></div>
              <div class="flow-step"><div class="ic"><i class="ri-sun-line"></i></div><span>They Install</span><div class="flow-line"></div></div>
              <div class="flow-step"><div class="ic"><i class="ri-wallet-3-line"></i></div><span>You Earn</span></div>
            </div>
            <div class="reward-cta">
              <div><b>₹500–₹700</b><br><span>per successful referral installation</span></div>
              <span>Instant Wallet Credit</span>
            </div>
          </div>
        </div>

        <div class="panel">
          <h3>Submit a Referral Manually</h3>
          <form id="manualReferralForm" onsubmit="submitManualReferral(event)" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; align-items: end;">
            <div class="field">
              <label>Friend's Full Name</label>
              <input type="text" name="referee_name" placeholder="e.g. Ramesh Patel" required>
            </div>
            <div class="field">
              <label>Mobile Number</label>
              <input type="tel" name="referee_mobile" placeholder="+91 98765 43210" required>
            </div>
            <div class="field">
              <label>City</label>
              <input type="text" name="referee_city" placeholder="e.g. Pune, Mumbai, Nashik">
            </div>
            <div class="field" style="grid-column: span 2;">
              <label>Referral Promotion Rule</label>
              <select name="referral_point_setting_id" required>
                <option value="">-- Select Referral Program --</option>
                @foreach($referralPointSettings as $setting)
                  <option value="{{ $setting->id }}">
                    {{ $setting->title }} ({{ $setting->type == 'Credit' ? '+' : '-' }}₹{{ number_format($setting->amount, 0) }})
                  </option>
                @endforeach
              </select>
            </div>
            <div style="grid-column: span 1;">
              <button class="btn btn-primary" type="submit" id="refSubmitBtn" style="width: 100%; height: 46px; border-radius: 10px; font-weight: 600; font-size: 0.92rem; display: flex; align-items: center; justify-content: center;">
                Submit Referral
              </button>
            </div>
          </form>
        </div>

        <div class="panel">
          <h3>Referral Status</h3>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Friend Name</th>
                  <th>Mobile</th>
                  <th>Date Referred</th>
                  <th>Stage</th>
                  <th>Reward</th>
                  <th>Reward Status</th>
                </tr>
              </thead>
              <tbody id="referralTableBody">
                @forelse($referrals as $ref)
                  <tr>
                    <td><b>{{ $ref->referee_name }}</b></td>
                    <td>{{ substr($ref->referee_mobile, 0, 3) . '****' . substr($ref->referee_mobile, -3) }}</td>
                    <td>{{ $ref->created_at->format('d M Y') }}</td>
                    <td>
                      <span class="badge {{ $ref->stage == 'Installed' || $ref->stage == 'Commissioned' ? 'success' : ($ref->stage == 'Rejected' ? 'failed' : 'pending') }}">
                        {{ $ref->stage }}
                      </span>
                    </td>
                    <td style="font-weight:600; color: {{ $ref->reward_status == 'Credited' ? '#16a34a' : '#0284c7' }};">
                      ₹{{ number_format($ref->reward_amount, 0) }}
                    </td>
                    <td>
                      <span class="badge {{ $ref->reward_status == 'Credited' ? 'success' : ($ref->reward_status == 'Rejected' ? 'failed' : 'pending') }}">
                        {{ $ref->reward_status }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" style="text-align:center;color:var(--muted);">No referrals submitted yet. Use the form above or share your code to start earning!</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- 4. SERVICE REQUESTS -->
      <div id="tab-service" class="dash-tab-content">
        <div class="panel">
          <h3>Raise a Service Request</h3>
          <form id="serviceRequestForm" onsubmit="submitServiceReq(event)" enctype="multipart/form-data" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; align-items: end;">
            <div class="field">
              <label>Select Plant / Site</label>
              <select name="customer_site_id" required>
                @foreach($sites as $site)
                  <option value="{{ $site->id }}" {{ $site->id == $activeSite->id ? 'selected' : '' }}>
                    {{ $site->site_name }} ({{ $site->capacity_kw }} kW - {{ $site->city }})
                  </option>
                @endforeach
              </select>
            </div>
            <div class="field">
              <label>Issue Type</label>
              <select name="issue_type" required>
                <option value="">Select issue</option>
                @foreach($issueTypes as $it)
                  <option value="{{ $it->title }}">{{ $it->title }}</option>
                @endforeach
              </select>
            </div>
            <div class="field">
              <label>Preferred Visit Date</label>
              <input type="date" name="preferred_date" value="{{ date('Y-m-d', strtotime('+2 days')) }}">
            </div>
            <div class="field" style="grid-column: 1 / -1;">
              <label>Describe the issue</label>
              <textarea name="description" rows="3" placeholder="Tell us what's happening or any error code on inverter"></textarea>
            </div>
            <div class="field" style="grid-column: 1 / -1;">
              <label>Attach Photos / Images (Multiple Allowed)</label>
              <input type="file" name="images[]" multiple accept="image/*" style="background:#fff; padding: 8px 12px; border: 1px dashed #b7dcf7; border-radius: 10px; cursor: pointer;">
              <span style="font-size:0.76rem; color:var(--muted); margin-top:2px;">Select multiple site or inverter photos (JPG, PNG, WEBP max 10MB each).</span>
            </div>
            <div style="grid-column: 1 / -1; display: flex; justify-content: flex-start;">
              <button class="btn btn-primary" type="submit" id="srvSubmitBtn" style="padding: 12px 32px; border-radius: 10px; font-weight: 600; font-size: 0.92rem;">
                Submit Service Request
              </button>
            </div>
          </form>
        </div>

        <div class="panel">
          <h3>My Service Requests</h3>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Ticket</th>
                  <th>Site</th>
                  <th>Issue</th>
                  <th>Attached Photos</th>
                  <th>Raised On</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="serviceTableBody">
                @forelse($serviceRequests as $srv)
                  <tr>
                    <td><b>{{ $srv->ticket_no }}</b></td>
                    <td>{{ optional($srv->site)->site_name ?? 'Primary Plant' }}</td>
                    <td>{{ $srv->issue_type }}</td>
                    <td>
                      @php $photos = $srv->getMedia('service_images'); @endphp
                      @if($photos->count() > 0)
                        <div style="display:flex; gap:6px; flex-wrap:wrap; align-items:center;">
                          @foreach($photos as $photo)
                            <a href="{{ $photo->getUrl() }}" target="_blank" title="View Full Image">
                              <img src="{{ $photo->getUrl() }}" alt="Photo" style="width:38px; height:38px; object-fit:cover; border-radius:6px; border:1px solid #cbd5e1; box-shadow:0 2px 4px rgba(0,0,0,0.08);">
                            </a>
                          @endforeach
                        </div>
                      @else
                        <span style="color:var(--muted); font-size:0.8rem;">No Photos</span>
                      @endif
                    </td>
                    <td>{{ $srv->created_at->format('d M Y') }}</td>
                    <td>
                      <span class="badge {{ $srv->status == 'Resolved' ? 'success' : ($srv->status == 'In Progress' ? 'processing' : 'pending') }}">
                        {{ $srv->status }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" style="text-align:center;color:var(--muted);">No service requests logged. Everything is running smoothly!</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- 5. WARRANTY & DOCUMENTS -->
      <div id="tab-warranty" class="dash-tab-content">
        <div class="panel">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <h3>Warranty &amp; Documents</h3>
            <span style="font-size:0.85rem; color:var(--muted);">Plant: <b>{{ $activeSite->site_name }}</b></span>
          </div>

          @forelse($documents as $doc)
            <div class="doc-row">
              <div class="left">
                <div class="ic"><i class="ri-file-pdf-line text-danger"></i></div>
                <div>
                  <b>{{ $doc->title }}</b><br>
                  <span style="color:var(--muted);font-size:.82rem;">
                    {{ $doc->notes ?? $doc->doc_type }} · {{ $doc->valid_until ? 'Valid until ' . $doc->valid_until->format('M Y') : 'Active' }}
                  </span>
                </div>
              </div>
              @if(!empty($doc->file_path))
                <a href="{{ asset($doc->file_path) }}" target="_blank" download class="btn btn-primary" style="padding:8px 16px; font-size:.85rem; text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 17v-6" /><path d="M9.5 14.5l2.5 2.5l2.5 -2.5" /></svg> Download PDF
                </a>
              @else
                <button class="btn btn-ghost" onclick="showToast('Document file will be uploaded shortly by AES engineers.', 'info')">Download PDF</button>
              @endif
            </div>
          @empty
            <p style="color:var(--muted);font-size:0.88rem;">No documents uploaded yet for this site.</p>
          @endforelse
        </div>
      </div>

      <!-- 6. MY SOLAR PLANT -->
      <div id="tab-plant" class="dash-tab-content">
        <div class="stat-grid">
          <div class="stat-card">
            <div class="ic"><i class="ri-battery-charge-fill text-warning"></i></div>
            <div class="val">{{ $activeSite->capacity_kw }} kW</div>
            <div class="lbl">System Capacity</div>
          </div>
          <div class="stat-card">
            <div class="ic"><i class="ri-calendar-event-fill text-success"></i></div>
            <div class="val">{{ optional($activeSite->installation_date)->format('d M Y') ?? '12 May 2026' }}</div>
            <div class="lbl">Installed On</div>
          </div>
          <div class="stat-card">
            <div class="ic"><i class="ri-receipt-fill text-primary"></i></div>
            <div class="val">{{ $activeSite->system_type }}</div>
            <div class="lbl">System Type</div>
          </div>
          <div class="stat-card">
            <div class="ic"><i class="ri-seedling-fill text-success"></i></div>
            <div class="val">{{ $activeSite->co2_offset_ton }} T</div>
            <div class="lbl">CO₂ Offset</div>
          </div>
        </div>

        <div class="panel">
          <h3>Plant Hardware &amp; Connection Specs</h3>
          <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:16px; margin-top:14px; font-size:0.88rem;">
            <div><span style="color:var(--muted);">Inverter:</span><br><b>{{ $activeSite->inverter_details ?? 'AES Smart Hybrid Inverter 5kW' }}</b></div>
            <div><span style="color:var(--muted);">Panels:</span><br><b>{{ $activeSite->panel_details ?? 'Tier-1 Mono PERC 540W Modules' }}</b></div>
            <div><span style="color:var(--muted);">Location:</span><br><b>{{ $activeSite->city ?? 'Pune' }}, {{ $activeSite->state ?? 'Maharashtra' }}</b></div>
            <div><span style="color:var(--muted);">Consumer ID:</span><br><b>{{ $activeSite->consumer_number ?? 'MSEDCL-482910' }}</b></div>
          </div>
        </div>

        <div class="panel">
          <h3><i class="ri-bar-chart-fill text-primary" style="margin-right:6px;"></i> Yearly Generation Curve ({{ $activeSite->site_name }})</h3>
          @php
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            $factors = [0.85, 1.00, 1.20, 1.25, 1.15, 0.90, 0.70, 0.75, 0.95, 1.05, 0.95, 0.80];
            $points = [];
            $svgPoints = "";
            $areaPoints = "40,130 ";
            foreach ($months as $i => $m) {
                $x = 40 + $i * 47.27;
                $factor = $factors[$i];
                $variation = 1 + ((($activeSite->id + $i) % 8) - 4) / 100;
                $kwh = ($activeSite->monthly_avg_kwh ?? 612) * $factor * $variation;
                
                $y = 130 - ($kwh / (($activeSite->monthly_avg_kwh ?? 612) * 1.45)) * 110;
                $y = max(20, min(120, $y));
                
                $points[] = ['x' => round($x, 1), 'y' => round($y, 1), 'kwh' => round($kwh), 'month' => $m];
                $svgPoints .= round($x, 1) . "," . round($y, 1) . " ";
                $areaPoints .= round($x, 1) . "," . round($y, 1) . " ";
            }
            $areaPoints .= "560,130 Z";
            $currentMonthIdx = date('n') - 1;
            $currentMonthDot = $points[$currentMonthIdx] ?? $points[7];
          @endphp

          <!-- SVG Yearly Curve Chart -->
          <div style="position: relative; background: #f8fafc; border-radius: 14px; border: 1px solid #e2e8f0; padding: 15px 10px 5px; overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <svg width="100%" height="160" viewBox="0 0 600 160" style="display: block; min-width: 580px; margin: 0 auto;">
              <defs>
                <linearGradient id="yearlyGradient" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="0%" stop-color="var(--blue-500)" stop-opacity="0.3"/>
                  <stop offset="100%" stop-color="var(--blue-500)" stop-opacity="0.0"/>
                </linearGradient>
                <linearGradient id="yearlyStroke" x1="0" y1="0" x2="1" y2="0">
                  <stop offset="0%" stop-color="var(--blue-400)"/>
                  <stop offset="35%" stop-color="var(--amber)"/>
                  <stop offset="70%" stop-color="var(--blue-600)"/>
                  <stop offset="100%" stop-color="var(--blue-900)"/>
                </linearGradient>
                <filter id="yearlyGlow" x="-20%" y="-20%" width="140%" height="140%">
                  <feGaussianBlur stdDeviation="3" result="blur" />
                  <feComposite in="SourceGraphic" in2="blur" operator="over" />
                </filter>
              </defs>

              <!-- Grid helper lines -->
              <line x1="40" y1="130" x2="560" y2="130" stroke="#cbd5e1" stroke-width="1" />
              <line x1="40" y1="75" x2="560" y2="75" stroke="#e2e8f0" stroke-width="0.75" stroke-dasharray="2,2" />
              <line x1="40" y1="20" x2="560" y2="20" stroke="#e2e8f0" stroke-width="0.75" stroke-dasharray="2,2" />

              <!-- Filled area under curve -->
              <polygon points="{{ $areaPoints }}" fill="url(#yearlyGradient)" />

              <!-- Stroke line curve -->
              <polyline points="{{ $svgPoints }}" fill="none" stroke="url(#yearlyStroke)" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" />

              <!-- Data vertex points -->
              @foreach($points as $pt)
                <circle cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}" r="4.5" fill="#fff" stroke="var(--blue-600)" stroke-width="2.5" 
                        class="yearly-point" data-label="{{ $pt['month'] }}" data-value="{{ $pt['kwh'] }} kWh" style="cursor: pointer;" />
              @endforeach

              <!-- Text labels -->
              @foreach($points as $pt)
                <text x="{{ $pt['x'] }}" y="146" fill="var(--muted)" font-size="9" font-weight="600" text-anchor="middle">{{ $pt['month'] }}</text>
              @endforeach

              <!-- Current month glowing tracker dot -->
              <circle cx="{{ $currentMonthDot['x'] }}" cy="{{ $currentMonthDot['y'] }}" r="7.5" fill="var(--amber)" stroke="#fff" stroke-width="2" filter="url(#yearlyGlow)" 
                      class="yearly-point" data-label="Current Month ({{ $currentMonthDot['month'] }})" data-value="{{ $currentMonthDot['kwh'] }} kWh" style="cursor: pointer;" />
            </svg>
          </div>
          <span style="color:var(--muted);font-size:.82rem;margin-top:10px;display:block;text-align:center;">Yearly Generation Profile ({{ date('Y') }}) · Estimated Annual Generation: <b>{{ number_format(($activeSite->monthly_avg_kwh ?? 612) * 12) }} kWh</b></span>
        </div>
      </div>

      <!-- 7. MY PROFILE -->
      <div id="tab-profile" class="dash-tab-content">
        <div class="panel">
          <div class="profile-head">
            <div class="profile-avatar">{{ $initials }}</div>
            <div>
              <h3 style="margin-bottom:4px;">{{ $user->name }}</h3>
              <span style="color:var(--muted);font-size:.85rem;">Customer since {{ $user->created_at->format('M Y') }} · {{ $user->city ?? 'Pune' }}, {{ $user->state ?? 'Maharashtra' }}</span>
            </div>
          </div>

          <form id="profileForm" onsubmit="submitProfileUpdate(event)">
            <div class="profile-grid" style="margin-top:20px;">
              <div class="field">
                <label>Full Name</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
              </div>
              <div class="field">
                <label>Mobile Number</label>
                <input type="tel" value="{{ $user->mobile }}" disabled style="background:#f8fafc; cursor:not-allowed;">
              </div>
              <div class="field">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ $user->email }}">
              </div>
              <div class="field">
                <label>City</label>
                <input type="text" name="city" value="{{ $user->city ?? 'Pune' }}">
              </div>
              <div class="field" style="grid-column: 1 / -1;">
                <label>Installation Address</label>
                <input type="text" name="address" value="{{ $user->address ?? 'Baner, Pune, Maharashtra' }}">
              </div>
            </div>
            <button class="btn btn-primary" type="submit" id="profSaveBtn" style="margin-top:18px;">
              Save Changes
            </button>
          </form>
        </div>
      </div>

      <!-- 8. NOTIFICATIONS -->
      <div id="tab-notifications" class="dash-tab-content">
        <div class="panel">
          <h3>Customer Notifications Feed</h3>
          @forelse($notifications as $notif)
            <div class="notif-item {{ !$notif->is_read ? 'unread' : '' }}" onclick="markNotifRead({{ $notif->id }}, this)">
              <span class="dot"></span>
              <div>
                <b>{{ $notif->title }}</b>
                <span>{{ $notif->message }}</span>
                <span style="display:block; font-size:0.75rem; color:#94a3b8; margin-top:2px;">{{ $notif->created_at->diffForHumans() }}</span>
              </div>
            </div>
          @empty
            <p style="color:var(--muted);font-size:0.88rem;margin:10px 0;">No notifications found.</p>
          @endforelse
        </div>
      </div>

    </main>
  </div>
</div>

<!-- PAYOUT MODAL -->
<div class="modal-overlay" id="payoutModal">
  <div class="modal-card">
    <h3 style="margin-bottom:8px;">Request Reward Withdrawal</h3>
    @php
      $maxWithdrawable = max(0, round($user->wallet_balance - 5000));
    @endphp
    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px 14px; margin-bottom: 14px; font-size: 0.86rem; line-height: 1.6;">
      <div>Total Wallet Balance: <b style="color:var(--blue-900);">₹{{ number_format($user->wallet_balance, 0) }}</b></div>
      <div>Retained Minimum Balance: <b style="color:#d97706;">₹5,000</b></div>
      <div style="border-top: 1px dashed #cbd5e1; margin-top: 6px; padding-top: 6px; font-weight: 600; color: #16a34a;">
        Max Withdrawable Amount: <b>₹{{ number_format($maxWithdrawable, 0) }}</b>
      </div>
    </div>

    @if($user->wallet_balance < 5000)
      <div style="background:#fff3d6; border:1px solid #f59e0b; color:#92400e; padding:12px 14px; border-radius:12px; font-size:0.82rem; margin-bottom:16px; line-height:1.5;">
        <i class="ri-error-warning-line" style="font-size:1.1rem; vertical-align:-2px; margin-right:4px;"></i>
        <b>Withdrawal Locked:</b> Minimum ₹5,000 wallet balance required to request payout. Keep referring friends to earn more!
      </div>
    @elseif($maxWithdrawable < 1000)
      <div style="background:#fff3d6; border:1px solid #f59e0b; color:#92400e; padding:12px 14px; border-radius:12px; font-size:0.82rem; margin-bottom:16px; line-height:1.5;">
        <i class="ri-error-warning-line" style="font-size:1.1rem; vertical-align:-2px; margin-right:4px;"></i>
        <b>Insufficient Balance:</b> Minimum withdrawal request is ₹1,000 while retaining ₹5,000 in your wallet. You have ₹{{ number_format($maxWithdrawable) }} withdrawable right now.
      </div>
    @else
      <div style="background:#e0f2fe; border:1px solid #38bdf8; color:#0369a1; padding:10px 14px; border-radius:12px; font-size:0.8rem; margin-bottom:16px;">
        <i class="ri-information-line" style="vertical-align:-1px; margin-right:4px;"></i>
        Minimum withdrawal is <b>₹1,000</b>. Default status is <b>Pending</b> until Admin approval.
      </div>
    @endif

    <form id="payoutForm" onsubmit="submitPayoutReq(event)">
      <div class="field">
        <label>Withdrawal Amount (₹)</label>
        <input type="number" name="amount" id="payoutAmount" value="{{ $maxWithdrawable >= 1000 ? $maxWithdrawable : 1000 }}" min="1000" max="{{ $maxWithdrawable }}" required {{ ($user->wallet_balance < 5000 || $maxWithdrawable < 1000) ? 'disabled' : '' }}>
      </div>
      <div class="field">
        <label>UPI ID or Bank Account Details</label>
        <input type="text" name="payout_details" placeholder="e.g. yourname@upi or HDFC Bank A/c 98213..." required {{ ($user->wallet_balance < 5000 || $maxWithdrawable < 1000) ? 'disabled' : '' }}>
      </div>
      <div style="display:flex; gap:10px; margin-top:20px;">
        <button class="btn btn-primary" type="submit" id="payoutBtn" style="flex:1; justify-content:center;" {{ ($user->wallet_balance < 5000 || $maxWithdrawable < 1000) ? 'disabled style=opacity:0.5;cursor:not-allowed;' : '' }}>Submit Request</button>
        <button class="btn btn-ghost" type="button" onclick="closePayoutModal()">Cancel</button>
      </div>
    </form>
  </div>
</div>

<div id="toast"></div>
<div id="chartTooltip" class="chart-tooltip"></div>

<script src="{{ asset('js/frontend.js') }}"></script>
<script>
  function switchDashboardTab(tabId, el) {
    if (!tabId) return;

    document.querySelectorAll('.dash-tab-content').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.dash-nav-btn').forEach(btn => btn.classList.remove('active'));

    const targetTab = document.getElementById(tabId);
    if (targetTab) {
      targetTab.classList.add('active');
    }

    const targetBtn = el || document.querySelector(`.dash-nav-btn[data-tab="${tabId}"]`);
    if (targetBtn) {
      targetBtn.classList.add('active');
    }

    // Save active tab state to URL hash and localStorage
    if (history.replaceState) {
      history.replaceState(null, null, '#' + tabId);
    } else {
      location.hash = '#' + tabId;
    }
    localStorage.setItem('active_customer_tab', tabId);

    // Auto-close sidebar on mobile/responsive view
    const sb = document.getElementById('sidebar');
    if (sb && sb.classList.contains('open')) {
      sb.classList.remove('open');
    }
  }

  function copyReferralCode() {
    const code = document.getElementById('refCode').innerText;
    navigator.clipboard.writeText(code).then(() => {
      showToast('Referral Code ' + code + ' copied to clipboard!', 'success');
    });
  }

  function copyShareLink() {
    const link = "{{ url('/?ref=' . $user->referral_code) }}";
    navigator.clipboard.writeText(link).then(() => {
      showToast('Referral link copied! Share with friends.', 'success');
    });
  }

  function openPayoutModal() {
    document.getElementById('payoutModal').classList.add('active');
  }

  function closePayoutModal() {
    document.getElementById('payoutModal').classList.remove('active');
  }

  function submitManualReferral(e) {
    e.preventDefault();
    const btn = document.getElementById('refSubmitBtn');
    btn.disabled = true;
    btn.innerText = 'Submitting...';

    const formData = new FormData(document.getElementById('manualReferralForm'));

    fetch("{{ route('customer.submitReferral') }}", {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      btn.disabled = false;
      btn.innerText = 'Submit Referral';
      if (data.success) {
        showToast(data.message, 'success');
        document.getElementById('manualReferralForm').reset();
        setTimeout(() => location.reload(), 1200);
      } else {
        showToast(data.message || 'Error submitting referral', 'error');
      }
    })
    .catch(err => {
      btn.disabled = false;
      btn.innerText = 'Submit Referral';
      showToast('Error submitting referral. Please try again.', 'error');
    });
  }

  function submitServiceReq(e) {
    e.preventDefault();
    const btn = document.getElementById('srvSubmitBtn');
    btn.disabled = true;
    btn.innerText = 'Submitting Request...';

    const formData = new FormData(document.getElementById('serviceRequestForm'));

    fetch("{{ route('customer.submitService') }}", {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      btn.disabled = false;
      btn.innerText = 'Submit Service Request';
      if (data.success) {
        showToast(data.message, 'success');
        document.getElementById('serviceRequestForm').reset();
        setTimeout(() => location.reload(), 1200);
      } else {
        showToast(data.message || 'Error submitting service request', 'error');
      }
    })
    .catch(err => {
      btn.disabled = false;
      btn.innerText = 'Submit Service Request';
      showToast('Failed to submit service ticket.', 'error');
    });
  }

  function submitPayoutReq(e) {
    e.preventDefault();
    const btn = document.getElementById('payoutBtn');
    btn.disabled = true;
    btn.innerText = 'Processing...';

    const formData = new FormData(document.getElementById('payoutForm'));

    fetch("{{ route('customer.requestPayout') }}", {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      btn.disabled = false;
      btn.innerText = 'Submit Request';
      if (data.success) {
        closePayoutModal();
        showToast(data.message, 'success');
        setTimeout(() => location.reload(), 1200);
      } else {
        showToast(data.message || 'Error requesting payout', 'error');
      }
    })
    .catch(err => {
      btn.disabled = false;
      btn.innerText = 'Submit Request';
      showToast('Error requesting payout.', 'error');
    });
  }

  function submitProfileUpdate(e) {
    e.preventDefault();
    const btn = document.getElementById('profSaveBtn');
    btn.disabled = true;
    btn.innerText = 'Saving...';

    const formData = new FormData(document.getElementById('profileForm'));

    fetch("{{ route('customer.updateProfile') }}", {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      btn.disabled = false;
      btn.innerText = 'Save Changes';
      if (data.success) {
        showToast(data.message, 'success');
      } else {
        showToast(data.message || 'Error saving profile', 'error');
      }
    })
    .catch(err => {
      btn.disabled = false;
      btn.innerText = 'Save Changes';
      showToast('Error updating profile.', 'error');
    });
  }

  function markNotifRead(notifId, el) {
    fetch("{{ url('/customer/notifications') }}/" + notifId + "/read", {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    }).then(() => {
      el.classList.remove('unread');
    });
  }

  // Daily Solar Generation Curve live update
  function updateSolarGenerationCurve() {
    let capacity = parseFloat("{{ $activeSite->capacity_kw }}") || 6.4;
    let peak = (capacity * 0.8).toFixed(1);
    let total = (capacity * 4.2).toFixed(1);

    let now = new Date();
    let hour = now.getHours();
    let min = now.getMinutes();
    let timeDecimal = hour + min / 60;

    let currentKw = 0;
    let dotCx = 50;
    let dotCy = 130;
    let showDot = false;

    if (timeDecimal >= 6 && timeDecimal <= 18) {
      let pct = (timeDecimal - 6) / 12;
      dotCx = 50 + pct * 400;
      dotCy = 130 - 110 * Math.sin(pct * Math.PI);
      currentKw = (peak * Math.sin(pct * Math.PI)).toFixed(2);
      showDot = true;
    }

    document.getElementById('liveCurrentOutput').innerText = currentKw + ' kW';
    document.getElementById('livePeakOutput').innerText = peak + ' kW';
    document.getElementById('liveTotalToday').innerText = total + ' kWh';

    let trackerDot = document.getElementById('solarTrackerDot');
    if (trackerDot) {
      if (showDot) {
        trackerDot.setAttribute('cx', dotCx);
        trackerDot.setAttribute('cy', dotCy);
        trackerDot.style.display = 'block';
      } else {
        trackerDot.style.display = 'none';
      }
    }
  }

  // Run on load
  document.addEventListener('DOMContentLoaded', () => {
    updateSolarGenerationCurve();

    // Auto-restore active tab from URL hash or localStorage upon refresh/submission
    let savedTab = window.location.hash ? window.location.hash.replace('#', '') : localStorage.getItem('active_customer_tab');
    if (savedTab && document.getElementById(savedTab)) {
      const savedBtn = document.querySelector(`.dash-nav-btn[data-tab="${savedTab}"]`);
      switchDashboardTab(savedTab, savedBtn);
    }

    const tooltip = document.getElementById('chartTooltip');

    // Bind event listeners for custom interactive tooltips on curve vertices
    document.querySelectorAll('.daily-point, .yearly-point').forEach(point => {
      point.addEventListener('mouseenter', () => {
        const label = point.getAttribute('data-label');
        const val = point.getAttribute('data-value');
        tooltip.innerHTML = `<strong>${label}</strong>: ${val}`;
        tooltip.style.opacity = '1';
      });

      point.addEventListener('mousemove', () => {
        const rect = point.getBoundingClientRect();
        tooltip.style.left = (window.scrollX + rect.left + rect.width / 2) + 'px';
        tooltip.style.top = (window.scrollY + rect.top) + 'px';
      });

      point.addEventListener('mouseleave', () => {
        tooltip.style.opacity = '0';
      });
    });
  });
</script>
</body>
</html>
