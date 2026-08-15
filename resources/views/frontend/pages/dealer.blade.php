@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Solar Dealership Program — AES Energy')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<style>
  /* Premium styles for Dealership page */
  .dealer-photo-wrapper {
    position: relative;
  }
  .dealer-photo-primary {
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12);
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }
  .dealer-photo-wrapper:hover .dealer-photo-primary {
    transform: scale(1.02);
  }
  
  /* Support pillars grid */
  .pillar-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
    max-width: 1100px;
    margin: 0 auto;
  }
  .pillar-card {
    background: #fff;
    border: 1px solid var(--sky-200);
    border-radius: 20px;
    padding: 32px 24px;
    text-align: center;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .pillar-card:hover {
    transform: translateY(-5px);
    border-color: var(--blue-400);
    box-shadow: 0 16px 32px rgba(15, 23, 42, 0.06);
  }
  .pillar-icon {
    font-size: 2.2rem;
    margin-bottom: 16px;
    display: inline-block;
  }
  .pillar-card h4 {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--blue-900);
    margin-bottom: 12px;
  }
  .pillar-card p {
    color: var(--muted);
    font-size: 0.9rem;
    line-height: 1.6;
    margin: 0;
  }
</style>

<div class="page-banner">
  <div>
    <span class="crumb">Home / Dealership</span>
    <h1 class="fw-bold">{{ $website_sections['Dealer_Banner']->heading ?? 'Grow Your Solar Business With Us' }}</h1>
    <p class="max-w-600">
      {{ $website_sections['Dealer_Banner']->sub_heading ?? '' }}
      {{ $website_sections['Dealer_Banner']->description ?? '' }}
    </p>
  </div>
</div>

<section class="section">
  <div class="about-grid" style="align-items: stretch; gap: 48px;">
    <div class="dealer-photo-wrapper reveal">
      <img src="{{ asset('images/solution-hybrid.jpg') }}" alt="Commercial Solar Installation" class="dealer-photo-primary">
      <div class="about-badge" style="background:var(--amber); color:#fff; position:absolute; bottom:20px; right:20px; box-shadow:0 10px 20px rgba(0,0,0,0.1);">
        <b>Up to 15%</b>
        <div>
          <span style="color:#fff;font-weight:700;display:block;">Dealer Margin</span>
          <span style="font-size:.8rem;color:rgba(255,255,255,0.9);">Highest industry returns</span>
        </div>
      </div>
    </div>
    
    <div class="reveal" style="display: flex; flex-direction: column; justify-content: center;">
      <span class="eyebrow" style="color:var(--amber);">Partnership Program</span>
      <h2 style="color:var(--blue-900);font-size:2.1rem;margin:14px 0 16px; font-weight:800; letter-spacing:-0.02em;">
        {{ $website_sections['Dealer_Benefits']->heading ?? 'Why Become an AES Energy Dealer?' }}
      </h2>
      <p style="color:var(--muted); line-height:1.8; margin-bottom:24px; font-size:1.02rem;">
        {{ $website_sections['Dealer_Benefits']->sub_heading ?? '' }}
      </p>

      <div class="about-list reveal-stagger">
        @php
          $benefits = array_filter(array_map('trim', explode("\n", $website_sections['Dealer_Benefits']->description)));
        @endphp
        @foreach($benefits as $idx => $benefit)
          @php
            $cleanBenefit = ltrim($benefit, '- ');
            $parts = explode(':', $cleanBenefit, 2);
            $title = $parts[0] ?? $cleanBenefit;
            $desc = $parts[1] ?? '';
            
            $svgIcon = '';
            switch ($idx % 6) {
                case 0:
                    $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>';
                    break;
                case 1:
                    $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19v-2M20 19v-2M12 4L2 8l10 4 10-4zM12 12v7M2 20h20M16 19v-5M8 19v-5"/></svg>';
                    break;
                case 2:
                    $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>';
                    break;
                case 3:
                    $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>';
                    break;
                case 4:
                    $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>';
                    break;
                case 5:
                    $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 7a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm11 14v-2a4 4 0 0 0-3-3.87m-4-12a4 4 0 0 1 0 7.75"/></svg>';
                    break;
            }
          @endphp
          <li>
            <span class="ic">{!! $svgIcon !!}</span>
            <div>
              <b>{{ $title }}</b>
              <span>{{ trim($desc) }}</span>
            </div>
          </li>
        @endforeach
      </div>
    </div>
  </div>
</section>

@if(isset($website_sections['Dealer_Support']))
<section class="section section-alt" style="border-top: 1px solid var(--sky-200); border-bottom: 1px solid var(--sky-200);">
  <div class="section-head reveal text-center mb-5">
    <span class="eyebrow" style="color:var(--amber);">{{ $website_sections['Dealer_Support']->sub_heading }}</span>
    <h2 class="fw-bold" style="color:var(--blue-900); font-size: 2.2rem; letter-spacing:-0.02em;">
      {{ $website_sections['Dealer_Support']->heading }}
    </h2>
  </div>
  
  <div class="pillar-grid reveal-stagger">
    @php
      $pillars = array_filter(array_map('trim', explode("\n", $website_sections['Dealer_Support']->description)));
    @endphp
    @foreach($pillars as $idx => $pillar)
      @php
        $cleanPillar = ltrim($pillar, '- ');
        $parts = explode(':', $cleanPillar, 2);
        $title = $parts[0] ?? $cleanPillar;
        $desc = $parts[1] ?? '';
        
        $svgIcon = '';
        switch ($idx % 5) {
            case 0:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>';
                break;
            case 1:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>';
                break;
            case 2:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>';
                break;
            case 3:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="2" y1="20" x2="22" y2="20"/><line x1="12" y1="17" x2="12" y2="20"/></svg>';
                break;
            case 4:
                $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>';
                break;
        }
      @endphp
      <div class="pillar-card">
        <span class="pillar-icon">{!! $svgIcon !!}</span>
        <h4>{{ $title }}</h4>
        <p>{{ trim($desc) }}</p>
      </div>
    @endforeach
  </div>
</section>
@endif

<section class="section" style="padding: 60px 0;">
  <div style="background: linear-gradient(135deg, var(--blue-900) 0%, #0c334d 100%); color:#fff; max-width: 900px; margin: 0 auto; border-radius: 20px; padding: 50px 30px; text-align: center; box-shadow: 0 20px 40px rgba(15,23,42,0.15); box-sizing: border-box;">
    <h2 style="font-size: 2.2rem; color: #fff; font-weight: 700; margin: 0 0 16px; letter-spacing: -0.02em; line-height: 1.3;">
      {{ $website_sections['Dealer_CTA']->heading ?? 'Ready to Partner with Gujarat\'s Trusted Solar Brand?' }}
    </h2>
    <p style="color: rgba(255, 255, 255, 0.8); max-width: 640px; margin: 0 auto 30px; font-size: 1.05rem; line-height: 1.7;">
      {{ $website_sections['Dealer_CTA']->description ?? 'Fill out our dealership inquiry form. Our network manager will connect with you to share margins, territorial rights, and catalog details.' }}
    </p>
    <a href="{{ route('contact', ['type' => 'Dealer']) }}" class="btn" style="background: var(--amber); color: #fff; padding: 16px 36px; border-radius: 12px; font-weight: 700; font-size: 1.1rem; text-decoration: none; display: inline-block; transition: all 0.25s ease; box-shadow: 0 10px 25px rgba(245, 158, 11, 0.35);">
      Apply for Dealership / Franchise →
    </a>
  </div>
</section>
@endsection
