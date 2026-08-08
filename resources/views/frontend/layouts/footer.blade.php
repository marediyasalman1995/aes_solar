@php
  $footerSetting = \App\Models\Setting::first();
  $cms_pages = \App\Models\ContentManagement::where('active', 1)->orderBy('id', 'asc')->get();
@endphp
<footer>
  <div class="footer-grid">
    <div>
      <a href="{{ route('home') }}" class="brand" style="color:#fff;margin-bottom:12px;"><div class="brand-mark"></div>AES Energy</a>
      <p style="color:#b7d6ea;font-size:.88rem;line-height:1.7;max-width:280px;">
        {{ $footerSetting->footer_text ?? 'Rooftop solar, done properly — from site survey to subsidy to twenty-five years of support.' }}
      </p>
      
      @if($footerSetting)
        <div style="margin-top:14px; display:flex; flex-direction:column; gap:6px; font-size:.85rem; color:#b7d6ea;">
          @if($footerSetting->mobile)
            <div>📞 <a href="tel:+91{{ $footerSetting->mobile }}" style="color:#fff; font-weight:600;">+91 {{ $footerSetting->mobile }}</a></div>
          @endif
          @if($footerSetting->email)
            <div>✉️ <a href="mailto:{{ $footerSetting->email }}" style="color:#b7d6ea;">{{ $footerSetting->email }}</a></div>
          @endif
        </div>

        <!-- SOCIAL ICONS -->
        <div style="display:flex; gap:10px; margin-top:16px; flex-wrap:wrap;">
          @if(!empty($footerSetting->facebook))
            <a href="{{ $footerSetting->facebook }}" target="_blank" title="Facebook" style="width:34px; height:34px; border-radius:50%; background:rgba(255,255,255,0.12); display:flex; align-items:center; justify-content:center; color:#fff;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
            </a>
          @endif
          @if(!empty($footerSetting->twitter))
            <a href="{{ $footerSetting->twitter }}" target="_blank" title="Twitter / X" style="width:34px; height:34px; border-radius:50%; background:rgba(255,255,255,0.12); display:flex; align-items:center; justify-content:center; color:#fff;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4l11.733 16h4.267l-11.733 -16z" /><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" /></svg>
            </a>
          @endif
          @if(!empty($footerSetting->linkdin))
            <a href="{{ $footerSetting->linkdin }}" target="_blank" title="LinkedIn" style="width:34px; height:34px; border-radius:50%; background:rgba(255,255,255,0.12); display:flex; align-items:center; justify-content:center; color:#fff;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M8 11l0 5" /><path d="M8 8l0 .01" /><path d="M12 16l0 -5" /><path d="M16 16v-3a2 2 0 0 0 -4 0" /></svg>
            </a>
          @endif
          @if(!empty($footerSetting->instagram))
            <a href="{{ $footerSetting->instagram }}" target="_blank" title="Instagram" style="width:34px; height:34px; border-radius:50%; background:rgba(255,255,255,0.12); display:flex; align-items:center; justify-content:center; color:#fff;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M16.5 7.5l0 .01" /></svg>
            </a>
          @endif
          @if(!empty($footerSetting->youtube))
            <a href="{{ $footerSetting->youtube }}" target="_blank" title="YouTube" style="width:34px; height:34px; border-radius:50%; background:rgba(255,255,255,0.12); display:flex; align-items:center; justify-content:center; color:#fff;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-8z" /><path d="M10 9l5 3l-5 3z" /></svg>
            </a>
          @endif
          @if(!empty($footerSetting->telegram))
            <a href="{{ $footerSetting->telegram }}" target="_blank" title="Telegram" style="width:34px; height:34px; border-radius:50%; background:rgba(255,255,255,0.12); display:flex; align-items:center; justify-content:center; color:#fff;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>
            </a>
          @endif
        </div>
      @endif
    </div>

    <div>
      <h4>Company</h4>
      <ul>
        <li><a href="{{ route('about') }}">About AES</a></li>
        <li><a href="{{ route('services') }}">Our Services</a></li>
        <li><a href="{{ route('contact') }}">Contact Us</a></li>
        <li><a href="{{ route('faqs') }}">FAQs</a></li>
      </ul>
    </div>

    <div>
      <h4>Solar</h4>
      <ul>
        <li><a href="{{ route('solutions') }}">Solar Solutions</a></li>
        <li><a href="{{ route('products') }}">Products &amp; Specs</a></li>
        <li><a href="{{ route('suryaghar') }}">PM Surya Ghar</a></li>
      </ul>
    </div>

    <div>
      <h4>Account</h4>
      <ul>
        <li><a href="{{ route('login') }}">Customer Login</a></li>
        <li><a href="{{ route('login') }}">AES One Dashboard</a></li>
        <li><a href="{{ route('login') }}">Refer &amp; Earn</a></li>
      </ul>
    </div>

    <div>
      <h4>Policies &amp; Legal</h4>
      <ul>
        @forelse($cms_pages as $page)
          <li><a href="{{ route('cms-detail', $page->slug) }}">{{ $page->title }}</a></li>
        @empty
          <li><a href="{{ route('cms-detail', 'privacy-policy') }}">Privacy Policy</a></li>
          <li><a href="{{ route('cms-detail', 'terms-and-conditions') }}">Terms &amp; Conditions</a></li>
          <li><a href="{{ route('cms-detail', 'warranty-policy') }}">Warranty Terms</a></li>
        @endforelse
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <span>© {{ date('Y') }} AES Energy Pvt. Ltd. All rights reserved. {{ $footerSetting->address ? '· ' . $footerSetting->address : '' }}</span>
    <span>Made for rooftops across India 🇮🇳</span>
  </div>
</footer>
