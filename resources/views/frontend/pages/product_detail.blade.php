@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? $product->heading . ' — AES Energy')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<style>
  /* Premium product details page style rules with website native blue/amber colors */
  .detail-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr; /* Swapped: text left (1.2fr), image right (1fr) */
    gap: 60px;
    max-width: 1200px;
    margin: 0 auto;
    align-items: flex-start;
  }
  @media (max-width: 900px) {
    .detail-grid {
      grid-template-columns: 1fr;
      gap: 40px;
    }
    .detail-grid > div:first-child {
      order: 2; /* Text goes below image on small screens */
    }
    .detail-grid > div:last-child {
      order: 1; /* Image goes above text on small screens */
    }
  }
  
  .detail-image-box {
    background: #fff;
    border: 2px solid var(--blue-600); /* Blue outline border */
    border-radius: 24px;
    padding: 0 !important; /* Remove white padding */
    overflow: hidden; /* Clip image corners */
    display: flex;
    align-items: stretch;
    justify-content: stretch;
    height: 400px; /* Fixed height for consistency */
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12) !important; /* Prominent rich shadow */
  }
  .detail-image-box img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important; /* Cover the entire box */
  }
  
  .specs-table {
    width: 100%;
    border-collapse: collapse;
    margin: 24px 0 32px;
  }
  .specs-table tr {
    border-bottom: 1px solid var(--sky-200);
  }
  .specs-table td {
    padding: 14px 10px;
    font-size: 0.95rem;
  }
  .specs-table td.label-cell {
    font-weight: 700;
    color: var(--blue-900);
    width: 35%;
  }
  .specs-table td.value-cell {
    color: var(--muted);
  }
  /* Catalog styles for related products */
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
    <span class="crumb">Home / Products / {{ $product->heading }}</span>
    <h1>{{ $product->heading }}</h1>
    <p>{{ $product->sub_heading }}</p>
  </div>
</div>

<section class="section" style="background: #f8fafc; padding-top: 60px; padding-bottom: 80px;">
  <div class="detail-grid">
    <!-- Left Column: Specs & Description (Now Left Side) -->
    <div class="reveal">
      <span class="eyebrow" style="color: var(--blue-600);">Technical Specifications</span>
      <h2 style="color: var(--blue-900); font-weight: 800; font-size: 2.2rem; margin: 12px 0 16px; letter-spacing: -0.02em;">
        {{ $product->heading }} by AES Energy
      </h2>
      <p style="color: var(--muted); font-size: 1.05rem; line-height: 1.75; margin-bottom: 24px;">
        {{ strip_tags($product->description) }}
      </p>
      
      @php
        $specs = json_decode($product->specifications, true) ?? [];
      @endphp
      @if(!empty($specs))
        <table class="specs-table">
          @foreach($specs as $key => $val)
            <tr>
              <td class="label-cell">{{ $key }}</td>
              <td class="value-cell">{{ $val }}</td>
            </tr>
          @endforeach
        </table>
      @endif
      
      <a href="{{ route('contact', ['type' => 'Customer', 'message' => 'I would like to receive a detailed quote for the ' . $product->heading]) }}" class="btn btn-primary py-3 px-5 text-white fw-bold shadow-sm" style="border-radius:12px; font-size:1.05rem; background: var(--blue-900); border-color: var(--blue-900); box-shadow: 0 10px 25px rgba(11, 61, 92, 0.25);">
        Request Quotation / Callback →
      </a>
    </div>

    <!-- Right Column: Product Image (Now Right Side) -->
    <div class="detail-image-box reveal">
      @php
        $fallback = match($product->slug) {
            'solar-products' => 'images/product-panel.jpg',
            'bos-products' => 'images/product-battery.jpg',
            'power-control-products' => 'images/product-inverter.jpg',
            default => 'images/product-panel.jpg'
        };
        $imgSrc = $product->hasMedia('avatar') ? $product->avatarUrl['250'] : asset($fallback);
      @endphp
      <img src="{{ $imgSrc }}" alt="{{ $product->heading }}">
    </div>
  </div>
</section>

<!-- Related Products Section -->
@if(count($related_products) > 0)
<section class="section section-alt" style="border-top: 1px solid var(--sky-200); background: #fff;">
  <div class="section-head reveal text-center" style="max-width: 600px; margin: 0 auto 50px;">
    <span class="eyebrow" style="color: var(--blue-600);">Browse Catalog</span>
    <h2>Other Product Categories</h2>
  </div>
  
  <div class="product-catalog-grid reveal-stagger">
    @foreach($related_products as $rel)
      @php
        $fallback = match($rel->slug) {
            'solar-products' => 'images/product-panel.jpg',
            'bos-products' => 'images/product-battery.jpg',
            'power-control-products' => 'images/product-inverter.jpg',
            default => 'images/product-panel.jpg'
        };
        $imgSrc = $rel->hasMedia('avatar') ? $rel->avatarUrl['250'] : asset($fallback);
      @endphp
      <div class="ref-product-card">
        <div>
          <div class="ref-product-badge">
            {{ $rel->heading }}
          </div>
          <a href="{{ route('products.single', ['slug' => $rel->slug]) }}" class="ref-product-img-container">
            <img src="{{ $imgSrc }}" alt="{{ $rel->heading }}">
          </a>
          <div class="ref-product-desc">
            <h4 style="margin: 16px 0 8px; font-size: 1rem; line-height: 1.4;">
              <a href="{{ route('products.single', ['slug' => $rel->slug]) }}" style="color: var(--blue-900); font-weight: 700; text-decoration: none; transition: color 0.2s ease;" onmouseover="this.style.color='var(--blue-500)'" onmouseout="this.style.color='var(--blue-900)'">
                {{ $rel->sub_heading }}
              </a>
            </h4>
          </div>
        </div>
        <div class="ref-product-btn-container">
          <a href="{{ route('contact', ['type' => 'Customer', 'message' => 'I am interested in inquiring about ' . $rel->heading]) }}" class="ref-inquiry-btn">
            Inquiry Now
          </a>
        </div>
      </div>
    @endforeach
  </div>
</section>
@endif
@endsection
