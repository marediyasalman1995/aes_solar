@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'AES Energy — Solar for Every Rooftop')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<style>
  /* Calculator & Layout Utilities for AES Solar Home Page */
  .fw-bold { font-weight: 700 !important; }
  .text-dark { color: #0f172a !important; }
  .text-muted { color: #64748b !important; }
  .text-success { color: #16a34a !important; }
  .text-warning { color: var(--amber) !important; }
  .text-uppercase { text-transform: uppercase !important; letter-spacing: 0.05em !important; }
  .text-center { text-align: center !important; }
  .text-start { text-align: left !important; }
  .italic { font-style: italic !important; }
  .d-block { display: block !important; }
  
  .fs-11 { font-size: 0.72rem !important; }
  .fs-12 { font-size: 0.78rem !important; }
  .fs-13 { font-size: 0.85rem !important; }
  .fs-14 { font-size: 0.9rem !important; }
  .fs-18 { font-size: 1.25rem !important; }
  .fs-3 { font-size: 1.5rem !important; }
  .fs-5 { font-size: 1.12rem !important; }

  .d-flex { display: flex !important; }
  .flex-wrap { flex-wrap: wrap !important; }
  .align-items-center { align-items: center !important; }
  .justify-content-between { justify-content: space-between !important; }
  .justify-content-center { justify-content: center !important; }
  
  .gap-2 { gap: 8px !important; }
  .gap-3 { gap: 12px !important; }
  
  .mb-2 { margin-bottom: 8px !important; }
  .mb-3 { margin-bottom: 12px !important; }
  .mb-4 { margin-bottom: 18px !important; }
  .mt-4 { margin-top: 16px !important; }
  
  .w-100 { width: 100% !important; }
  .border-0 { border: none !important; }
  
  .row {
    display: flex !important;
    flex-wrap: wrap !important;
    margin-right: -8px !important;
    margin-left: -8px !important;
  }
  .col-6 {
    flex: 0 0 50% !important;
    max-width: 50% !important;
    padding-right: 8px !important;
    padding-left: 8px !important;
    box-sizing: border-box !important;
  }
  
  .bg-light { background-color: #f8fafc !important; }
  .p-3 { padding: 12px !important; }
  .p-4 { padding: 16px !important; }
  .p-5 { padding: 24px !important; }
  .rounded-3 { border-radius: 12px !important; }
  .rounded-4 { border-radius: 16px !important; }
  .shadow-sm { box-shadow: 0 4px 10px rgba(15,106,168,.08) !important; }
  
  /* Tabs and interactive elements */
  .calc-tab {
    background: #f1f5f9 !important;
    border: 1.5px solid #cbd5e1 !important;
    color: #475569 !important;
    transition: all 0.25s ease !important;
  }
  .calc-tab:hover {
    background: #e2e8f0 !important;
    border-color: #94a3b8 !important;
  }
  .calc-tab.active {
    background: var(--blue-700) !important;
    border-color: var(--blue-700) !important;
    color: #fff !important;
  }
  
  .btn-warning {
    background: linear-gradient(135deg, var(--amber) 0%, var(--amber-dark) 100%) !important;
    color: #5a3600 !important;
    border: none !important;
    cursor: pointer !important;
    transition: transform .25s ease, box-shadow .25s ease !important;
  }
  .btn-warning:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 10px 20px rgba(255, 176, 32, 0.35) !important;
  }
  
  .pm-surya-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 60px;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
  }
  @media (max-width: 900px) {
    .pm-surya-grid {
      grid-template-columns: 1fr !important;
      gap: 40px !important;
    }
  }

  @media (max-width: 900px) {
    .stats-cards-grid {
      grid-template-columns: repeat(2, 1fr) !important;
    }
  }
  @media (max-width: 500px) {
    .stats-cards-grid {
      grid-template-columns: 1fr !important;
    }
    .stats-cta-strip {
      flex-direction: column !important;
      text-align: center !important;
    }
    .stats-cta-strip button {
      width: 100% !important;
      justify-content: center !important;
    }
  }

  /* Testimonial slider responsiveness */
  .testi-slide {
    flex: 0 0 33.3333% !important;
    box-sizing: border-box !important;
    padding: 0 12px !important;
  }
  @media (max-width: 900px) {
    .testi-slide {
      flex: 0 0 50% !important;
    }
  }
  @media (max-width: 600px) {
    .testi-slide {
      flex: 0 0 100% !important;
    }
  }
  
  @media (max-width: 900px) {
    .calculator-section {
      grid-template-columns: 1fr !important;
      gap: 40px !important;
    }
    .calc-card {
      padding: 12px !important;
    }
  }

  /* Catalog styles for home preview products */
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

<header class="hero" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; padding: 80px 4% 60px;">
      <div class="hero-copy reveal">
        <span class="eyebrow"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none" style="margin-right: 4px; vertical-align: middle; color: var(--amber);"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg> MNRE Empanelled Solar Partner</span>
        <h1>{!! isset($website_sections['Top_Banner']) ? $website_sections['Top_Banner']->heading : 'Turn your rooftop into a <span>power plant.</span>' !!}</h1>
        <p>{{ isset($website_sections['Top_Banner']) ? $website_sections['Top_Banner']->sub_heading : 'AES Energy designs, installs and maintains rooftop solar systems that cut your electricity bill from day one — backed by real people, real warranty, and a rewards program that thanks you for spreading the word.' }}</p>
        <div class="hero-ctas">
          <button class="btn btn-primary" onclick="window.location.href='{{ route('contact') }}'">Get Free Site Survey</button>
          <a class="btn btn-ghost" onclick="window.location.href='{{ route('solutions') }}'">Explore Solutions</a>
        </div>
      </div>
      
      <!-- Hero Art (Image 1 style) -->
      <div class="hero-art reveal">
        <div class="sun-orb"></div>
        <div class="sun-ray"></div>
        <div class="panel-card">
          @php
            $heroImg = (isset($website_sections['Top_Banner']) && $website_sections['Top_Banner']->hasMedia('avatar')) 
              ? $website_sections['Top_Banner']->avatarUrl['250'] 
              : asset('images/hero-solar.jpg');
          @endphp
          <img src="{{ $heroImg }}" alt="Rooftop solar installation">
          <div class="panel-meta">
            <span><span class="pulse-dot"></span> Generating Live</span>
            <b>6.4 kW</b>
          </div>
        </div>
        <div class="floating-chip c1"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px; vertical-align: middle; display: inline-block;"><path d="M12 22C12 22 20 18 20 12C20 6.47715 15.5228 2 12 2C8.47715 2 4 6.47715 4 12C4 18 12 22 12 22Z"/><path d="M12 2v20"/></svg> 3.1T CO2 offset</div>
        <div class="floating-chip c2"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--amber)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px; vertical-align: middle; display: inline-block;"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg> ₹4,180 saved this month</div>
      </div>
    </header>



    <section class="section section-alt">
      <div class="section-head reveal">
        <span class="eyebrow">Solar Plans</span>
        <h2>Pick a plan sized for your home</h2>
        <p>Transparent, all-inclusive pricing — panels, inverter, installation, structure and 5-year free service, subsidy applied upfront.</p>
      </div>
      <div class="plans-grid reveal-stagger">
        @forelse($solar_plans as $plan)
          @php
            $isFeatured = $loop->iteration == 2;
            $planImgs = ['plan-starter.jpg', 'plan-family.jpg', 'plan-business.jpg'];
            $imgFallback = 'images/' . ($planImgs[$loop->index % count($planImgs)]);
            $imgSrc = $plan->hasMedia('avatar') ? $plan->avatarUrl['250'] : asset($imgFallback);
          @endphp
          <div class="plan-card {{ $isFeatured ? 'featured' : '' }}">
            @if($isFeatured)
              <div class="plan-ribbon">Most Popular</div>
            @endif
            <div class="plan-photo"><img src="{{ $imgSrc }}" alt="{{ $plan->heading }}"></div>
            <div class="plan-body">
              <span class="kw">{{ $plan->sub_heading }}</span>
              <h3>{{ $plan->heading }}</h3>
              <p style="color:var(--muted);font-size:0.88rem;line-height:1.6;margin:10px 0 0;">{{ strip_tags($plan->description) }}</p>
            </div>
          </div>
        @empty
          <div class="plan-card featured">
            <div class="plan-photo"><img src="{{ asset('images/plan-starter.jpg') }}" alt="Solar plan"></div>
            <div class="plan-body">
              <span class="kw">3 kW · Starter</span>
              <h3>Small Home Plan</h3>
            </div>
          </div>
        @endforelse
      </div>
    </section>

    <section class="section">
      <div class="about-grid">
        <div class="about-photo reveal">
          @php
            $aboutTeaserImg = (isset($website_sections['About_Us']) && $website_sections['About_Us']->hasMedia('avatar')) 
              ? $website_sections['About_Us']->avatarUrl['250'] 
              : asset('images/about-teaser.jpg');
          @endphp
          <img src="{{ $aboutTeaserImg }}" alt="Professional solar technician installing panels">
          <div class="about-badge"><b>10+</b><div><span style="color:var(--blue-900);font-weight:600;display:block;">Years</span><span style="font-size:.8rem;">in clean energy</span></div></div>
        </div>
        <div class="reveal">
          <span class="eyebrow">Who we are</span>
          <h2 style="color:var(--blue-900);font-size:2rem;margin:14px 0 12px;">Engineers first, energy company second.</h2>
          <p style="color:var(--muted);line-height:1.75;">AES Energy was founded to make rooftop solar simple for Indian homes and businesses — from the first site visit to twenty-five years of after-sales support.</p>
          <button class="btn btn-ghost" style="margin-top:22px;" onclick="window.location.href='{{ route('about') }}'">Read our story →</button>
        </div>
      </div>
    </section>

    <!-- HOME PREVIEW: Solar Solutions -->
    <section class="section section-alt">
      <div class="section-head reveal">
        <span class="eyebrow">Solar Solutions</span>
        <h2>One roof, three ways to go solar</h2>
        <p>We size a system around how you actually use power — bill offset, backup, or both.</p>
      </div>
      <div class="grid-3 reveal-stagger">
        @forelse($solutions as $sol)
          @php
            $defaultType = strtolower(explode('-', explode(' ', $sol->heading)[0] ?? 'ongrid')[0]);
            $fallbackImg = 'images/solution-' . ($defaultType == 'on' ? 'ongrid' : ($defaultType == 'off' ? 'offgrid' : 'hybrid')) . '.jpg';
            $imgSrc = $sol->hasMedia('avatar') ? $sol->avatarUrl['250'] : asset($fallbackImg);
          @endphp
          <div class="card">
            <div class="img-wrap"><img src="{{ $imgSrc }}" alt="{{ $sol->heading }}"></div>
            <div class="card-body">
              @if(!empty($sol->sub_heading))
                <span class="tag">{{ $sol->sub_heading }}</span>
              @endif
              <h3>{{ $sol->heading }}</h3>
              <p>{{ strip_tags($sol->description) }}</p>
              <button class="card-link" onclick="window.location.href='{{ route('contact') }}'">Get a quote <span>→</span></button>
            </div>
          </div>
        @empty
          <p>No solutions currently published.</p>
        @endforelse
      </div>
      <div class="view-more-row reveal"><button class="btn btn-ghost" onclick="window.location.href='{{ route('solutions') }}'">See full comparison &amp; details →</button></div>
    </section>

    <!-- HOME PREVIEW: Products -->
    <section class="section" style="background: #f8fafc; padding-top: 60px; padding-bottom: 80px;">
      <div class="section-head reveal text-center" style="max-width: 600px; margin: 0 auto 50px;">
        <span class="eyebrow">Products</span>
        <h2>Hardware we stand behind</h2>
        <p>Tier-1 panels, hybrid inverters and smart monitoring — all under one warranty desk.</p>
      </div>

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
      <div class="view-more-row reveal" style="margin-top: 50px;"><button class="btn btn-ghost" onclick="window.location.href='{{ route('products') }}'">See full specs &amp; warranty →</button></div>
    </section>

    <!-- HOME PREVIEW: Services -->
    <section class="section section-alt">
      <div class="section-head reveal">
        <span class="eyebrow">Services</span>
        <h2>Support that outlasts the install</h2>
      </div>
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
          <div class="service-tile"><div class="ic">🛠</div><h4>AMC &amp; Maintenance</h4><p>Scheduled cleaning &amp; health checks</p></div>
        @endforelse
      </div>
      <div class="view-more-row reveal"><button class="btn btn-ghost" onclick="window.location.href='{{ route('services') }}'">See all services &amp; process →</button></div>
    </section>

    <!-- Interactive Solar Savings & EMI Calculator Section -->
    <section class="section" style="padding: 40px 4% 80px; background: var(--white);">
      <div class="calculator-section reveal" style="background: #0f172a; color: #fff; border-radius: 30px; padding: 60px 5vw; display: grid; grid-template-columns: 0.9fr 1.3fr; gap: 60px; align-items: center; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);">
        
        <!-- Left Side copy -->
        <div style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; min-height: 380px;">
          <div>
            <span style="color: var(--amber); font-weight: 700; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 12px;">Zero Downpayment Options</span>
            <h2 style="font-size: 2.8rem; font-weight: 800; line-height: 1.2; letter-spacing: -0.02em; margin: 0 0 20px; color: #fff;">
              Go Solar with <span style="background: linear-gradient(135deg, #3b82f6, #60a5fa); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Zero Investment</span>
            </h2>
            <p style="color: #94a3b8; font-size: 1.15rem; line-height: 1.6; margin: 0 0 40px; max-width: 500px;">
              Government subsidy covers your downpayment, and monthly solar saving covers your EMI.
            </p>
          </div>

          <!-- Expert Advice Card -->
          <div style="background: #1e293b; border-radius: 20px; padding: 24px; display: flex; align-items: center; gap: 20px; max-width: 440px; border: 1px solid #334155;">
            <img src="{{ asset('images/team-support.jpg') }}" alt="Solar Expert Advisor" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 2px solid #3b82f6;">
            <div>
              <h4 style="color: #fff; font-size: 1.1rem; font-weight: 700; margin: 0 0 4px;">Got questions?</h4>
              <p style="color: #94a3b8; font-size: 0.9rem; margin: 0 0 10px;">Our solar experts are just a call away.</p>
              <a href="{{ route('contact') }}" style="color: #3b82f6; font-weight: 700; text-decoration: none; font-size: 0.95rem; display: flex; align-items: center; gap: 6px; transition: color 0.2s ease;">
                Talk to our expert <span>→</span>
              </a>
            </div>
          </div>
        </div>

        <!-- Right Side Interactive Panel -->
        <div style="background: #1e293b; border: 1px solid #334155; border-radius: 24px; padding: 40px 30px;">
          <h3 style="color: #fff; font-size: 1.4rem; font-weight: 700; margin: 0 0 24px;">Get Savings and EMI Estimates</h3>
          
          <!-- System Size Selection -->
          <label style="color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 12px;">System Size</label>
          <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 24px;">
            <!-- 3kW Card -->
            <div class="calc-card" onclick="selectCalcSystem('3kW', '4400', '3300')" id="calc-3kW" style="background: #0f172a; border: 2px solid #3b82f6; border-radius: 12px; padding: 16px; cursor: pointer; transition: all 0.25s ease;">
              <b style="color: #fff; font-size: 1.2rem; display: block; margin-bottom: 6px;">3kW</b>
              <span style="color: #94a3b8; font-size: 0.78rem; line-height: 1.4; display: block;">Suitable for Rs. 1500 to Rs. 2500 monthly bill</span>
            </div>
            <!-- 4kW Card -->
            <div class="calc-card" onclick="selectCalcSystem('4kW', '7300', '5500')" id="calc-4kW" style="background: #0f172a; border: 2px solid #334155; border-radius: 12px; padding: 16px; cursor: pointer; transition: all 0.25s ease;">
              <b style="color: #fff; font-size: 1.2rem; display: block; margin-bottom: 6px;">4kW</b>
              <span style="color: #94a3b8; font-size: 0.78rem; line-height: 1.4; display: block;">Suitable for Rs. 2500 to Rs. 4000 monthly bill</span>
            </div>
            <!-- 5kW Card -->
            <div class="calc-card" onclick="selectCalcSystem('5kW', '9800', '7400')" id="calc-5kW" style="background: #0f172a; border: 2px solid #334155; border-radius: 12px; padding: 16px; cursor: pointer; transition: all 0.25s ease;">
              <b style="color: #fff; font-size: 1.2rem; display: block; margin-bottom: 6px;">5kW</b>
              <span style="color: #94a3b8; font-size: 0.78rem; line-height: 1.4; display: block;">Suitable for Rs. 4000 to Rs. 8000 monthly bill</span>
            </div>
          </div>

          <!-- EMI Tenure -->
          <label style="color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 12px;">EMI Tenure</label>
          <div style="background: #0f172a; border: 2px solid #3b82f6; border-radius: 10px; padding: 12px 20px; display: inline-block; margin-bottom: 32px;">
            <b style="color: #fff; font-size: 0.95rem;">60 Months</b>
          </div>

          <!-- Output metrics -->
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; border-top: 1px solid #334155; padding-top: 24px;">
            <div>
              <span style="color: #94a3b8; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 6px;">Your Monthly Saving</span>
              <b id="calcSavingVal" style="color: #10b981; font-size: 2.2rem; font-weight: 800; display: block;">₹4400</b>
              <span style="color: #10b981; font-size: 0.8rem; font-weight: 600;">for 25 years!</span>
            </div>
            <div>
              <span style="color: #94a3b8; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 6px;">Monthly EMI</span>
              <b id="calcEmiVal" style="color: #fff; font-size: 2.2rem; font-weight: 800; display: block;">₹3300</b>
              <span style="color: #94a3b8; font-size: 0.8rem;">60 months</span>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Powering Homes Across India (solarsquare style) -->
    <section class="section" style="padding-top:20px; padding-bottom:50px; background:var(--white);">
      <div class="section-head reveal text-center" style="max-width: 600px; margin: 0 auto 40px;">
        <h2 class="fw-bold" style="color:var(--blue-900); font-size: 2.2rem; letter-spacing: -0.02em;">Powering Homes Across India</h2>
      </div>

      <!-- Four Stats Cards Grid -->
      <div class="stats-cards-grid reveal" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; max-width: 1200px; margin: 0 auto 30px;">
        <!-- Card 1 -->
        <div class="stat-box" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; text-align: center; transition: all 0.3s ease;">
          <div style="color: var(--blue-600); margin-bottom: 12px; display: flex; align-items: center; justify-content: center; height: 36px;"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div>
          <b style="font-size: 1.8rem; color: var(--blue-900); display: block; font-weight: 700; margin-bottom: 4px;">50,000+</b>
          <span style="font-size: 0.9rem; color: var(--muted); font-weight: 500;">Homes Solarized</span>
        </div>
        <!-- Card 2 -->
        <div class="stat-box" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; text-align: center; transition: all 0.3s ease;">
          <div style="color: var(--amber); margin-bottom: 12px; display: flex; align-items: center; justify-content: center; height: 36px;"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg></div>
          <b style="font-size: 1.8rem; color: var(--blue-900); display: block; font-weight: 700; margin-bottom: 4px;">200+ MW</b>
          <span style="font-size: 0.9rem; color: var(--muted); font-weight: 500;">Power Installed</span>
        </div>
        <!-- Card 3 -->
        <div class="stat-box" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; text-align: center; transition: all 0.3s ease;">
          <div style="color: #10b981; margin-bottom: 12px; display: flex; align-items: center; justify-content: center; height: 36px;"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
          <b style="font-size: 1.8rem; color: var(--blue-900); display: block; font-weight: 700; margin-bottom: 4px;">₹300+ Cr</b>
          <span style="font-size: 0.9rem; color: var(--muted); font-weight: 500;">Subsidy Delivered</span>
        </div>
        <!-- Card 4 -->
        <div class="stat-box" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; text-align: center; transition: all 0.3s ease;">
          <div style="color: #6366f1; margin-bottom: 12px; display: flex; align-items: center; justify-content: center; height: 36px;"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></div>
          <b style="font-size: 1.8rem; color: var(--blue-900); display: block; font-weight: 700; margin-bottom: 4px;">#1 Home Solar</b>
          <span style="font-size: 0.9rem; color: var(--muted); font-weight: 500;">On National Portal</span>
        </div>
      </div>

      <!-- Map & CTA Strip below cards -->
      <div class="stats-cta-strip reveal" style="background: #f0f9ff; border: 1px solid #e0f2fe; border-radius: 16px; padding: 20px 30px; display: flex; align-items: center; justify-content: space-between; max-width: 1200px; margin: 0 auto; gap: 20px; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 16px; flex: 1; min-width: 280px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><polygon points="3 6 9 3 15 6 21 3 21 18 15 15 9 18 3 15"/></svg>
          <p style="color: var(--blue-900); font-weight: 600; font-size: 1.05rem; margin: 0; line-height: 1.5; text-align: left;">
            We are present in 31 Cities across 10 States, and are growing every day.
          </p>
        </div>
        <button class="btn btn-primary" onclick="window.location.href='{{ route('contact') }}'" style="background: #0f172a; border-color: #0f172a; color: #fff; padding: 14px 32px; border-radius: 10px; font-weight: 600; font-size: 0.95rem; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15); transition: all 0.25s ease;">
          Unlock Your Solar Savings
        </button>
      </div>
    </section>

    <!-- HOME PREVIEW: PM Surya Ghar -->
    <section class="section" style="background: var(--sky-50); padding: 80px 4%;">
      <div class="pm-surya-grid reveal">
        
        <!-- Left Side: Logo & Info Card -->
        <div style="background: #fff; padding: 40px; border-radius: 30px; border: 1px solid var(--sky-200); box-shadow: 0 15px 40px rgba(15, 23, 42, 0.05); text-align: center;">
          <img src="{{ asset('images/pm-surya-ghar-logo.png') }}" alt="PM Surya Ghar Muft Bijli Yojana Logo" style="max-width: 280px; width: 100%; height: auto; display: block; margin: 0 auto 30px; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.03));">
          <div style="background: var(--amber-light); border: 1px solid var(--amber); border-radius: 20px; padding: 24px; text-align: center;">
            <span style="color: var(--amber-dark); font-weight: 700; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 8px;">Direct Benefit Transfer</span>
            <h4 style="color: var(--blue-900); font-weight: 800; font-size: 1.15rem; margin: 0 0 6px;">Up to ₹78,000 Subsidy</h4>
            <p style="color: var(--muted); font-size: 0.88rem; line-height: 1.5; margin: 0;">Get direct central government subsidy credited straight to your bank account within 30 days of commissioning.</p>
          </div>
        </div>

        <!-- Right Side: Content Details -->
        <div>
          <span class="eyebrow" style="color: var(--amber-dark);">National Portal Empanelled</span>
          <h2 style="color: var(--blue-900); font-size: 2.5rem; font-weight: 800; line-height: 1.25; margin: 12px 0 20px; letter-spacing: -0.02em;">
            PM Surya Ghar: <br><span style="color: var(--blue-600);">Muft Bijli Yojana</span>
          </h2>
          <p style="color: var(--muted); font-size: 1.1rem; line-height: 1.7; margin-bottom: 28px;">
            The Government of India's flagship program to solarize residential rooftops. Power your home, target zero electricity bills, and earn by feeding surplus power back to the grid. AES Energy takes care of the end-to-end liaisoning, approvals, and subsidy processing for you.
          </p>
          
          <ul style="list-style: none; padding-left: 0; margin-bottom: 32px;">
            <li style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 16px;">
              <span style="width: 24px; height: 24px; border-radius: 50%; background: #e0f2fe; color: var(--blue-600); display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: bold; font-size: 0.85rem; margin-top: 2px;">✓</span>
              <div>
                <b style="color: var(--blue-900); font-size: 1rem; display: block; margin-bottom: 2px;">300 Units Free Electricity</b>
                <span style="color: var(--muted); font-size: 0.88rem;">Sufficient to cover the average household monthly energy requirement.</span>
              </div>
            </li>
            <li style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 16px;">
              <span style="width: 24px; height: 24px; border-radius: 50%; background: #e0f2fe; color: var(--blue-600); display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: bold; font-size: 0.85rem; margin-top: 2px;">✓</span>
              <div>
                <b style="color: var(--blue-900); font-size: 1rem; display: block; margin-bottom: 2px;">End-to-End Handholding</b>
                <span style="color: var(--muted); font-size: 0.88rem;">We handle portal registration, DISCOM technical approvals, site inspection, and subsidy release.</span>
              </div>
            </li>
            <li style="display: flex; align-items: flex-start; gap: 12px;">
              <span style="width: 24px; height: 24px; border-radius: 50%; background: #e0f2fe; color: var(--blue-600); display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: bold; font-size: 0.85rem; margin-top: 2px;">✓</span>
              <div>
                <b style="color: var(--blue-900); font-size: 1rem; display: block; margin-bottom: 2px;">Upfront Subsidy Deduction</b>
                <span style="color: var(--muted); font-size: 0.88rem;">Choose our easy finance options and pay only the non-subsidised share.</span>
              </div>
            </li>
          </ul>

          <div style="display: flex; gap: 16px; align-items: center; flex-wrap: wrap;">
            <button class="btn btn-primary" onclick="window.location.href='{{ route('suryaghar') }}'" style="padding: 16px 36px; border-radius: 12px; font-weight: 700; font-size: 1.05rem; box-shadow: 0 10px 20px rgba(15, 23, 42, 0.1);">
              See Subsidy Slabs
            </button>
            <button class="btn btn-outline" onclick="window.location.href='{{ route('contact') }}'" style="padding: 16px 36px; border-radius: 12px; font-weight: 700; font-size: 1.05rem; border: 2px solid var(--blue-600); color: var(--blue-600);">
              Check Eligibility
            </button>
          </div>
        </div>

      </div>
    </section>

    <!-- Testimonial Slider / Carousel (Img 2) -->
    <section class="section section-alt" style="overflow:hidden; position:relative; padding:80px 0;">
      <div class="section-head reveal text-center">
        <span class="eyebrow">Customer Stories</span>
        <h2>Trusted by thousands of rooftops</h2>
      </div>
      
      <!-- Slider Track -->
      <div class="testi-carousel-container reveal" style="max-width:1240px; margin:0 auto; position:relative; overflow:hidden; padding:20px 60px;">
        <div class="testi-slider-track d-flex" id="testiSliderTrack" style="transition: transform 0.5s ease-in-out; width: 100%;">
          @forelse($reviews as $rev)
            <div class="testi-slide">
              <div class="testi-card text-center" style="background:#fff; border-radius:24px; position:relative; height: 100%; display: flex; flex-direction: column; justify-content: space-between; border: 1px solid var(--sky-200); padding: 36px 24px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);">
                <div>
                  <div class="testi-stars fs-3 mb-3 text-warning">★★★★★</div>
                  <p class="text-dark" style="font-size: 0.95rem; line-height: 1.65; margin-bottom: 20px; font-style: italic; font-weight: 500;">"{{ $rev->description }}"</p>
                </div>
                <div class="testi-person d-flex align-items-center justify-content-center gap-3">
                  <div class="testi-avatar" style="width:50px; height:50px; border-radius:50%; background:var(--blue-900); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                    @php
                      $words = explode(' ', trim($rev->heading));
                      $initials = '';
                      foreach(array_slice($words, 0, 2) as $w) { $initials .= strtoupper(substr($w, 0, 1)); }
                    @endphp
                    {{ $initials ?: 'AES' }}
                  </div>
                  <div class="text-start">
                    <b class="d-block text-dark">{{ $rev->heading }}</b>
                    <span class="text-muted fs-12">{{ $rev->sub_heading }}</span>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="testi-slide">
              <div class="testi-card text-center" style="background:#fff; border-radius:24px; height: 100%; display: flex; flex-direction: column; justify-content: space-between; border: 1px solid var(--sky-200); padding: 36px 24px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);">
                <div>
                  <div class="testi-stars fs-3 mb-3 text-warning">★★★★★</div>
                  <p class="text-dark" style="font-size: 0.95rem; line-height: 1.65; margin-bottom: 20px; font-style: italic; font-weight: 500;">"Our bill dropped from ₹4,200 to almost zero within the first month. The team handled the subsidy paperwork end to end."</p>
                </div>
                <div class="testi-person d-flex align-items-center justify-content-center gap-3">
                  <div class="testi-avatar" style="width:50px; height:50px; border-radius:50%; background:var(--blue-900); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:bold;">PN</div>
                  <div class="text-start">
                    <b>Priya Nair</b>
                    <span class="text-muted fs-12">Pune, 5kW system</span>
                  </div>
                </div>
              </div>
            </div>
          @endforelse
        </div>
        
        <!-- Navigation Buttons -->
        <button class="carousel-control-prev" type="button" onclick="slidePrev()" style="position:absolute; left:10px; top:50%; transform:translateY(-50%); background:var(--blue-900); color:#fff; border:none; width:44px; height:44px; border-radius:50%; opacity:0.8; z-index:10; display:flex; align-items:center; justify-content:center; cursor:pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:block;"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button class="carousel-control-next" type="button" onclick="slideNext()" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:var(--blue-900); color:#fff; border:none; width:44px; height:44px; border-radius:50%; opacity:0.8; z-index:10; display:flex; align-items:center; justify-content:center; cursor:pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:block;"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
      </div>

      <!-- Dots Indicators -->
      <div class="d-flex justify-content-center gap-2 mt-4" id="carouselDots">
        <!-- Generated dynamically via JS -->
      </div>
    </section>

    <!-- HOME PREVIEW: Contact -->
    <section class="section">
      <div class="section-head reveal">
        <span class="eyebrow">Contact</span>
        <h2>Let's design your rooftop system</h2>
        <p>Share a few details — our design team gets back within one business day.</p>
      </div>
      <div class="quick-contact-row reveal-stagger">
        <div class="quick-contact-item"><div class="ic"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div><div><b>Head Office</b><span>{{ \App\MyClasses\GeneralHelperFunctions::getSetting('address') ?? 'Baner Road, Pune, Maharashtra' }}</span></div></div>
        <div class="quick-contact-item"><div class="ic"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div><div><b>Call Us</b><span><a href="tel:+91{{ \App\MyClasses\GeneralHelperFunctions::getSetting('mobile') ?? '9876543210' }}" style="color:inherit;font-weight:600;">+91 {{ \App\MyClasses\GeneralHelperFunctions::getSetting('mobile') ?? '9876543210' }}</a></span></div></div>
        <div class="quick-contact-item"><div class="ic"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div><div><b>Email</b><span><a href="mailto:{{ \App\MyClasses\GeneralHelperFunctions::getSetting('email') ?? 'contact@aesenergy.in' }}" style="color:inherit;">{{ \App\MyClasses\GeneralHelperFunctions::getSetting('email') ?? 'contact@aesenergy.in' }}</a></span></div></div>
      </div>
      <div class="view-more-row reveal"><button class="btn btn-primary" onclick="window.location.href='{{ route('contact') }}'">Go to full contact page →</button></div>
    </section>

    <section class="section" style="padding-top:20px;">
      <div class="cta-banner reveal">
        <h2>Ready to see your savings?</h2>
        <p>Book a free rooftop survey — no obligation, results in 24 hours.</p>
        <button class="btn btn-amber" onclick="window.location.href='{{ route('contact') }}'">Get Free Site Survey</button>
      </div>
    </section>
@endsection

@push('stackedScripts')
<script>
  // Testimonial Carousel Logic
  let currentSlide = 0;
  const slides = document.querySelectorAll('.testi-slide');
  const track = document.getElementById('testiSliderTrack');
  const dotsContainer = document.getElementById('carouselDots');

  function getVisibleCards() {
      if (window.innerWidth <= 600) return 1;
      if (window.innerWidth <= 900) return 2;
      return 3;
  }

  function maxSlideIndex() {
      return Math.max(0, slides.length - getVisibleCards());
  }

  function initDots() {
      dotsContainer.innerHTML = '';
      const totalDots = maxSlideIndex() + 1;
      for (let i = 0; i < totalDots; i++) {
          const dot = document.createElement('button');
          dot.style.width = '10px';
          dot.style.height = '10px';
          dot.style.borderRadius = '50%';
          dot.style.border = 'none';
          dot.style.background = i === currentSlide ? 'var(--blue-900)' : '#cbd5e1';
          dot.style.padding = '0';
          dot.style.margin = '0 4px';
          dot.style.cursor = 'pointer';
          dot.setAttribute('onclick', `goToSlide(${i})`);
          dot.classList.add('carousel-dot');
          dotsContainer.appendChild(dot);
      }
  }

  function updateCarousel() {
      const visible = getVisibleCards();
      const maxIdx = maxSlideIndex();
      if (currentSlide > maxIdx) {
          currentSlide = maxIdx;
      }
      const cardWidthPercentage = 100 / visible;
      track.style.transform = `translateX(-${currentSlide * cardWidthPercentage}%)`;

      document.querySelectorAll('.carousel-dot').forEach((dot, index) => {
          dot.style.background = index === currentSlide ? 'var(--blue-900)' : '#cbd5e1';
      });
  }

  function slideNext() {
      const maxIdx = maxSlideIndex();
      if (maxIdx === 0) return;
      currentSlide = currentSlide + 1;
      if (currentSlide > maxIdx) {
          currentSlide = 0;
      }
      updateCarousel();
  }

  function slidePrev() {
      const maxIdx = maxSlideIndex();
      if (maxIdx === 0) return;
      currentSlide = currentSlide - 1;
      if (currentSlide < 0) {
          currentSlide = maxIdx;
      }
      updateCarousel();
  }

  function goToSlide(index) {
      currentSlide = index;
      updateCarousel();
  }

  window.addEventListener('resize', () => {
      initDots();
      updateCarousel();
  });

  function selectCalcSystem(size, saving, emi) {
      document.querySelectorAll('.calc-card').forEach(card => {
          card.style.borderColor = '#334155';
      });
      document.getElementById('calc-' + size).style.borderColor = '#3b82f6';
      document.getElementById('calcSavingVal').innerText = '₹' + saving;
      document.getElementById('calcEmiVal').innerText = '₹' + emi;
  }

  // Initialize
  initDots();
  updateCarousel();
  // Auto slide every 6 seconds
  setInterval(slideNext, 6000);
</script>
@endpush
