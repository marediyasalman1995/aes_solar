@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Contact Us — AES Energy')
@section('meta_description', $seo['meta_description'] ?? 'Book a free rooftop solar survey in Pune and Maharashtra.')
@section('meta_keyword', $seo['meta_keyword'] ?? 'contact, solar survey, solar Pune')

@section('content')
@php
  $contactFaqs = \App\Models\Faq::take(4)->get();
@endphp

<div class="page-banner">
  <div>
    <span class="crumb">Home / Contact</span>
    <h1>Let's design your rooftop system</h1>
    <p>Share a few details — our solar engineering team gets back within one business day.</p>
  </div>
</div>

<section class="section">
  <div class="contact-wrap">
    <div class="reveal">
      <ul class="contact-info">
        @if(!empty($setting->address))
          <li>
            <div class="ic">📍</div>
            <div><b>Head Office</b><span>{{ $setting->address }}</span></div>
          </li>
        @endif

        @if(!empty($setting->mobile))
          <li>
            <div class="ic">📞</div>
            <div>
              <b>Call Us</b>
              <span>
                <a href="tel:+91{{ $setting->mobile }}" style="color:inherit;font-weight:600;">+91 {{ $setting->mobile }}</a>
                @if(!empty($setting->mobile_2)) · <a href="tel:+91{{ $setting->mobile_2 }}" style="color:inherit;">+91 {{ $setting->mobile_2 }}</a> @endif
                <div style="font-size:0.8rem; color:var(--muted); margin-top:2px;">(Mon–Sat, 9:00 AM – 7:00 PM)</div>
              </span>
            </div>
          </li>
        @endif

        @if(!empty($setting->email))
          <li>
            <div class="ic">✉️</div>
            <div>
              <b>Email Support</b>
              <span>
                <a href="mailto:{{ $setting->email }}" style="color:inherit;">{{ $setting->email }}</a>
                @if(!empty($setting->email_2)) · <a href="mailto:{{ $setting->email_2 }}" style="color:inherit;">{{ $setting->email_2 }}</a> @endif
              </span>
            </div>
          </li>
        @endif

        <li>
          <div class="ic">🌐</div>
          <div><b>Official Website</b><span>{{ request()->getHost() }}</span></div>
        </li>
      </ul>

      <!-- SOCIAL MEDIA CONNECT -->
      @if($setting && ($setting->facebook || $setting->twitter || $setting->linkdin || $setting->instagram || $setting->youtube))
        <div style="margin-top: 24px; padding: 18px 22px; background: var(--sky-50); border: 1px solid var(--sky-200); border-radius: 14px;">
          <b style="font-size: 0.9rem; color: var(--blue-900); display: block; margin-bottom: 10px;">Connect with us</b>
          <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            @if($setting->facebook)
              <a href="{{ $setting->facebook }}" target="_blank" title="Facebook" style="width:36px; height:36px; border-radius:50%; background:var(--white); border:1px solid var(--sky-200); display:flex; align-items:center; justify-content:center; color:var(--blue-600);">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
              </a>
            @endif
            @if($setting->twitter)
              <a href="{{ $setting->twitter }}" target="_blank" title="Twitter / X" style="width:36px; height:36px; border-radius:50%; background:var(--white); border:1px solid var(--sky-200); display:flex; align-items:center; justify-content:center; color:var(--blue-600);">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4l11.733 16h4.267l-11.733 -16z" /><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" /></svg>
              </a>
            @endif
            @if($setting->linkdin)
              <a href="{{ $setting->linkdin }}" target="_blank" title="LinkedIn" style="width:36px; height:36px; border-radius:50%; background:var(--white); border:1px solid var(--sky-200); display:flex; align-items:center; justify-content:center; color:var(--blue-600);">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M8 11l0 5" /><path d="M8 8l0 .01" /><path d="M12 16l0 -5" /><path d="M16 16v-3a2 2 0 0 0 -4 0" /></svg>
              </a>
            @endif
            @if($setting->instagram)
              <a href="{{ $setting->instagram }}" target="_blank" title="Instagram" style="width:36px; height:36px; border-radius:50%; background:var(--white); border:1px solid var(--sky-200); display:flex; align-items:center; justify-content:center; color:var(--blue-600);">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M16.5 7.5l0 .01" /></svg>
              </a>
            @endif
            @if($setting->youtube)
              <a href="{{ $setting->youtube }}" target="_blank" title="YouTube" style="width:36px; height:36px; border-radius:50%; background:var(--white); border:1px solid var(--sky-200); display:flex; align-items:center; justify-content:center; color:var(--blue-600);">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-8z" /><path d="M10 9l5 3l-5 3z" /></svg>
              </a>
            @endif
          </div>
        </div>
      @endif
    </div>

    <!-- INQUIRY FORM -->
    <form class="form-card reveal" onsubmit="return submitContact(event)">
      <input type="hidden" name="subject" value="Website Rooftop Solar Survey Request">
      <div class="form-row">
        <div class="field"><label>Full Name</label><input type="text" name="name" placeholder="Your name" required></div>
        <div class="field"><label>Email Address</label><input type="email" name="email" placeholder="Your email address" required></div>
      </div>
      <div class="form-row">
        <div class="field"><label>Mobile Number</label><input type="tel" name="phone" placeholder="+91" required></div>
        <div class="field"><label>City</label><input type="text" name="city" placeholder="City" required></div>
      </div>
      <div class="form-row">
        <div class="field"><label>Monthly Bill (₹)</label><input type="number" name="monthly_bill" placeholder="e.g. 3500"></div>
      </div>
      <div class="field" style="margin-bottom:16px;"><label>Message</label><textarea name="message" rows="3" placeholder="Tell us about your requirement"></textarea></div>
      <button class="btn btn-primary" style="width:100%;justify-content:center;" type="submit">Request Free Survey</button>
    </form>
  </div>
</section>

<!-- OFFICE HOURS -->
<section class="section">
  <div class="section-head reveal"><span class="eyebrow">Visit Us</span><h2>Office hours</h2></div>
  <div class="hours-card reveal">
    <div class="hours-row"><b>Monday – Friday</b><span>9:00 AM – 7:00 PM</span></div>
    <div class="hours-row"><b>Saturday</b><span>9:00 AM – 5:00 PM</span></div>
    <div class="hours-row"><b>Sunday</b><span>Closed (support desk open)</span></div>
    <div class="hours-row"><b>24×7 Support Desk</b><span>+91 {{ $setting->mobile ?? '9876543210' }}</span></div>
  </div>
</section>

<!-- DYNAMIC FAQS -->
@if($contactFaqs->count() > 0)
<section class="section section-alt">
  <div class="section-head reveal"><span class="eyebrow">FAQs</span><h2>Common questions</h2></div>
  <div style="max-width:760px; margin:0 auto;">
    @foreach($contactFaqs as $faq)
      <div class="faq-item" onclick="this.classList.toggle('open')">
        <div class="q">{{ $faq->question_english }} <span class="plus">+</span></div>
        <div class="a">{{ $faq->answer_english }}</div>
      </div>
    @endforeach
  </div>
</section>
@endif
@endsection
