@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'PM Surya Ghar - AES Energy')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<div class="page-banner">
      <div><span class="crumb">Home / PM Surya Ghar</span><h1>PM Surya Ghar Muft Bijli Yojana</h1><p>Get up to ₹78,000 central subsidy and target zero electricity bills.</p></div>
    </div>
    <section class="section">
      <div class="scheme-banner reveal">
        <div>
          <span class="eyebrow" style="color:#fff;opacity:.85;">Government Scheme</span>
          <h2>Free electricity, subsidised solar</h2>
          <p>AES Energy handles registration, DISCOM approval and net-metering for you — from application to subsidy credit.</p>
          <ul class="scheme-points">
            <li>✅ Up to 300 units free electricity every month</li>
            <li>✅ Subsidy credited directly to your bank account</li>
            <li>✅ Full paperwork &amp; DISCOM liaison by AES Energy</li>
          </ul>
          <button class="btn btn-amber" style="margin-top:10px;" onclick="window.location.href='{{ route('login') }}'">Check My Eligibility</button>
        </div>
        <div class="scheme-card">
          <span style="font-size:.85rem;opacity:.85;">Estimated subsidy for a 3kW system</span>
          <div class="amt">₹78,000</div>
          <div class="progress-track"><div class="progress-fill" id="schemeProgress"></div></div>
          <span style="font-size:.8rem;opacity:.85;">92% of applicants receive approval within 45 days</span>
        </div>
      </div>
    </section>
    <section class="section section-alt">
      <div class="section-head reveal"><span class="eyebrow">Subsidy Slabs</span><h2>How much can you get?</h2></div>
      <div class="slab-grid reveal-stagger">
        <div class="slab-card"><div class="kw">Up to 2 kW</div><div class="amt">₹30,000</div><span>per kW subsidy</span></div>
        <div class="slab-card"><div class="kw">2–3 kW</div><div class="amt">₹18,000</div><span>additional per kW</span></div>
        <div class="slab-card"><div class="kw">Above 3 kW</div><div class="amt">₹78,000</div><span>maximum subsidy capped</span></div>
      </div>
    </section>
    <section class="section">
      <div class="section-head reveal"><span class="eyebrow">Process</span><h2>How AES Energy files it for you</h2></div>
      <div class="process-row reveal-stagger">
        <div class="process-step"><div class="process-num">1</div><h4>Register on Portal</h4><p>We create your National Portal application.</p><div class="process-line"></div></div>
        <div class="process-step"><div class="process-num">2</div><h4>Feasibility Approval</h4><p>DISCOM approves your rooftop capacity.</p><div class="process-line"></div></div>
        <div class="process-step"><div class="process-num">3</div><h4>Installation &amp; Inspection</h4><p>System installed, inspected and commissioned.</p><div class="process-line"></div></div>
        <div class="process-step"><div class="process-num">4</div><h4>Subsidy Credited</h4><p>Amount credited directly to your bank account.</p></div>
      </div>
    </section>
    <section class="section section-alt">
      <div class="section-head reveal"><span class="eyebrow">Documents Required</span><h2>Keep these ready</h2></div>
      <ul class="doc-checklist reveal-stagger">
        <li>Latest electricity bill (last 2 months)</li>
        <li>Aadhaar Card &amp; PAN Card copy</li>
        <li>Bank passbook / cancelled cheque</li>
        <li>Property ownership / NOC (rented premises)</li>
        <li>Passport-size photograph</li>
        <li>Roof layout / site photos (we can capture these)</li>
      </ul>
    </section>
@endsection
