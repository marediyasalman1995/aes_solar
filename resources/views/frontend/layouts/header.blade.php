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
    <a href="{{ route('contact') }}" class="{{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">Contact</a>
  </div>
  <div class="nav-actions">
    <a class="btn btn-ghost" href="{{ route('login') }}">Customer Login</a>
    <button class="burger" id="burger" onclick="toggleNav()"><span></span><span></span><span></span></button>
  </div>
</nav>
