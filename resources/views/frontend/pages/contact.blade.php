@extends('frontend.layouts.master')

@section('meta_title', $seo['meta_title'] ?? 'Contact Us - AES Energy')
@section('meta_description', $seo['meta_description'] ?? '')
@section('meta_keyword', $seo['meta_keyword'] ?? '')

@section('content')
<div class="page-banner">
      <div><span class="crumb">Home / Contact</span><h1>Let's design your rooftop system</h1><p>Share a few details — our design team gets back within one business day.</p></div>
    </div>
    <section class="section">
      <div class="contact-wrap">
        <div class="reveal">
          <ul class="contact-info">
            <li><div class="ic">📍</div><div><b>Head Office</b><span>AES Energy Pvt. Ltd., Business Park, Pune, Maharashtra</span></div></li>
            <li><div class="ic">📞</div><div><b>Call Us</b><span>+91 98765 43210 (Mon–Sat, 9am–7pm)</span></div></li>
            <li><div class="ic">✉️</div><div><b>Email</b><span>hello@aesenergy.in</span></div></li>
            <li><div class="ic">🌐</div><div><b>Website</b><span>www.aesenergy.in</span></div></li>
          </ul>
          <div class="map-box mock-map"><div class="map-pin">📍</div></div>
        </div>
        <form class="form-card reveal" onsubmit="return submitContact(event)">
          <input type="hidden" name="subject" value="Website Rooftop Solar Survey Request">
          <div class="form-row">
            <div class="field"><label>Full Name</label><input type="text" name="name" placeholder="Your name" required></div>
            <div class="field"><label>Email Address</label><input type="email" name="email" placeholder="Your email address" required></div>
          </div>
          <div class="form-row">
            <div class="field"><label>Mobile Number</label><input type="tel" name="phone" placeholder="+91" required></div>
            <div class="field"><label>City</label><input type="text" name="city" placeholder="City" required></div>
          </div>
          <div class="form-row">
            <div class="field"><label>Monthly Bill (₹)</label><input type="number" name="monthly_bill" placeholder="e.g. 3500"></div>
          </div>
          <div class="field" style="margin-bottom:16px;"><label>Message</label><textarea name="message" rows="3" placeholder="Tell us about your requirement"></textarea></div>
          <button class="btn btn-primary" style="width:100%;justify-content:center;" type="submit">Request Free Survey</button>
        </form>
      </div>
    </section>
    <section class="section">
      <div class="section-head reveal"><span class="eyebrow">Visit Us</span><h2>Office hours</h2></div>
      <div class="hours-card reveal">
        <div class="hours-row"><b>Monday – Friday</b><span>9:00 AM – 7:00 PM</span></div>
        <div class="hours-row"><b>Saturday</b><span>9:00 AM – 5:00 PM</span></div>
        <div class="hours-row"><b>Sunday</b><span>Closed (support desk open)</span></div>
        <div class="hours-row"><b>24×7 Support Desk</b><span>+91 98765 43210</span></div>
      </div>
    </section>
    <section class="section section-alt">
      <div class="section-head reveal"><span class="eyebrow">FAQs</span><h2>Common questions</h2></div>
      <div style="max-width:680px;margin:0 auto;">
        <div class="faq-item" onclick="this.classList.toggle('open')"><div class="q">How long does installation take? <span class="plus">+</span></div><div class="a">Most residential systems are installed within 2–4 working days after design approval.</div></div>
        <div class="faq-item" onclick="this.classList.toggle('open')"><div class="q">Is the subsidy guaranteed? <span class="plus">+</span></div><div class="a">Subsidy is disbursed by the government under PM Surya Ghar Yojana once your system passes DISCOM inspection — AES Energy manages the entire application.</div></div>
        <div class="faq-item" onclick="this.classList.toggle('open')"><div class="q">What if it's cloudy or rains? <span class="plus">+</span></div><div class="a">Your system still generates on cloudy days at reduced output, and net-metering banks any surplus from sunny days.</div></div>
      </div>
    </section>
@endsection
