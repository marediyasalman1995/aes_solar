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
            <div class="ic"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
            <div><b>Head Office</b><span>{{ $setting->address }}</span></div>
          </li>
        @endif

        @if(!empty($setting->mobile))
          <li>
            <div class="ic"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
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
            <div class="ic"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
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
          <div class="ic"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
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
    <div class="form-card reveal">
      <form onsubmit="return submitContact(event)" id="inquiryContactForm">
        @csrf
        <div class="form-row mb-3" style="grid-template-columns: 1fr;">
          <div class="field col-12">
            <label class="fw-bold">I am a...</label>
            <select name="type" id="inquiryType" class="form-control" style="border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px; width: 100%; box-sizing: border-box;" required>
              <option value="Customer" {{ request('type') == 'Customer' ? 'selected' : '' }}>Customer (Interested in Solar Rooftop)</option>
              <option value="Dealer" {{ request('type') == 'Dealer' ? 'selected' : '' }}>Dealer (Interested in Partnership)</option>
            </select>
          </div>
        </div>
        
        <div class="form-row">
          <div class="field"><label class="fw-bold">Full Name</label><input type="text" name="name" placeholder="Your name" required></div>
          <div class="field"><label class="fw-bold">Email Address</label><input type="email" name="email" placeholder="Your email address" required></div>
        </div>
        
        <div class="form-row">
          <div class="field"><label class="fw-bold">WhatsApp Number</label><input type="tel" name="phone" placeholder="e.g. 9876543210" required></div>
          <div class="field"><label class="fw-bold">City</label><input type="text" name="city" placeholder="e.g. Ahmedabad" required></div>
        </div>

        <div class="form-row mb-3" style="grid-template-columns: 1fr;">
          <div class="field col-12">
            <label class="fw-bold">PIN Code</label>
            <input type="text" name="pincode" placeholder="e.g. 380001" required style="width: 100%; box-sizing: border-box;">
          </div>
        </div>

        <!-- Monthly Electricity Bill Selection Chips -->
        <div class="mb-4">
          <label class="form-label fw-bold d-block mb-2">Monthly Electricity Bill Range</label>
          <input type="hidden" name="monthly_bill" id="monthlyBillInput" value="1500 - 2500">
          <div class="d-flex flex-wrap gap-2" style="gap: 8px;">
            <button type="button" class="bill-chip" data-val="< 1500" onclick="setBillChip(this, '< 1500')">&lt; ₹1,500</button>
            <button type="button" class="bill-chip active" data-val="1500 - 2500" onclick="setBillChip(this, '1500 - 2500')">₹1,500 - ₹2,500</button>
            <button type="button" class="bill-chip" data-val="2500 - 4000" onclick="setBillChip(this, '2500 - 4000')">₹2,500 - ₹4,000</button>
            <button type="button" class="bill-chip" data-val="4000 - 8000" onclick="setBillChip(this, '4000 - 8000')">₹4,000 - ₹8,000</button>
            <button type="button" class="bill-chip" data-val="8000+" onclick="setBillChip(this, '8000+')">₹8,000+</button>
          </div>
        </div>

        <div class="field" style="margin-bottom:16px;"><label class="fw-bold">Message</label><textarea name="message" rows="3" placeholder="Tell us about your requirement"></textarea></div>
        <button class="btn btn-primary" style="width:100%;justify-content:center;" type="submit">Submit Request</button>
      </form>
    </div>
  </div>

  <style>
    .form-card {
        background: #fff !important;
        border: 1px solid var(--sky-200) !important;
        border-radius: 24px !important;
        padding: 40px !important;
        box-shadow: var(--shadow-md) !important;
    }
    .form-card label {
        font-size: 0.8rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        color: var(--blue-900) !important;
        margin-bottom: 8px !important;
        display: block !important;
    }
    .form-card input, .form-card select, .form-card textarea {
        background: #f8fafc !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 12px !important;
        padding: 14px 16px !important;
        font-size: 0.95rem !important;
        color: var(--blue-900) !important;
        width: 100% !important;
        box-sizing: border-box !important;
        transition: all 0.25s ease !important;
    }
    .form-card input:focus, .form-card select:focus, .form-card textarea:focus {
        border-color: var(--blue-500) !important;
        background: #fff !important;
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15) !important;
        outline: none !important;
    }
    .bill-chip {
        border-radius: 12px !important;
        padding: 10px 20px !important;
        font-size: 0.9rem !important;
        font-weight: 600 !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: 1px solid #cbd5e1 !important;
        background: #fff !important;
        color: #475569 !important;
        cursor: pointer !important;
        display: inline-block !important;
        margin: 4px 4px !important;
    }
    .bill-chip:hover {
        border-color: var(--blue-500) !important;
        color: var(--blue-600) !important;
        background: #f0f9ff !important;
    }
    .bill-chip.active {
        background: var(--blue-900) !important;
        border-color: var(--blue-900) !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15) !important;
    }
    .form-card button[type="submit"] {
        background: linear-gradient(135deg, var(--blue-900) 0%, #0c334d 100%) !important;
        color: #fff !important;
        font-weight: 700 !important;
        font-size: 1rem !important;
        padding: 14px !important;
        border-radius: 12px !important;
        border: none !important;
        cursor: pointer !important;
        transition: all 0.25s ease !important;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15) !important;
    }
    .form-card button[type="submit"]:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.25) !important;
    }
  </style>

  <script>
    function setBillChip(el, val) {
        document.querySelectorAll('.bill-chip').forEach(btn => btn.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('monthlyBillInput').value = val;
    }
  </script>
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
