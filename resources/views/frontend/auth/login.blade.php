<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Customer Login — AES Energy</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
<style>
  .otp-pill {
    display: inline-block;
    background: rgba(33, 150, 243, 0.12);
    color: #1976d2;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
    margin-top: 4px;
  }
  .quick-otp-btn {
    background: #e3f2fd;
    color: #0288d1;
    border: 1px dashed #0288d1;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.78rem;
    cursor: pointer;
    margin-left: 8px;
    transition: all 0.2s;
  }
  .quick-otp-btn:hover {
    background: #0288d1;
    color: #fff;
  }
</style>
</head>
<body>

<div id="loginView" class="view">
  <div class="login-card">
    <a href="{{ route('home') }}" class="brand" style="justify-content:center;margin-bottom:18px;">
      <div class="brand-mark"></div>AES Energy
    </a>
    <h2>Welcome back</h2>
    <p class="sub">Log in to AES One — your solar dashboard</p>

    <form id="customerLoginForm" method="POST" action="{{ route('login.otp') }}">
      @csrf
      <div class="field">
        <label>Registered Mobile Number</label>
        <input type="tel" name="mobile" id="mobileInput" placeholder="+91 98765 43210" maxlength="15" required autofocus value="{{ old('mobile') }}">
      </div>

      <div class="field">
        <label style="display:flex; justify-content:space-between; align-items:center;">
          <span>Enter OTP</span>
          <span class="otp-pill">Test OTP: <b>1234</b> <button type="button" class="quick-otp-btn" onclick="fillTestOtp()">Auto-Fill</button></span>
        </label>
        <input type="text" name="otp" id="otpInput" placeholder="Enter 4-digit OTP (1234)" maxlength="4" required>
      </div>

      <button class="btn btn-primary" id="loginSubmitBtn" style="width: 100%; justify-content: center;" type="submit">
        Login to AES One →
      </button>
    </form>

    <div class="divider">secure customer access</div>
    <div class="otp-note">🔒 Referral rewards, plant monitoring &amp; wallet are visible only to registered customers.</div>
    <a class="back-link" href="{{ route('home') }}">← Back to website</a>
  </div>
</div>

<div id="toast"></div>

<script src="{{ asset('js/frontend.js') }}"></script>
<script>
  function fillTestOtp() {
    document.getElementById('otpInput').value = '1234';
    if (!document.getElementById('mobileInput').value) {
      document.getElementById('mobileInput').value = '9876543210';
    }
    showToast('Test OTP 1234 applied!', 'info');
  }

  document.getElementById('customerLoginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('loginSubmitBtn');
    const form = this;
    const formData = new FormData(form);

    btn.disabled = true;
    btn.innerText = 'Verifying OTP...';

    fetch("{{ route('login.otp') }}", {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast(data.message, 'success');
        setTimeout(() => {
          window.location.href = data.redirect_url;
        }, 800);
      } else {
        btn.disabled = false;
        btn.innerText = 'Login to AES One →';
        showToast(data.message || 'Invalid OTP. Please enter 1234.', 'error');
      }
    })
    .catch(err => {
      btn.disabled = false;
      btn.innerText = 'Login to AES One →';
      showToast('Login failed. Please enter OTP 1234.', 'error');
    });
  });
</script>
</body>
</html>
