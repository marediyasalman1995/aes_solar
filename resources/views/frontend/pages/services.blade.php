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
        $serviceTitle = strtolower($srv->heading);
        if (str_contains($serviceTitle, 'maintenance') || str_contains($serviceTitle, 'amc')) {
            $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>';
        } elseif (str_contains($serviceTitle, 'support') || str_contains($serviceTitle, 'help') || str_contains($serviceTitle, 'desk') || str_contains($serviceTitle, '24')) {
            $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>';
        } elseif (str_contains($serviceTitle, 'monitoring') || str_contains($serviceTitle, 'performance') || str_contains($serviceTitle, 'track')) {
            $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>';
        } elseif (str_contains($serviceTitle, 'subsidy') || str_contains($serviceTitle, 'metering') || str_contains($serviceTitle, 'document')) {
            $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>';
        } else {
            $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>';
        }
      @endphp
      <div class="service-tile">
        <div class="ic">{!! $svgIcon !!}</div>
        <h4>{{ $srv->heading }}</h4>
        <p>{{ $srv->sub_heading ?? strip_tags($srv->description) }}</p>
      </div>
    @empty
      <div class="service-tile"><div class="ic"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div><h4>AMC &amp; Maintenance</h4><p>Scheduled cleaning &amp; health checks</p></div>
      <div class="service-tile"><div class="ic"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div><h4>24×7 Support Desk</h4><p>Raise &amp; track service requests</p></div>
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

@endsection
