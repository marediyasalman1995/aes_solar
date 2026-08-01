/* ============================================================
   AES Energy — frontend.js
   Shared JS: HTML partial loader, page/dashboard content loader,
   scroll reveal, counters, and all interactive behaviours.
   ============================================================ */

/* ---------- generic partial include loader ----------
   Any element with data-include="path/to/file.html" gets that
   file fetched and injected as its innerHTML. Runs onIncludesReady()
   after every include on the page has loaded.
------------------------------------------------------------- */
function loadIncludes(callback){
  const nodes = document.querySelectorAll('[data-include]');
  if(nodes.length === 0){ if(callback) callback(); return; }
  let remaining = nodes.length;
  nodes.forEach(el=>{
    fetch(el.getAttribute('data-include'))
      .then(r=>{ if(!r.ok) throw new Error('include failed: '+el.getAttribute('data-include')); return r.text(); })
      .then(html=>{ el.innerHTML = html; })
      .catch(err=>{ console.error(err); el.innerHTML = '<!-- include failed -->'; })
      .finally(()=>{ remaining--; if(remaining===0 && callback) callback(); });
  });
}

/* ---------- public site: page loader (index.html) ---------- */
function loadPage(name){
  const container = document.getElementById('page-content');
  if(!container) return;
  fetch('pages/'+name+'.html')
    .then(r=>r.text())
    .then(html=>{
      container.innerHTML = html;
      container.classList.remove('page-fade');
      void container.offsetWidth; /* restart animation */
      container.classList.add('page-fade');
      document.querySelectorAll('.nav-links a').forEach(a=>a.classList.toggle('active', a.dataset.page===name));
      document.getElementById('navLinks') && document.getElementById('navLinks').classList.remove('open');
      window.scrollTo(0,0);
      initScrollEffects();
      if(name==='home') animateCounters();
    })
    .catch(err=>console.error('page load failed', err));
}

/* ---------- dashboard: section loader (dashboard.html) ---------- */
function loadDash(id, el){
  const container = document.getElementById('dash-content');
  if(!container) return;
  fetch('dashboard-pages/'+id+'.html')
    .then(r=>r.text())
    .then(html=>{
      container.innerHTML = html;
      document.querySelectorAll('.side-link').forEach(s=>s.classList.remove('active'));
      if(el) el.classList.add('active');
      container.scrollTo(0,0);
      initScrollEffects();
      animateCounters();
      if(window.innerWidth<=1000){ const sb=document.getElementById('sidebar'); sb && sb.classList.remove('open'); }
    })
    .catch(err=>console.error('dashboard section load failed', err));
}

/* ---------- mobile nav / sidebar toggles ---------- */
function toggleNav(){ document.getElementById('navLinks').classList.toggle('open'); }
function toggleSidebar(){ document.getElementById('sidebar').classList.toggle('open'); }
function syncDashBurger(){
  const b = document.getElementById('dashBurger');
  if(b) b.style.display = window.innerWidth<=1000 ? 'flex' : 'none';
}

/* ---------- scroll reveal + counters + progress bars ----------
   Re-initialised every time new content is injected, since freshly
   added DOM nodes need fresh IntersectionObservers.
------------------------------------------------------------- */
function initScrollEffects(){
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(en=>{ if(en.isIntersecting){ en.target.classList.add('in-view'); io.unobserve(en.target); } });
  },{threshold:.15});
  document.querySelectorAll('.reveal:not(.in-view), .reveal-stagger:not(.in-view)').forEach(el=>io.observe(el));

  const counterIO = new IntersectionObserver((entries)=>{
    entries.forEach(en=>{ if(en.isIntersecting){ animateCounters(); } });
  },{threshold:.4});
  document.querySelectorAll('.hero-stats').forEach(el=>counterIO.observe(el));

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
    const target = parseInt(el.dataset.target,10);
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
  const bar = document.getElementById(id || 'schemeProgress');
  if(bar){ bar.style.width='0%'; requestAnimationFrame(()=>setTimeout(()=>{bar.style.width='92%';},50)); }
}

/* ---------- navbar scroll shadow ---------- */
window.addEventListener('scroll', ()=>{
  const nb = document.getElementById('navbar');
  if(nb) nb.classList.toggle('scrolled', window.scrollY>10);
});

/* ---------- toast ---------- */
let toastTimer;
function showToast(msg){
  const t = document.getElementById('toast');
  if(!t) return;
  t.textContent = msg;
  t.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(()=>t.classList.remove('show'), 2600);
}

/* ---------- refer & earn actions ---------- */
function copyCode(){
  const codeEl = document.getElementById('refCode');
  if(!codeEl) return;
  const code = codeEl.textContent;
  navigator.clipboard && navigator.clipboard.writeText(code).catch(()=>{});
  const btn = document.getElementById('copyBtn');
  btn.textContent='Copied ✓'; btn.classList.add('copied');
  showToast('Referral code copied: '+code);
  setTimeout(()=>{ btn.textContent='Copy'; btn.classList.remove('copied'); }, 1800);
}
function shareVia(channel){ showToast('Opening share via '+channel+'…'); }
function submitReferral(e){ e.preventDefault(); showToast('Referral submitted successfully!'); e.target.reset(); return false; }
function submitService(e){ e.preventDefault(); showToast('Service request raised — ticket #SR-2292'); e.target.reset(); return false; }
function submitContact(e){ e.preventDefault(); showToast('Thanks! Our team will call you shortly.'); e.target.reset(); return false; }

/* ---------- login ---------- */
function doLogin(e){
  e.preventDefault();
  window.location.href = 'dashboard.html';
  return false;
}

/* ---------- init on every page ---------- */
window.addEventListener('resize', syncDashBurger);
