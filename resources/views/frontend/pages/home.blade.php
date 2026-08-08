@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'AES Energy — Solar for Every Rooftop')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<header class="hero">
      <div class="hero-copy reveal">
        <span class="eyebrow">⚡ MNRE Empanelled Solar Partner</span>
        <h1>{!! isset($website_sections['Top_Banner']) ? $website_sections['Top_Banner']->heading : 'Turn your rooftop into a <span>power plant.</span>' !!}</h1>
        <p>{{ isset($website_sections['Top_Banner']) ? $website_sections['Top_Banner']->sub_heading : 'AES Energy designs, installs and maintains rooftop solar systems that cut your electricity bill from day one — backed by real people, real warranty, and a rewards program that thanks you for spreading the word.' }}</p>
        <div class="hero-ctas">
          <button class="btn btn-primary" onclick="window.location.href='{{ route('contact') }}'">Get Free Site Survey</button>
          <a class="btn btn-ghost" onclick="window.location.href='{{ route('solutions') }}'">Explore Solutions</a>
        </div>
        <div class="hero-stats">
          <div class="stat"><b class="counter" data-target="4200">0</b><span>Installations</span></div>
          <div class="stat"><b class="counter" data-target="38">0</b><span>MW+ Capacity Live</span></div>
          <div class="stat"><b class="counter" data-target="25">0</b><span>Yr Panel Warranty</span></div>
        </div>
      </div>
      <div class="hero-art reveal">
        <div class="sun-ray"></div>
        <div class="sun-orb"></div>
        <div class="panel-card">
          @php
            $heroImg = (isset($website_sections['Top_Banner']) && $website_sections['Top_Banner']->hasMedia('avatar')) 
              ? $website_sections['Top_Banner']->avatarUrl['250'] 
              : asset('images/hero-solar.jpg');
          @endphp
          <img src="{{ $heroImg }}" alt="Rooftop solar panels">
          <div class="panel-meta"><b><span class="pulse-dot"></span>Generating Live</b><b style="color:var(--blue-600)">6.4 kW</b></div>
        </div>
        <div class="floating-chip c1">💰 ₹4,180 saved this month</div>
        <div class="floating-chip c2">🌱 3.1T CO₂ offset</div>
      </div>
    </header>

    <div class="section" style="padding-top:0;padding-bottom:40px;">
      <div class="trust-strip reveal">
        <span>⭐ 4.8/5 Customer Rating</span>
        <span>🛡️ 25-Year Performance Warranty</span>
        <span>🏛️ MNRE Empanelled</span>
        <span>🔧 Pan-India Service Network</span>
      </div>
    </div>

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
              <p style="color:var(--muted);font-size:0.88rem;line-height:1.6;margin:10px 0;">{{ strip_tags($plan->description) }}</p>
              <button class="btn {{ $isFeatured ? 'btn-primary' : 'btn-outline' }}" style="width:100%;justify-content:center;" onclick="window.location.href='{{ route('contact') }}'">Choose Plan</button>
            </div>
          </div>
        @empty
          <div class="plan-card featured">
            <div class="plan-photo"><img src="{{ asset('images/plan-starter.jpg') }}" alt="Solar plan"></div>
            <div class="plan-body">
              <span class="kw">3 kW · Starter</span>
              <h3>Small Home Plan</h3>
              <button class="btn btn-primary" style="width:100%;" onclick="window.location.href='{{ route('contact') }}'">Choose Plan</button>
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
    <section class="section">
      <div class="section-head reveal">
        <span class="eyebrow">Products</span>
        <h2>Hardware we stand behind</h2>
        <p>Tier-1 panels, hybrid inverters and smart monitoring — all under one warranty desk.</p>
      </div>
      <div class="grid-3 reveal-stagger">
        @forelse($products as $prod)
          @php
            $defaultName = strtolower(explode(' ', $prod->heading)[0] ?? 'panel');
            $fallbackPath = 'images/product-' . ($defaultName == 'mono' ? 'panel' : ($defaultName == 'smart' ? 'inverter' : ($defaultName == 'lithium' ? 'battery' : 'panel'))) . '.jpg';
            $imgSrc = $prod->hasMedia('avatar') ? $prod->avatarUrl['250'] : asset($fallbackPath);
          @endphp
          <div class="card">
            <div class="img-wrap"><img src="{{ $imgSrc }}" alt="{{ $prod->heading }}"></div>
            <div class="card-body">
              @if(!empty($prod->sub_heading))
                <span class="tag">{{ $prod->sub_heading }}</span>
              @endif
              <h3>{{ $prod->heading }}</h3>
              <p>{{ strip_tags($prod->description) }}</p>
              <button class="card-link" onclick="window.location.href='{{ route('contact') }}'">View specs <span>→</span></button>
            </div>
          </div>
        @empty
          <p>No products currently published.</p>
        @endforelse
      </div>
      <div class="view-more-row reveal"><button class="btn btn-ghost" onclick="window.location.href='{{ route('products') }}'">See full specs &amp; warranty →</button></div>
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
        @endforelse
      </div>
      <div class="view-more-row reveal"><button class="btn btn-ghost" onclick="window.location.href='{{ route('services') }}'">See AMC plans &amp; process →</button></div>
    </section>

    <!-- HOME PREVIEW: PM Surya Ghar -->
    <section class="section">
      <div class="scheme-banner reveal">
        <div>
          <span class="eyebrow" style="color:#fff;opacity:.85;">Government Scheme</span>
          <h2>PM Surya Ghar Muft Bijli Yojana</h2>
          <p>Get up to ₹78,000 central subsidy on your rooftop solar system and target zero electricity bills. AES Energy handles registration, DISCOM approval and net-metering for you.</p>
          <ul class="scheme-points">
            <li>✅ Up to 300 units free electricity every month</li>
            <li>✅ Subsidy credited directly to your bank account</li>
          </ul>
          <button class="btn btn-amber" style="margin-top:10px;" onclick="window.location.href='{{ route('suryaghar') }}'">See subsidy slabs &amp; process →</button>
        </div>
        <div class="scheme-card">
          <span style="font-size:.85rem;opacity:.85;">Estimated subsidy for a 3kW system</span>
          <div class="amt">₹78,000</div>
          <div class="progress-track"><div class="progress-fill" id="schemeProgressHome"></div></div>
          <span style="font-size:.8rem;opacity:.85;">92% of applicants receive approval within 45 days</span>
        </div>
      </div>
    </section>

    <section class="section section-alt">
      <div class="section-head reveal">
        <span class="eyebrow">Customer Stories</span>
        <h2>Trusted by thousands of rooftops</h2>
      </div>
      <div class="testi-grid reveal-stagger">
        @forelse($reviews as $rev)
          <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p>{{ $rev->description }}</p>
            <div class="testi-person">
              <div class="testi-avatar">
                @php
                  $words = explode(' ', trim($rev->heading));
                  $initials = '';
                  foreach(array_slice($words, 0, 2) as $w) { $initials .= strtoupper(substr($w, 0, 1)); }
                @endphp
                {{ $initials ?: 'AES' }}
              </div>
              <div>
                <b>{{ $rev->heading }}</b>
                <span>{{ $rev->sub_heading }}</span>
              </div>
            </div>
          </div>
        @empty
          <div class="testi-card">
            <div class="testi-stars">★★★★★</div>
            <p>Our bill dropped from ₹4,200 to almost zero within the first month. The team handled the subsidy paperwork end to end.</p>
            <div class="testi-person"><div class="testi-avatar">PN</div><div><b>Priya Nair</b><span>Pune, 5kW system</span></div></div>
          </div>
        @endforelse
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
        <div class="quick-contact-item"><div class="ic">📍</div><div><b>Head Office</b><span>{{ \App\MyClasses\GeneralHelperFunctions::getSetting('address') ?? 'Baner Road, Pune, Maharashtra' }}</span></div></div>
        <div class="quick-contact-item"><div class="ic">📞</div><div><b>Call Us</b><span><a href="tel:+91{{ \App\MyClasses\GeneralHelperFunctions::getSetting('mobile') ?? '9876543210' }}" style="color:inherit;font-weight:600;">+91 {{ \App\MyClasses\GeneralHelperFunctions::getSetting('mobile') ?? '9876543210' }}</a></span></div></div>
        <div class="quick-contact-item"><div class="ic">✉️</div><div><b>Email</b><span><a href="mailto:{{ \App\MyClasses\GeneralHelperFunctions::getSetting('email') ?? 'contact@aesenergy.in' }}" style="color:inherit;">{{ \App\MyClasses\GeneralHelperFunctions::getSetting('email') ?? 'contact@aesenergy.in' }}</a></span></div></div>
      </div>
      <div class="view-more-row reveal"><button class="btn btn-primary" onclick="window.location.href='{{ route('contact') }}'">Go to full contact page →</button></div>
    </section>

    <section class="section" style="padding-top:20px;">
      <div class="cta-banner reveal">
        <h2>Ready to see your savings?</h2>
        <p>Book a free rooftop survey — no obligation, results in 24 hours.</p>
        <button class="btn btn-amber" onclick="window.location.href='{{ route('login') }}'">Get Free Site Survey</button>
      </div>
    </section>
@endsection
