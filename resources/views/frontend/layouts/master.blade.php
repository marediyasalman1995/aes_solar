<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layouts.head')
</head>
<body>

<div id="publicSite">
  @include('frontend.layouts.header')

  <main id="page-content" class="page-fade">
      @yield('content')
  </main>

  @include('frontend.layouts.footer')
</div>

<div id="toast"></div>

<!-- FLOATING CONTACT WIDGET (WhatsApp & Call) -->
@php
  $floatingSetting = \App\Models\Setting::first();
@endphp
@if($floatingSetting)
  <div class="floating-contact-widget" style="position: fixed; bottom: 30px; right: 30px; z-index: 9999; display: flex; flex-direction: column; gap: 14px; align-items: center;">
    
    <!-- WhatsApp Floating Button -->
    @if($floatingSetting->whatsapp)
      <a href="{{ $floatingSetting->whatsapp }}" target="_blank" class="contact-float-btn whatsapp-float" title="Chat on WhatsApp" style="width: 56px; height: 56px; border-radius: 50%; background: #25d366; display: flex; align-items: center; justify-content: center; color: #fff; box-shadow: 0 8px 24px rgba(37, 211, 102, 0.4); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-decoration: none;" onmouseover="this.style.transform='scale(1.1) translateY(-2px)'" onmouseout="this.style.transform='scale(1) translateY(0)'">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
      </a>
    @endif

    <!-- Call Floating Button (Mobile 1) -->
    @if($floatingSetting->mobile)
      <a href="tel:+91{{ $floatingSetting->mobile }}" class="contact-float-btn call-float" title="Call Us" style="width: 56px; height: 56px; border-radius: 50%; background: #0b3d5c; display: flex; align-items: center; justify-content: center; color: #fff; box-shadow: 0 8px 24px rgba(11, 61, 92, 0.4); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-decoration: none;" onmouseover="this.style.transform='scale(1.1) translateY(-2px)'" onmouseout="this.style.transform='scale(1) translateY(0)'">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
      </a>
    @endif
  </div>
@endif

<script src="{{ asset('js/frontend.js') }}"></script>
<script>
  // Initialize scroll and reveal effects
  document.addEventListener('DOMContentLoaded', function() {
    initScrollEffects();
  });
</script>
@stack('stackedScripts')
</body>
</html>
