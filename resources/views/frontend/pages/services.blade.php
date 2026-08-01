@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Services - AES Energy')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<div class="page-banner">
      <div><span class="crumb">Home / Services</span><h1>Support that outlasts the install</h1><p>From first survey to year twenty-five, our service desk is one call away.</p></div>
    </div>
    <section class="section">
      <div class="services-strip reveal-stagger">
        <div class="service-tile"><div class="ic">🛠</div><h4>AMC &amp; Maintenance</h4><p>Scheduled cleaning &amp; health checks</p></div>
        <div class="service-tile"><div class="ic">📞</div><h4>24×7 Support Desk</h4><p>Raise &amp; track service requests</p></div>
        <div class="service-tile"><div class="ic">📈</div><h4>Performance Monitoring</h4><p>Real-time generation tracking</p></div>
        <div class="service-tile"><div class="ic">📄</div><h4>Subsidy &amp; Net-Metering</h4><p>End-to-end documentation help</p></div>
      </div>
    </section>
    <section class="section section-alt">
      <div class="section-head reveal"><span class="eyebrow">How it works</span><h2>From enquiry to switched on</h2></div>
      <div class="process-row reveal-stagger">
        <div class="process-step"><div class="process-num">1</div><h4>Free Site Survey</h4><p>Our team studies your roof, shadows and load.</p><div class="process-line"></div></div>
        <div class="process-step"><div class="process-num">2</div><h4>Design &amp; Quotation</h4><p>Custom system size with transparent pricing.</p><div class="process-line"></div></div>
        <div class="process-step"><div class="process-num">3</div><h4>Installation</h4><p>In-house crew installs within 2–4 days.</p><div class="process-line"></div></div>
        <div class="process-step"><div class="process-num">4</div><h4>Subsidy &amp; Net-Metering</h4><p>We handle DISCOM approval end to end.</p></div>
      </div>
    </section>
    <section class="section">
      <div class="section-head reveal"><span class="eyebrow">AMC Plans</span><h2>Keep your plant running at peak output</h2></div>
      <div class="amc-grid reveal-stagger">
        <div class="amc-card"><h4>Basic</h4><div class="price">₹1,999/yr</div><ul><li>2 cleaning visits/year</li><li>Annual health check</li><li>Email support</li></ul><button class="btn btn-outline" style="width:100%;justify-content:center;" onclick="window.location.href='{{ route('login') }}'">Select</button></div>
        <div class="amc-card"><h4>Standard</h4><div class="price">₹3,499/yr</div><ul><li>4 cleaning visits/year</li><li>Priority phone support</li><li>Free minor repairs</li></ul><button class="btn btn-primary" style="width:100%;justify-content:center;" onclick="window.location.href='{{ route('login') }}'">Select</button></div>
        <div class="amc-card"><h4>Premium</h4><div class="price">₹5,999/yr</div><ul><li>6 cleaning visits/year</li><li>24×7 priority support</li><li>Free parts &amp; labour</li></ul><button class="btn btn-outline" style="width:100%;justify-content:center;" onclick="window.location.href='{{ route('login') }}'">Select</button></div>
      </div>
    </section>
    <section class="section section-alt">
      <div class="section-head reveal"><span class="eyebrow">Coverage</span><h2>Where our service network reaches</h2></div>
      <div class="coverage-row reveal-stagger">
        <span class="coverage-chip">Pune</span><span class="coverage-chip">Mumbai</span><span class="coverage-chip">Nashik</span>
        <span class="coverage-chip">Nagpur</span><span class="coverage-chip">Ahmedabad</span><span class="coverage-chip">Surat</span>
        <span class="coverage-chip">Bengaluru</span><span class="coverage-chip">Hyderabad</span><span class="coverage-chip">+ 40 more cities</span>
      </div>
    </section>
@endsection
