@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'About Us — AES Energy')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<style>

  .about-photo-wrapper {
    position: relative;
  }
  .about-photo-primary {
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12);
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }
  .about-photo-wrapper:hover .about-photo-primary {
    transform: scale(1.02);
  }
  
  /* Capabilities pill list layout */
  .solution-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
  }
  .solution-card {
    background: #fff;
    border: 1px solid var(--sky-200);
    border-radius: 16px;
    padding: 20px 24px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .solution-card:hover {
    transform: translateY(-3px);
    border-color: var(--blue-500);
    box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
  }
  .solution-card .ic {
    font-size: 2rem;
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    background: #f0f9ff;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .solution-card h4 {
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--blue-900);
    margin: 0;
    line-height: 1.4;
  }

  /* Premium Milestones Timeline styling */
  .milestone-container {
    max-width: 800px;
    margin: 40px auto 0;
    position: relative;
    padding-left: 36px;
  }
  .milestone-container::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 10px;
    bottom: 10px;
    width: 3px;
    background: var(--sky-200);
  }
  .milestone-node {
    position: relative;
    margin-bottom: 40px;
  }
  .milestone-node:last-child {
    margin-bottom: 0;
  }
  .milestone-marker {
    position: absolute;
    left: -33px;
    top: 6px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: var(--blue-600);
    border: 4px solid #fff;
    box-shadow: 0 0 0 3px var(--sky-200);
    transition: background 0.3s ease;
  }
  .milestone-node:hover .milestone-marker {
    background: var(--amber);
    box-shadow: 0 0 0 3px var(--amber-light);
  }
  .milestone-content-box {
    background: #fff;
    border: 1px solid var(--sky-200);
    border-radius: 16px;
    padding: 24px;
    box-shadow: var(--shadow-sm);
    transition: border-color 0.3s ease;
  }
  .milestone-node:hover .milestone-content-box {
    border-color: var(--blue-300);
  }
  .milestone-year {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--blue-600);
    display: inline-block;
    margin-bottom: 6px;
  }
  .milestone-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--blue-900);
    margin-bottom: 8px;
  }
  .milestone-desc {
    color: var(--muted);
    font-size: 0.92rem;
    line-height: 1.6;
    margin: 0;
  }
</style>

<div class="page-banner">
  <div>
    <span class="crumb">Home / About Us</span>
    <h1 class="fw-bold">{{ $website_sections['About_Us']->heading ?? 'About AES Energy' }}</h1>
    <p class="max-w-600">{{ $website_sections['About_Us']->sub_heading ?? '' }}</p>
  </div>
</div>

<section class="section">
  <div class="about-grid" style="align-items: stretch; gap: 48px;">
    <div class="about-photo-wrapper reveal">
      @php
        $aboutMainImg = (isset($website_sections['About_Us']) && $website_sections['About_Us']->hasMedia('avatar')) 
          ? $website_sections['About_Us']->avatarUrl['250'] 
          : asset('images/about-main.jpg');
      @endphp
      <img src="{{ $aboutMainImg }}" alt="AES Solar Rooftop Installations" class="about-photo-primary">
      <div class="about-badge" style="background:var(--amber); color:#fff; position:absolute; bottom:20px; right:20px; box-shadow:0 10px 20px rgba(0,0,0,0.1);"><b>9+ Yrs</b><div><span style="color:#fff;font-weight:700;display:block;">Experience</span><span style="font-size:.8rem;color:rgba(255,255,255,0.9);">Quality Solar &amp; Electrical</span></div></div>
    </div>
    <div class="reveal" style="display: flex; flex-direction: column; justify-content: center;">
      <span class="eyebrow" style="color:var(--amber);">Our Foundation</span>
      <h2 style="color:var(--blue-900);font-size:2.1rem;margin:14px 0 20px; font-weight:800; letter-spacing:-0.02em;">Engineered for High-Performance Power</h2>
      
      @php
        // Only output the first paragraph of the description here next to the picture for a clean profile view
        $paragraphs = explode("\n\n", $website_sections['About_Us']->description);
        $introText = $paragraphs[0] ?? '';
      @endphp
      <p style="color:var(--muted); line-height:1.85; font-size:1.05rem; margin:0;">
        {{ $introText }}
      </p>
    </div>
  </div>
</section>

@if(isset($website_sections['What_We_Do']))
<section class="section section-alt" style="border-top: 1px solid var(--sky-200); border-bottom: 1px solid var(--sky-200);">
  <div class="section-head reveal text-center" style="max-width: 600px; margin: 0 auto 40px;">
    <span class="eyebrow" style="color:var(--amber);">Capabilities</span>
    <h2 class="fw-bold" style="color:var(--blue-900); font-size: 2.2rem; letter-spacing:-0.02em;">{{ $website_sections['What_We_Do']->heading }}</h2>
    <p class="text-muted" style="font-size:1.05rem;">{{ $website_sections['What_We_Do']->sub_heading }}</p>
  </div>
  
  <div class="solution-grid reveal-stagger">
    @php
      $items = array_filter(array_map('trim', explode("\n", $website_sections['What_We_Do']->description)));
    @endphp
    @foreach($items as $index => $item)
      @php
        $cleanedItem = ltrim($item, '- ');
        $parts = explode(':', $cleanedItem, 2);
        $title = $parts[0] ?? $cleanedItem;
        
        $svgIcon = '';
        switch ($index % 9) {
            case 0:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>';
                break;
            case 1:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>';
                break;
            case 2:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>';
                break;
            case 3:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>';
                break;
            case 4:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>';
                break;
            case 5:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 0 1 .83 12c-2.3 2.95-6 3.96-9.19 2.5a9 9 0 0 1-6-7v-2h2v2a7 7 0 0 0 4.67 5.44C13.25 18.5 16 16.5 17 14M12 2h2v4h-2V2zM6 2h2v4H6V2z"/></svg>';
                break;
            case 6:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="9" y1="22" x2="9" y2="16"/><line x1="15" y1="22" x2="15" y2="16"/><path d="M9 16h6"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M8 10h.01"/><path d="M16 10h.01"/></svg>';
                break;
            case 7:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>';
                break;
            case 8:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="6" width="18" height="12" rx="2" ry="2"/><line x1="23" y1="11" x2="23" y2="13"/><line x1="6" y1="6" x2="6" y2="18"/><line x1="11" y1="6" x2="11" y2="18"/><line x1="16" y1="6" x2="16" y2="18"/></svg>';
                break;
        }
      @endphp
      <div class="solution-card">
        <div class="ic">{!! $svgIcon !!}</div>
        <div>
          <h4>{{ $title }}</h4>
        </div>
      </div>
    @endforeach
  </div>
</section>
@endif

<section class="section">
  <div class="section-head reveal text-center mb-5">
    <span class="eyebrow" style="color:var(--amber);">Milestones</span>
    <h2 class="fw-bold" style="color:var(--blue-900); font-size: 2.2rem; letter-spacing:-0.02em;">Our Corporate Milestones</h2>
  </div>
  
  <div class="milestone-container reveal-stagger">
    <div class="milestone-node">
      <div class="milestone-marker"></div>
      <div class="milestone-content-box">
        <span class="milestone-year">2017</span>
        <h4 class="milestone-title">Journey Commenced</h4>
        <p class="milestone-desc">Inception with a focus on Industrial Electrical installation, maintenance, and solar rooftop commissioning.</p>
      </div>
    </div>
    
    <div class="milestone-node">
      <div class="milestone-marker"></div>
      <div class="milestone-content-box">
        <span class="milestone-year">2020</span>
        <h4 class="milestone-title">Formal Corporate Expansion</h4>
        <p class="milestone-desc">Became GST registered on 31 December 2020, strengthening formal operations and serving customers with a structured approach.</p>
      </div>
    </div>
    
    <div class="milestone-node">
      <div class="milestone-marker"></div>
      <div class="milestone-content-box">
        <span class="milestone-year">2026 (August)</span>
        <h4 class="milestone-title">GEDA Registration</h4>
        <p class="milestone-desc">Registered formally with GEDA, further strengthening our presence in Gujarat's renewable energy sector.</p>
      </div>
    </div>
    
    <div class="milestone-node">
      <div class="milestone-marker"></div>
      <div class="milestone-content-box">
        <span class="milestone-year">2026 (September)</span>
        <h4 class="milestone-title">MNRE Empanelment</h4>
        <p class="milestone-desc">Empanelled with MNRE, enabling us to participate in the government-supported solar ecosystem and deliver compliant rooftop solar solutions.</p>
      </div>
    </div>
  </div>
</section>

@if(isset($website_sections['Our_Commitment']))
<section class="section section-alt" style="background: linear-gradient(180deg, #fff 0%, #f0f9ff 100%); padding: 100px 0;">
  <div class="container reveal" style="max-width: 950px; margin: 0 auto; text-align: center; background: #fff; border: 1px solid var(--sky-200); border-radius: 24px; padding: 60px 40px; box-shadow: 0 20px 50px rgba(15, 23, 42, 0.06); position: relative;">
    <div style="position: absolute; top: -30px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; border-radius: 50%; background: var(--blue-900); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; font-family: serif; box-shadow: 0 10px 20px rgba(15, 23, 42, 0.15);">“</div>
    
    <span class="eyebrow" style="color:var(--amber); display:block; margin-bottom:12px; margin-top: 10px;">{{ $website_sections['Our_Commitment']->heading }}</span>
    <h2 class="fw-bold" style="color:var(--blue-900); font-size: 2.2rem; margin-bottom: 24px; letter-spacing: -0.02em;">
      {{ $website_sections['Our_Commitment']->sub_heading }}
    </h2>
    
    @php
      $commitParagraphs = explode("\n\n", $website_sections['Our_Commitment']->description);
    @endphp
    @foreach($commitParagraphs as $cp)
      @if($loop->last)
        <div style="margin-top: 30px; padding-top: 24px; border-top: 1px solid var(--sky-200);">
          <h4 style="color: var(--blue-900); font-weight: 700; font-size: 1.15rem; letter-spacing: 0.02em; margin: 0; text-transform: uppercase;">
            {{ $cp }}
          </h4>
        </div>
      @else
        <p style="color: var(--muted); font-size: 1.08rem; line-height: 1.85; margin-bottom: 18px; max-width: 780px; margin-left: auto; margin-right: auto;">
          {{ $cp }}
        </p>
      @endif
    @endforeach
  </div>
</section>
@endif
@endsection
