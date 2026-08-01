@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'AES Energy — Solar for Every Rooftop')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<header class="hero">
      <div class="hero-copy reveal">
        <span class="eyebrow">⚡ MNRE Empanelled Solar Partner</span>
        <h1>Turn your rooftop into a <span>power plant.</span></h1>
        <p>AES Energy designs, installs and maintains rooftop solar systems that cut your electricity bill from day one — backed by real people, real warranty, and a rewards program that thanks you for spreading the word.</p>
        <div class="hero-ctas">
          <button class="btn btn-primary" onclick="window.location.href='{{ route('login') }}'">Get Free Site Survey</button>
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
          <img src="{{ asset('images/hero-solar.jpg') }}" alt="Rooftop solar panels">
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
        <div class="plan-card">
          <div class="plan-photo"><img src="{{ asset('images/plan-starter.jpg') }}" alt="3kW rooftop solar plan"></div>
          <div class="plan-body">
            <span class="kw">3 kW · Starter</span>
            <h3>Small Home Plan</h3>
            <div class="plan-price"><b>₹1,68,000</b><span>all-inclusive</span></div>
            <div class="plan-subsidy">✓ ₹78,000 subsidy applied</div>
            <ul class="plan-feats">
              <li>Covers bills up to ₹2,500/month</li>
              <li>Tier-1 Mono PERC panels</li>
              <li>Net-metering &amp; paperwork included</li>
              <li>25-year panel warranty</li>
            </ul>
            <button class="btn btn-outline" style="width:100%;justify-content:center;" onclick="window.location.href='{{ route('login') }}'">Choose Plan</button>
          </div>
        </div>
        <div class="plan-card featured">
          <div class="plan-ribbon">Most Popular</div>
          <div class="plan-photo"><img src="{{ asset('images/plan-family.jpg') }}" alt="5kW rooftop solar plan"></div>
          <div class="plan-body">
            <span class="kw">5 kW · Popular</span>
            <h3>Family Home Plan</h3>
            <div class="plan-price"><b>₹2,65,000</b><span>all-inclusive</span></div>
            <div class="plan-subsidy">✓ ₹78,000 subsidy applied</div>
            <ul class="plan-feats">
              <li>Covers bills up to ₹5,000/month</li>
              <li>Smart hybrid inverter with app monitoring</li>
              <li>Battery-ready structure</li>
              <li>25-year panel + 10-year inverter warranty</li>
            </ul>
            <button class="btn btn-primary" style="width:100%;justify-content:center;" onclick="window.location.href='{{ route('login') }}'">Choose Plan</button>
          </div>
        </div>
        <div class="plan-card">
          <div class="plan-photo"><img src="{{ asset('images/plan-business.jpg') }}" alt="10kW commercial solar plan"></div>
          <div class="plan-body">
            <span class="kw">10 kW · Business</span>
            <h3>Commercial Plan</h3>
            <div class="plan-price"><b>₹4,95,000</b><span>all-inclusive</span></div>
            <div class="plan-subsidy">✓ Accelerated depreciation eligible</div>
            <ul class="plan-feats">
              <li>For offices, factories &amp; societies</li>
              <li>Hybrid battery backup option</li>
              <li>Dedicated relationship manager</li>
              <li>Priority AMC support</li>
            </ul>
            <button class="btn btn-outline" style="width:100%;justify-content:center;" onclick="window.location.href='{{ route('login') }}'">Choose Plan</button>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="about-grid">
        <div class="about-photo reveal">
          <img src="{{ asset('images/about-teaser.jpg') }}" alt="Professional solar technician installing panels">
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
        <div class="card">
          <div class="img-wrap"><img src="{{ asset('images/solution-ongrid.jpg') }}" alt="On-grid solar"></div>
          <div class="card-body"><span class="tag">Most Popular</span><h3>On-Grid Rooftop Solar</h3><p>Feed excess power back to the grid and net-meter your bill down to near zero.</p><button class="card-link" onclick="window.location.href='{{ route('login') }}'">Get a quote <span>→</span></button></div>
        </div>
        <div class="card">
          <div class="img-wrap"><img src="{{ asset('images/solution-offgrid.jpg') }}" alt="Off-grid solar"></div>
          <div class="card-body"><span class="tag">Backup Ready</span><h3>Off-Grid + Battery Storage</h3><p>Stay powered through outages with battery backup sized to your critical loads.</p><button class="card-link" onclick="window.location.href='{{ route('login') }}'">Get a quote <span>→</span></button></div>
        </div>
        <div class="card">
          <div class="img-wrap"><img src="{{ asset('images/solution-hybrid.jpg') }}" alt="Hybrid solar"></div>
          <div class="card-body"><span class="tag">For Businesses</span><h3>Hybrid Commercial Systems</h3><p>Grid-tied with battery buffer for factories, offices and housing societies.</p><button class="card-link" onclick="window.location.href='{{ route('login') }}'">Get a quote <span>→</span></button></div>
        </div>
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
        <div class="card">
          <div class="img-wrap"><img src="{{ asset('images/product-panel.jpg') }}" alt="Solar panel"></div>
          <div class="card-body"><h3>Mono PERC Panels</h3><p>Up to 21.8% module efficiency with 25-year linear output warranty.</p><button class="card-link" onclick="window.location.href='{{ route('login') }}'">View specs <span>→</span></button></div>
        </div>
        <div class="card">
          <div class="img-wrap"><img src="{{ asset('images/product-inverter.jpg') }}" alt="Solar inverter"></div>
          <div class="card-body"><h3>Smart Hybrid Inverters</h3><p>App-based monitoring with automatic grid/battery switching.</p><button class="card-link" onclick="window.location.href='{{ route('login') }}'">View specs <span>→</span></button></div>
        </div>
        <div class="card">
          <div class="img-wrap"><img src="{{ asset('images/product-battery.jpg') }}" alt="Battery storage"></div>
          <div class="card-body"><h3>Lithium Battery Banks</h3><p>Modular storage that scales as your household load grows.</p><button class="card-link" onclick="window.location.href='{{ route('login') }}'">View specs <span>→</span></button></div>
        </div>
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
        <div class="service-tile"><div class="ic">🛠</div><h4>AMC &amp; Maintenance</h4><p>Scheduled cleaning &amp; health checks</p></div>
        <div class="service-tile"><div class="ic">📞</div><h4>24×7 Support Desk</h4><p>Raise &amp; track service requests</p></div>
        <div class="service-tile"><div class="ic">📈</div><h4>Performance Monitoring</h4><p>Real-time generation tracking</p></div>
        <div class="service-tile"><div class="ic">📄</div><h4>Subsidy &amp; Net-Metering</h4><p>End-to-end documentation help</p></div>
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
        <div class="testi-card">
          <div class="testi-stars">★★★★★</div>
          <p>Our bill dropped from ₹4,200 to almost zero within the first month. The team handled the subsidy paperwork end to end.</p>
          <div class="testi-person"><div class="testi-avatar">PN</div><div><b>Priya Nair</b><span>Pune, 5kW system</span></div></div>
        </div>
        <div class="testi-card">
          <div class="testi-stars">★★★★★</div>
          <p>Installation was done in two days flat, and the app lets me track generation in real time. Great after-sales support too.</p>
          <div class="testi-person"><div class="testi-avatar">AV</div><div><b>Amit Verma</b><span>Nashik, 3kW system</span></div></div>
        </div>
        <div class="testi-card">
          <div class="testi-stars">★★★★☆</div>
          <p>Referred two neighbours after seeing my own savings — the reward wallet is a nice bonus on top of the electricity savings.</p>
          <div class="testi-person"><div class="testi-avatar">SI</div><div><b>Sneha Iyer</b><span>Mumbai, 10kW commercial</span></div></div>
        </div>
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
        <div class="quick-contact-item"><div class="ic">📍</div><div><b>Head Office</b><span>Pune, Maharashtra</span></div></div>
        <div class="quick-contact-item"><div class="ic">📞</div><div><b>Call Us</b><span>+91 98765 43210</span></div></div>
        <div class="quick-contact-item"><div class="ic">✉️</div><div><b>Email</b><span>hello@aesenergy.in</span></div></div>
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
