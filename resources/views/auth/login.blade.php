<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Login — AES Energy</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
<style>
  /* Styling overrides for login validation alerts */
  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 12px 18px;
    border-radius: 12px;
    margin-bottom: 18px;
    font-size: 0.85rem;
    font-weight: 500;
  }
  .alert-danger ul {
    margin: 0;
    padding-left: 15px;
  }
</style>
</head>
<body>

<div id="loginView" class="view">
  <div class="login-card">
    <a href="{{ route('home') }}" class="brand" style="justify-content:center;margin-bottom:18px;"><div class="brand-mark"></div>AES Energy</a>
    <h2>Welcome back</h2>
    <p class="sub">Log in to AES One — your solar dashboard</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="field">
        <label>Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
      </div>
      <div class="field">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>
      </div>
      <div style="margin-bottom: 18px; display: flex; align-items: center; gap: 8px; font-size: 0.85rem;">
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember" style="margin: 0; color: var(--muted); cursor: pointer; font-weight: 500;">Remember me</label>
      </div>
      <button class="btn btn-primary" style="width: 100%; justify-content: center;" type="submit">Login to AES One</button>
    </form>
    <div class="divider">secure customer access</div>
    <div class="otp-note">🔒 Referral rewards &amp; wallet are visible only to registered customers.</div>
    <a class="back-link" href="{{ route('home') }}">← Back to website</a>
  </div>
</div>

<div id="toast"></div>

<script src="{{ asset('js/frontend.js') }}"></script>
</body>
</html>
