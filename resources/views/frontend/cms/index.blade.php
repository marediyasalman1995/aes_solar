@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? $cms_detail->title . ' — AES Energy')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<div class="page-banner">
  <div>
    <span class="crumb">Home / Legal &amp; Policies / {{ $cms_detail->title }}</span>
    <h1>{{ $cms_detail->title }}</h1>
    <p>Last updated: {{ $cms_detail->updated_at ? $cms_detail->updated_at->format('F d, Y') : date('F d, Y') }} · Official Documentation for AES Energy customers and partners.</p>
  </div>
</div>

<section class="section" style="background:#fff; padding: 60px 5vw;">
  <div class="container" style="max-width: 900px; margin: 0 auto;">
    <div class="cms-article" style="line-height: 1.85; color: var(--ink); font-size: 1.02rem;">
      {!! $cms_detail->description !!}
    </div>

    <div style="margin-top: 50px; padding: 26px 30px; background: var(--sky-50); border: 1px solid var(--sky-200); border-radius: 16px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
      <div>
        <b style="color: var(--blue-900); font-size: 1.05rem; display: block; margin-bottom: 4px;">Have questions regarding this policy?</b>
        <p style="color: var(--muted); font-size: 0.88rem; margin: 0;">Our legal and customer grievance officers are available Mon–Sat (9 AM – 7 PM).</p>
      </div>
      <a href="{{ route('contact') }}" class="btn btn-primary">Contact Support</a>
    </div>
  </div>
</section>
@endsection
