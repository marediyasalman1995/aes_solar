@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Frequently Asked Questions — AES Energy')
@section('meta_description', $seo['meta_description'] ?? 'Answers to top questions about rooftop solar panels, PM Surya Ghar subsidy, net metering, warranty, and savings.')
@section('meta_keyword', $seo['meta_keyword'] ?? 'solar faqs, pm surya ghar faqs, rooftop solar questions')

@section('content')
<div class="page-banner">
  <div>
    <span class="crumb">Home / Help &amp; Resources / FAQs</span>
    <h1>Frequently Asked Questions</h1>
    <p>Everything you need to know about rooftop solar, government subsidies, net-metering, and AES 25-year support.</p>
  </div>
</div>

<section class="section" style="background:#fff; padding: 70px 5vw;">
  <div class="container" style="max-width: 920px; margin: 0 auto;">
    
    <div class="faq-list" style="display: grid; gap: 14px;">
      @forelse($faqs as $faq)
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="q">
            <span style="font-size: 1.02rem; font-weight: 600; color: var(--blue-900);">{{ $faq->question_english }}</span>
            <span class="plus">+</span>
          </div>
          <div class="a" style="margin-top: 6px;">
            <p style="color: var(--ink); line-height: 1.75; font-size: 0.95rem; margin: 0;">{{ $faq->answer_english }}</p>
          </div>
        </div>
      @empty
        <div style="text-align: center; padding: 40px 20px; color: var(--muted);">
          <p>No FAQs published at this moment. Please reach out to our support team.</p>
        </div>
      @endforelse
    </div>

    <!-- HELP CTA BOX -->
    <div style="margin-top: 60px; padding: 34px 38px; background: linear-gradient(135deg, var(--sky-100), var(--white)); border: 1px solid var(--sky-200); border-radius: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
      <div>
        <h3 style="color: var(--blue-900); font-size: 1.25rem; margin-bottom: 6px;">Still have a question?</h3>
        <p style="color: var(--muted); font-size: 0.92rem; margin: 0;">Our solar engineers are happy to explain system sizing, savings, and subsidies for your home.</p>
      </div>
      <div style="display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="{{ route('contact') }}" class="btn btn-primary">Book Free Site Survey</a>
        <a href="tel:+919876543210" class="btn btn-outline">📞 Call Solar Expert</a>
      </div>
    </div>

  </div>
</section>

@push('stackedScripts')
<script>
  function toggleFaq(el) {
    el.classList.toggle('open');
  }
</script>
@endpush
@endsection
