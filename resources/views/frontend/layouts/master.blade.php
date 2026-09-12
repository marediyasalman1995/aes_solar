<!DOCTYPE html>
<html lang="en" style="overflow-y: scroll !important; height: auto !important;">
<head>
    @include('frontend.layouts.head')
</head>
<body style="overflow-y: visible !important; height: auto !important; overflow-x: hidden !important; position: relative !important;">

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
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.601 2.326zM7.994 14.521a6.57 6.57 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.067-.315-.099-.445.099-.133.197-.513.646-.629.776-.117.13-.232.148-.43.05-.197-.099-.833-.307-1.587-.98-.588-.525-.986-1.175-1.103-1.372-.116-.197-.012-.304.086-.403.088-.088.197-.232.296-.347.099-.117.132-.197.197-.33.066-.133.033-.248-.016-.347-.05-.099-.445-1.072-.61-1.47-.16-.388-.325-.335-.445-.34-.114-.007-.247-.007-.38-.007s-.347.05-.529.247c-.182.198-.694.678-.694 1.654s.71 1.916.81 2.048c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.17-.478 1.338-.94.166-.462.166-.857.116-.94-.049-.082-.182-.132-.38-.23z"/></svg>
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
