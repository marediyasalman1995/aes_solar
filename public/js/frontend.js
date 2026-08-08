/* ============================================================
   AES Energy — frontend.js
   Shared JS: Scroll reveal, counters, JS toast notifications,
   AJAX form submissions, copy referral code, and interactions.
   ============================================================ */

/* ---------- scroll reveal + counters + progress bars ---------- */
function initScrollEffects(){
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(en=>{ if(en.isIntersecting){ en.target.classList.add('in-view'); io.unobserve(en.target); } });
  },{threshold:.15});
  document.querySelectorAll('.reveal:not(.in-view), .reveal-stagger:not(.in-view)').forEach(el=>io.observe(el));

  const counterIO = new IntersectionObserver((entries)=>{
    entries.forEach(en=>{ if(en.isIntersecting){ animateCounters(); } });
  },{threshold:.4});
  document.querySelectorAll('.hero-stats, .stat-grid, .wallet-hero').forEach(el=>counterIO.observe(el));

  const progressIO = new IntersectionObserver((entries)=>{
    entries.forEach(en=>{ if(en.isIntersecting){ triggerSchemeProgress(en.target.id); progressIO.unobserve(en.target); } });
  },{threshold:.4});
  document.querySelectorAll('.progress-fill').forEach(el=>progressIO.observe(el));

  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item=>{
    item.onclick = ()=>item.classList.toggle('open');
  });
}

function animateCounters(){
  document.querySelectorAll('.counter').forEach(el=>{
    if(el.dataset.done) return;
    const target = parseInt(el.dataset.target,10) || 0;
    const dur = 1200; const start = performance.now();
    function tick(now){
      const p = Math.min((now-start)/dur,1);
      el.textContent = Math.floor(p*target).toLocaleString('en-IN');
      if(p<1) requestAnimationFrame(tick); else { el.textContent = target.toLocaleString('en-IN'); el.dataset.done='1'; }
    }
    requestAnimationFrame(tick);
  });
}

function triggerSchemeProgress(id){
  const bar = document.getElementById(id || 'schemeProgressHome');
  if(bar){ bar.style.width='0%'; requestAnimationFrame(()=>setTimeout(()=>{bar.style.width='92%';},50)); }
}

/* ---------- mobile nav / sidebar toggles ---------- */
function toggleNav(){ 
  const nl = document.getElementById('navLinks');
  if(nl) nl.classList.toggle('open'); 
}

function toggleSidebar(){ 
  const sb = document.getElementById('sidebar');
  if(sb) sb.classList.toggle('open'); 
}

function syncDashBurger(){
  const b = document.getElementById('dashBurger');
  if(b) b.style.display = window.innerWidth<=1000 ? 'flex' : 'none';
}

/* ---------- navbar scroll shadow ---------- */
window.addEventListener('scroll', ()=>{
  const nb = document.getElementById('navbar');
  if(nb) nb.classList.toggle('scrolled', window.scrollY>10);
});

/* ---------- JS Toast Notifications ---------- */
let toastTimer;
function showToast(msg, type = 'info'){
  let t = document.getElementById('toast');
  if(!t) {
    t = document.createElement('div');
    t.id = 'toast';
    document.body.appendChild(t);
  }

  let icon = '⚡';
  let bgColor = 'var(--blue-900)';
  if (type === 'success') {
    icon = '✅';
    bgColor = '#0f766e';
  } else if (type === 'error') {
    icon = '⚠️';
    bgColor = '#be123c';
  } else if (type === 'info') {
    icon = 'ℹ️';
    bgColor = '#0369a1';
  }

  t.style.background = bgColor;
  t.innerHTML = `<span style="font-size:1.1rem;">${icon}</span> <span>${msg}</span>`;
  t.classList.add('show');

  clearTimeout(toastTimer);
  toastTimer = setTimeout(()=>t.classList.remove('show'), 3200);
}

/* ---------- public inquiry / contact form ---------- */
function submitContact(e){
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

  const btn = form.querySelector('button[type="submit"]');
  if(btn) {
    btn.disabled = true;
    btn.innerText = 'Submitting Inquiry...';
  }

  fetch('/save-inquiry', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': token,
      'Accept': 'application/json'
    },
    body: formData
  })
  .then(r => {
    if (!r.ok) {
      return r.json().then(err => { throw err; });
    }
    return r.json();
  })
  .then(data => {
    if(btn) {
      btn.disabled = false;
      btn.innerText = 'Submit Inquiry';
    }
    showToast(data.message || 'Thank you! Our engineering team will contact you shortly.', 'success');
    form.reset();
  })
  .catch(err => {
    if(btn) {
      btn.disabled = false;
      btn.innerText = 'Submit Inquiry';
    }
    console.error('Inquiry error:', err);
    if (err.errors) {
      const firstErr = Object.values(err.errors)[0][0];
      showToast(firstErr, 'error');
    } else {
      showToast(err.message || 'Something went wrong. Please try again.', 'error');
    }
  });
  return false;
}

/* ---------- newsletter subscribe ---------- */
function submitNewsletter(e){
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

  fetch('/save-newsletter', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': token,
      'Accept': 'application/json'
    },
    body: formData
  })
  .then(r => r.json())
  .then(data => {
    showToast(data.message || 'Subscribed successfully!', 'success');
    form.reset();
  })
  .catch(err => {
    showToast('Failed to subscribe. Please try again.', 'error');
  });
  return false;
}

/* ---------- initialisation on load ---------- */
document.addEventListener('DOMContentLoaded', ()=>{
  initScrollEffects();
  syncDashBurger();
});
window.addEventListener('resize', syncDashBurger);
