<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>AES One Dashboard — AES Energy</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
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
</style>
</head>
<body>

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

      <div style="display:flex; align-items:center; gap:16px;">
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
          {{ $user->name }}
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
          <button class="btn btn-amber" onclick="switchDashboardTab('tab-refer', document.querySelector('[data-tab=tab-refer]'))">
            Refer More Friends →
          </button>
        </div>

        <!-- STATS GRID -->
        <div class="stat-grid">
          <div class="stat-card">
            <div class="ic"><i class="ri-flashlight-fill text-warning"></i></div>
            <div class="val"><span class="counter" data-target="{{ round($activeSite->monthly_avg_kwh ?? 612) }}">{{ round($activeSite->monthly_avg_kwh ?? 612) }}</span> kWh</div>
            <div class="lbl">Generated this month ({{ $activeSite->site_name }})</div>
          </div>
          <div class="stat-card">
            <div class="ic"><i class="ri-lightbulb-fill text-success"></i></div>
            <div class="val">₹<span class="counter" data-target="{{ round($estimatedSavings) }}">{{ number_format($estimatedSavings, 0) }}</span></div>
            <div class="lbl">Bill savings (est.)</div>
          </div>
          <div class="stat-card">
            <div class="ic"><i class="ri-group-fill text-primary"></i></div>
            <div class="val"><span class="counter" data-target="{{ $totalReferred }}">{{ $totalReferred }}</span></div>
            <div class="lbl">Friends referred</div>
          </div>
          <div class="stat-card">
            <div class="ic"><i class="ri-tools-fill text-info"></i></div>
            <div class="val"><span class="counter" data-target="{{ $openServiceRequestsCount }}">{{ $openServiceRequestsCount }}</span></div>
            <div class="lbl">Open service requests</div>
          </div>
        </div>

        <div class="two-col">
          <!-- Generation Panel -->
          <div class="panel">
            <h3><i class="ri-bar-chart-line text-primary" style="margin-right:6px;"></i> Generation, last 7 days</h3>
            <div class="plant-viz">
              <div class="sun-mini"></div>
              <div class="bar" style="height:60%;animation-delay:.05s;"></div>
              <div class="bar" style="height:80%;animation-delay:.1s;"></div>
              <div class="bar" style="height:45%;animation-delay:.15s;"></div>
              <div class="bar" style="height:90%;animation-delay:.2s;"></div>
              <div class="bar" style="height:70%;animation-delay:.25s;"></div>
              <div class="bar" style="height:95%;animation-delay:.3s;"></div>
              <div class="bar" style="height:65%;animation-delay:.35s;"></div>
            </div>
            <span style="color:var(--muted);font-size:.82rem;">Plant ({{ $activeSite->site_name }}) is performing 8% above the regional average.</span>
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
          </div>
          <button class="btn btn-ghost" style="background:rgba(255,255,255,.2);color:#fff;" onclick="openPayoutModal()">
            Request Payout
          </button>
        </div>

        <div class="panel">
          <h3>Wallet Credit &amp; Debit History</h3>
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
          <form class="manual-form" id="manualReferralForm" onsubmit="submitManualReferral(event)">
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
            <div class="field">
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
            <button class="btn btn-primary" type="submit" id="refSubmitBtn">Submit Referral</button>
          </form>
        </div>

        <div class="panel">
          <h3>Referral Status</h3>
          <table>
            <thead>
              <tr>
                <th>Friend Name</th>
                <th>Mobile</th>
                <th>Date Referred</th>
                <th>Stage</th>
                <th>Reward</th>
              </tr>
            </thead>
            <tbody id="referralTableBody">
              @forelse($referrals as $ref)
                <tr>
                  <td><b>{{ $ref->referee_name }}</b></td>
                  <td>{{ substr($ref->referee_mobile, 0, 3) . '****' . substr($ref->referee_mobile, -3) }}</td>
                  <td>{{ $ref->created_at->format('d M Y') }}</td>
                  <td>
                    <span class="badge {{ $ref->stage == 'Installed' ? 'success' : ($ref->stage == 'Rejected' ? 'failed' : 'processing') }}">
                      {{ $ref->stage }}
                    </span>
                  </td>
                  <td style="font-weight:600; color: {{ $ref->reward_status == 'Credited' ? '#16a34a' : '#0284c7' }};">
                    {{ $ref->reward_status == 'Credited' ? '+₹' . number_format($ref->reward_amount, 0) : '₹' . number_format($ref->reward_amount, 0) . ' (' . $ref->reward_status . ')' }}
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" style="text-align:center;color:var(--muted);">No referrals submitted yet. Use the form above or share your code to start earning!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- 4. SERVICE REQUESTS -->
      <div id="tab-service" class="dash-tab-content">
        <div class="panel">
          <h3>Raise a Service Request</h3>
          <form class="manual-form" style="grid-template-columns:1fr 1fr;" id="serviceRequestForm" onsubmit="submitServiceReq(event)">
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
                <option value="Panel cleaning">Panel cleaning</option>
                <option value="Inverter fault">Inverter fault</option>
                <option value="Low generation">Low generation</option>
                <option value="Net-metering query">Net-metering query</option>
                <option value="Annual Maintenance Visit">Annual Maintenance Visit</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="field">
              <label>Preferred Visit Date</label>
              <input type="date" name="preferred_date" value="{{ date('Y-m-d', strtotime('+2 days')) }}">
            </div>
            <div class="field" style="grid-column:1/-1;">
              <label>Describe the issue</label>
              <textarea name="description" rows="3" placeholder="Tell us what's happening or any error code on inverter"></textarea>
            </div>
            <button class="btn btn-primary" type="submit" id="srvSubmitBtn" style="grid-column:1/-1;">Submit Service Request</button>
          </form>
        </div>

        <div class="panel">
          <h3>My Service Requests</h3>
          <table>
            <thead>
              <tr>
                <th>Ticket</th>
                <th>Site</th>
                <th>Issue</th>
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
                  <td>{{ $srv->created_at->format('d M Y') }}</td>
                  <td>
                    <span class="badge {{ $srv->status == 'Resolved' ? 'success' : ($srv->status == 'In Progress' ? 'processing' : 'pending') }}">
                      {{ $srv->status }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" style="text-align:center;color:var(--muted);">No service requests logged. Everything is running smoothly!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
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
          <h3><i class="ri-bar-chart-fill text-primary" style="margin-right:6px;"></i> Monthly Generation Trend ({{ $activeSite->site_name }})</h3>
          <div class="plant-viz" style="height:210px;">
            <div class="sun-mini"></div>
            <div class="bar" style="height:50%;"></div><div class="bar" style="height:65%;"></div><div class="bar" style="height:58%;"></div>
            <div class="bar" style="height:80%;"></div><div class="bar" style="height:92%;"></div><div class="bar" style="height:88%;"></div>
            <div class="bar" style="height:70%;"></div><div class="bar" style="height:75%;"></div><div class="bar" style="height:83%;"></div>
          </div>
          <span style="color:var(--muted);font-size:.82rem;">Jan – Sep 2026 · Average Generation: <b>{{ $activeSite->monthly_avg_kwh ?? 612 }} kWh / month</b></span>
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
    <h3 style="margin-bottom:8px;">Request Reward Payout</h3>
    <p style="color:var(--muted);font-size:0.88rem;margin-bottom:18px;">
      Available Reward Balance: <b>₹{{ number_format($user->wallet_balance, 2) }}</b>
    </p>

    <form id="payoutForm" onsubmit="submitPayoutReq(event)">
      <div class="field">
        <label>Payout Amount (₹)</label>
        <input type="number" name="amount" id="payoutAmount" value="{{ round($user->wallet_balance) }}" min="100" max="{{ round($user->wallet_balance) }}" required>
      </div>
      <div class="field">
        <label>UPI ID or Bank Account Details</label>
        <input type="text" name="payout_details" placeholder="e.g. yourname@okaxis or Bank A/c No" required>
      </div>
      <div style="display:flex; gap:10px; margin-top:20px;">
        <button class="btn btn-primary" type="submit" id="payoutBtn" style="flex:1; justify-content:center;">Submit Request</button>
        <button class="btn btn-ghost" type="button" onclick="closePayoutModal()">Cancel</button>
      </div>
    </form>
  </div>
</div>

<div id="toast"></div>

<script src="{{ asset('js/frontend.js') }}"></script>
<script>
  function switchDashboardTab(tabId, el) {
    document.querySelectorAll('.dash-tab-content').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.dash-nav-btn').forEach(btn => btn.classList.remove('active'));

    const targetTab = document.getElementById(tabId);
    if (targetTab) {
      targetTab.classList.add('active');
    }
    if (el) {
      el.classList.add('active');
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
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
</script>
</body>
</html>
