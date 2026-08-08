@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Solar Solutions — AES Energy')
@section('meta_description', $seo['meta_description'] ?? 'On-grid, off-grid and hybrid rooftop solar solutions for homes, societies, and industries.')
@section('meta_keyword', $seo['meta_keyword'] ?? 'on-grid solar, off-grid solar, hybrid solar, society solar')

@section('content')
<div class="page-banner">
  <div>
    <span class="crumb">Home / Solar Solutions</span>
    <h1>One roof, three ways to go solar</h1>
    <p>We size a system around how you actually use power — bill offset, backup, or both.</p>
  </div>
</div>

<section class="section">
  <div class="grid-3 reveal-stagger">
    @forelse($solutions as $sol)
      @php
        $defaultType = strtolower(explode('-', explode(' ', $sol->heading)[0] ?? 'ongrid')[0]);
        $fallbackImg = 'images/solution-' . ($defaultType == 'on' ? 'ongrid' : ($defaultType == 'off' ? 'offgrid' : 'hybrid')) . '.jpg';
        $imgSrc = $sol->hasMedia('avatar') ? $sol->avatarUrl['250'] : asset($fallbackImg);
      @endphp
      <div class="card">
        <div class="img-wrap">
          <img src="{{ $imgSrc }}" alt="{{ $sol->heading }}">
        </div>
        <div class="card-body">
          @if(!empty($sol->sub_heading))
            <span class="tag">{{ $sol->sub_heading }}</span>
          @endif
          <h3>{{ $sol->heading }}</h3>
          <p>{{ strip_tags($sol->description) }}</p>
          <button class="card-link" onclick="window.location.href='{{ route('contact') }}'">Get a free quote <span>→</span></button>
        </div>
      </div>
    @empty
      <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--muted);">
        <p>No solutions currently published.</p>
      </div>
    @endforelse
  </div>
</section>

<section class="section section-alt">
  <div class="section-head reveal"><span class="eyebrow">Compare</span><h2>Which solution fits you?</h2></div>
  <div class="compare-wrap reveal">
    <table class="compare">
      <tr><th>Feature</th><th>On-Grid</th><th>Off-Grid</th><th>Hybrid</th></tr>
      <tr><td>Works during power cuts</td><td>No</td><td>Yes</td><td>Yes</td></tr>
      <tr><td>Net-metering benefit</td><td>Yes</td><td>No</td><td>Yes</td></tr>
      <tr><td>Battery included</td><td>No</td><td>Yes</td><td>Optional</td></tr>
      <tr><td>Best for</td><td>Homes on grid</td><td>Remote sites</td><td>Businesses</td></tr>
      <tr><td>Typical payback</td><td>3.5–4.5 years</td><td>6–8 years</td><td>4.5–5.5 years</td></tr>
    </table>
  </div>
</section>

<section class="section">
  <div class="section-head reveal"><span class="eyebrow">Who It's For</span><h2>Find your use case</h2></div>
  <div class="usecase-row reveal-stagger">
    <div class="usecase-item"><div class="ic">🏠</div><b>Homeowners</b><span>Cut monthly bills with on-grid solar</span></div>
    <div class="usecase-item"><div class="ic">🌾</div><b>Rural &amp; Remote</b><span>Off-grid systems for unreliable grids</span></div>
    <div class="usecase-item"><div class="ic">🏭</div><b>Factories</b><span>Hybrid systems for high daytime load</span></div>
    <div class="usecase-item"><div class="ic">🏢</div><b>Housing Societies</b><span>Shared rooftop systems, split billing</span></div>
  </div>
</section>
@endsection
