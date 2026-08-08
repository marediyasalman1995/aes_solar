@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Solar Services & AMC — AES Energy')
@section('meta_description', $seo['meta_description'] ?? 'Turnkey solar installation, DISCOM liaisoning, robotic panel cleaning, and 24x7 AMC.')
@section('meta_keyword', $seo['meta_keyword'] ?? 'solar cleaning, solar maintenance, solar AMC, net metering liaison')

@section('content')
<div class="page-banner">
  <div>
    <span class="crumb">Home / Services</span>
    <h1>Support that outlasts the install</h1>
    <p>From first survey to year twenty-five, our service desk is one call away.</p>
  </div>
</div>

<section class="section">
  <div class="services-strip reveal-stagger">
    @forelse($services as $srv)
      @php
        $icons = ['🛠', '📞', '📈', '📄', '⚡', '🛡️'];
        $icon = $icons[$loop->index % count($icons)];
      @endphp
      <div class="service-tile">
        <div class="ic">{{ $icon }}</div>
        <h4>{{ $srv->heading }}</h4>
        <p>{{ $srv->sub_heading ?? strip_tags($srv->description) }}</p>
      </div>
    @empty
      <div class="service-tile"><div class="ic">🛠</div><h4>AMC &amp; Maintenance</h4><p>Scheduled cleaning &amp; health checks</p></div>
      <div class="service-tile"><div class="ic">📞</div><h4>24×7 Support Desk</h4><p>Raise &amp; track service requests</p></div>
    @endforelse
  </div>
</section>

<!-- PROCESS STEPS -->
<section class="section section-alt">
  <div class="section-head reveal"><span class="eyebrow">How it works</span><h2>From enquiry to switched on</h2></div>
  <div class="process-row reveal-stagger">
    @forelse($process_steps as $step)
      <div class="process-step">
        <div class="process-num">{{ $loop->iteration }}</div>
        <h4>{{ $step->heading }}</h4>
        <p>{{ strip_tags($step->description) }}</p>
        @if(!$loop->last)
          <div class="process-line"></div>
        @endif
      </div>
    @empty
      <div class="process-step"><div class="process-num">1</div><h4>Free Site Survey</h4><p>Our team studies your roof, shadows and load.</p><div class="process-line"></div></div>
      <div class="process-step"><div class="process-num">2</div><h4>Design &amp; Quotation</h4><p>Custom system size with transparent pricing.</p></div>
    @endforelse
  </div>
</section>

<!-- AMC PLANS -->
<section class="section">
  <div class="section-head reveal"><span class="eyebrow">AMC Plans</span><h2>Keep your plant running at peak output</h2></div>
  <div class="amc-grid reveal-stagger">
    @forelse($amc_plans as $amc)
      <div class="amc-card {{ $loop->iteration == 2 ? 'featured' : '' }}">
        <h4>{{ $amc->heading }}</h4>
        <div class="price">{{ $amc->sub_heading }}</div>
        <p style="color:var(--muted); font-size:0.88rem; line-height:1.6; margin: 12px 0;">{{ strip_tags($amc->description) }}</p>
        <button class="btn {{ $loop->iteration == 2 ? 'btn-primary' : 'btn-outline' }}" style="width:100%;justify-content:center;" onclick="window.location.href='{{ route('contact') }}'">Choose Plan</button>
      </div>
    @empty
      <div class="amc-card"><h4>Standard Care</h4><div class="price">₹3,499/yr</div><p>Annual maintenance with free health inspections.</p></div>
    @endforelse
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
