@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Solar Products & Hardware — AES Energy')
@section('meta_description', $seo['meta_description'] ?? 'Tier-1 Mono PERC & TOPCon panels, hybrid inverters, and smart Wi-Fi monitoring.')
@section('meta_keyword', $seo['meta_keyword'] ?? 'solar panels, hybrid inverters, battery storage, DCR panels')

@section('content')
<div class="page-banner">
  <div>
    <span class="crumb">Home / Products</span>
    <h1>Hardware we stand behind</h1>
    <p>Tier-1 panels, hybrid inverters and smart monitoring — all under one warranty desk.</p>
  </div>
</div>

<section class="section">
  <div class="grid-3 reveal-stagger">
    @forelse($products as $prod)
      @php
        $defaultName = strtolower(explode(' ', $prod->heading)[0] ?? 'panel');
        $fallbackPath = 'images/product-' . ($defaultName == 'mono' ? 'panel' : ($defaultName == 'smart' ? 'inverter' : ($defaultName == 'lithium' ? 'battery' : 'panel'))) . '.jpg';
        $imgSrc = $prod->hasMedia('avatar') ? $prod->avatarUrl['250'] : asset($fallbackPath);
      @endphp
      <div class="card">
        <div class="img-wrap">
          <img src="{{ $imgSrc }}" alt="{{ $prod->heading }}">
        </div>
        <div class="card-body">
          @if(!empty($prod->sub_heading))
            <span class="tag">{{ $prod->sub_heading }}</span>
          @endif
          <h3>{{ $prod->heading }}</h3>
          <p>{{ strip_tags($prod->description) }}</p>
          <button class="card-link" onclick="window.location.href='{{ route('contact') }}'">Request Specs &amp; Quote <span>→</span></button>
        </div>
      </div>
    @empty
      <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--muted);">
        <p>No products currently published. Please check back shortly or contact our team.</p>
      </div>
    @endforelse
  </div>
</section>

<section class="section section-alt">
  <div class="section-head reveal"><span class="eyebrow">Specs at a glance</span><h2>Built to last, engineered to perform</h2></div>
  <div class="compare-wrap reveal">
    <table class="compare">
      <tr><th>Component</th><th>Efficiency / Rating</th><th>Warranty</th><th>Ideal For</th></tr>
      <tr><td>Mono PERC / TOPCon Panel</td><td>21.8% efficiency</td><td>25 years linear</td><td>All rooftop types</td></tr>
      <tr><td>Smart Hybrid Inverter</td><td>97.5% efficiency</td><td>10 years</td><td>Grid + battery setups</td></tr>
      <tr><td>Lithium Battery Bank</td><td>6000+ cycles</td><td>10 years</td><td>Backup &amp; off-grid</td></tr>
      <tr><td>Mounting Structure</td><td>Hot-dip galvanized (HDG)</td><td>15 years</td><td>Tested to 160 km/h</td></tr>
    </table>
  </div>
</section>

<section class="section">
  <div class="section-head reveal"><span class="eyebrow">Why Our Hardware</span><h2>Certified, tested, trusted</h2></div>
  <div class="brand-strip reveal-stagger">
    <span>✅ MNRE Approved Models</span>
    <span>✅ BIS Certified Panels</span>
    <span>✅ IEC 61215 &amp; 61730 Tested</span>
    <span>✅ ALMM Listed Tier-1 Brands</span>
  </div>
</section>
@endsection
