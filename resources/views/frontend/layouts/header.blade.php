<div class="topbar-strip">☀️ Subsidy up to ₹78,000 under PM Surya Ghar Yojana — Free Site Survey This Week</div>
<nav class="navbar" id="navbar">
  <a href="{{ route('home') }}" class="brand"><div class="brand-mark"></div>AES Energy</a>
  <div class="nav-links" id="navLinks">
    <a href="{{ route('home') }}" class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a>
    <a href="{{ route('about') }}" class="{{ Route::currentRouteName() == 'about' ? 'active' : '' }}">About</a>
    <a href="{{ route('solutions') }}" class="{{ Route::currentRouteName() == 'solutions' ? 'active' : '' }}">Solar Solutions</a>
    <a href="{{ route('products') }}" class="{{ Route::currentRouteName() == 'products' ? 'active' : '' }}">Products</a>
    <a href="{{ route('services') }}" class="{{ Route::currentRouteName() == 'services' ? 'active' : '' }}">Services</a>
    <a href="{{ route('suryaghar') }}" class="{{ Route::currentRouteName() == 'suryaghar' ? 'active' : '' }}">PM Surya Ghar</a>
    <a href="{{ route('dealer') }}" class="{{ Route::currentRouteName() == 'dealer' ? 'active' : '' }}">Dealership</a>
    <a href="{{ route('contact') }}" class="{{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">Contact</a>
  </div>
  <div class="nav-actions">
    @if(Auth::guard('customer')->check())
      <a class="btn btn-primary" href="{{ route('customer.dashboard') }}" style="padding:8px 20px; font-weight:600; border-radius:999px;">
        ⚡ AES One Dashboard
      </a>
    @else
      <a class="btn btn-primary" href="{{ route('login') }}" style="padding:8px 22px; font-weight:600; border-radius:999px;">
        Login
      </a>
    @endif
    <button class="burger" id="burger" onclick="toggleNav()"><span></span><span></span><span></span></button>
  </div>
</nav>
