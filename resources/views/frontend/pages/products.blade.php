@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Solar Products & Hardware — AES Energy')
@section('meta_description', $seo['meta_description'] ?? 'Tier-1 Mono PERC & TOPCon panels, hybrid inverters, and smart Wi-Fi monitoring.')
@section('meta_keyword', $seo['meta_keyword'] ?? 'solar panels, hybrid inverters, battery storage, DCR panels')

@section('content')
<style>
  .product-catalog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 32px;
    max-width: 1200px;
    margin: 0 auto;
  }
  
  .ref-product-card {
    max-width: 380px;
    width: 100%;
    margin: 0 auto;
    background: #fff;
    border: 2px solid var(--blue-600);
    border-radius: 24px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(28, 134, 201, 0.08);
  }
  .ref-product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 35px rgba(28, 134, 201, 0.15);
    border-color: var(--blue-700);
  }
  
  .ref-product-badge {
    background: var(--blue-600);
    color: #fff;
    font-weight: 700;
    text-align: center;
    padding: 12px;
    font-size: 1.15rem;
    letter-spacing: 0.02em;
  }
  
  .ref-product-img-container {
    padding: 20px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 240px;
    overflow: hidden;
  }
  .ref-product-img-container img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
    border-radius: 16px;
    transition: transform 0.4s ease;
  }
  .ref-product-card:hover .ref-product-img-container img {
    transform: scale(1.05);
  }
  
  .ref-product-desc {
    padding: 0 24px 20px;
    text-align: center;
    color: var(--muted);
    font-size: 0.95rem;
    line-height: 1.6;
    flex-grow: 1;
  }
  
  .ref-product-btn-container {
    padding: 0 24px 24px;
  }
  
  .ref-inquiry-btn {
    background: var(--blue-900);
    color: #fff;
    font-weight: 700;
    border: none;
    width: 100%;
    padding: 14px;
    border-radius: 12px;
    font-size: 1.05rem;
    cursor: pointer;
    transition: all 0.25s ease;
    text-align: center;
    display: block;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(11, 61, 92, 0.2);
  }
  .ref-inquiry-btn:hover {
    background: var(--amber);
    color: #fff;
    box-shadow: 0 6px 18px rgba(255, 176, 32, 0.3);
  }
</style>

<div class="page-banner">
  <div>
    <span class="crumb">Home / Products</span>
    <h1>Our Products &amp; Hardware</h1>
    <p>Tier-1 Mono PERC &amp; TOPCon panels, hybrid inverters, and battery storage systems.</p>
  </div>
</div>

<section class="section" style="background: #f8fafc; padding-top: 60px; padding-bottom: 80px;">
  <div class="product-catalog-grid reveal-stagger">
    @forelse($products as $prod)
      @php
        $fallback = match($prod->slug) {
            'solar-products' => 'images/product-panel.jpg',
            'bos-products' => 'images/product-battery.jpg',
            'power-control-products' => 'images/product-inverter.jpg',
            default => 'images/product-panel.jpg'
        };
        $imgSrc = $prod->hasMedia('avatar') ? $prod->avatarUrl['250'] : asset($fallback);
      @endphp
      <div class="ref-product-card">
        <div>
          <!-- Title category badge -->
          <div class="ref-product-badge">
            {{ $prod->heading }}
          </div>
          
          <!-- Image Container -->
          <a href="{{ route('products.single', ['slug' => $prod->slug]) }}" class="ref-product-img-container">
            <img src="{{ $imgSrc }}" alt="{{ $prod->heading }}">
          </a>
          
          <!-- Description -->
          <div class="ref-product-desc">
            <h4 style="margin: 16px 0 8px; font-size: 1.05rem; line-height: 1.4;">
              <a href="{{ route('products.single', ['slug' => $prod->slug]) }}" style="color: var(--blue-900); font-weight: 700; text-decoration: none; transition: color 0.2s ease;" onmouseover="this.style.color='var(--blue-500)'" onmouseout="this.style.color='var(--blue-900)'">
                {{ $prod->sub_heading }}
              </a>
            </h4>
          </div>
        </div>
        
        <!-- Inquiry Button -->
        <div class="ref-product-btn-container">
          <a href="{{ route('contact', ['type' => 'Customer', 'message' => 'I am interested in inquiring about ' . $prod->heading]) }}" class="ref-inquiry-btn">
            Inquiry Now
          </a>
        </div>
      </div>
    @empty
      <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--muted);">
        <p>No products currently published. Please check back shortly.</p>
      </div>
    @endforelse
  </div>
</section>

<!-- Why Our Hardware -->
<section class="section">
  <div class="section-head reveal text-center" style="max-width: 600px; margin: 0 auto 40px;">
    <span class="eyebrow">Quality Benchmarks</span>
    <h2>Certified, Tested, Trusted</h2>
  </div>
  <div class="brand-strip reveal-stagger" style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap; font-weight: 700; color: var(--blue-900);">
    <span>✅ MNRE Approved Models</span>
    <span>✅ BIS Certified Panels</span>
    <span>✅ IEC 61215 &amp; 61730 Tested</span>
    <span>✅ ALMM Listed Tier-1 Brands</span>
  </div>
</section>
@endsection
