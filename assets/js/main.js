/**
 * CharmVibe Blog — Main JavaScript
 */

// ─── Page Loader ────────────────────────────────────────────
window.addEventListener('load', () => {
  const loader = document.getElementById('page-loader');
  if (loader) {
    setTimeout(() => loader.classList.add('hidden'), 400);
  }
});

// ─── Theme Toggle ────────────────────────────────────────────
const themeBtn   = document.querySelector('.theme-btn');
const themeIcon  = themeBtn?.querySelector('i');
const savedTheme = localStorage.getItem('theme') || 'light';
document.documentElement.setAttribute('data-theme', savedTheme);
if (themeIcon) themeIcon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';

themeBtn?.addEventListener('click', () => {
  const current = document.documentElement.getAttribute('data-theme');
  const next    = current === 'dark' ? 'light' : 'dark';
  document.documentElement.setAttribute('data-theme', next);
  localStorage.setItem('theme', next);
  if (themeIcon) themeIcon.className = next === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
});

// ─── Navbar Scroll Effect ───────────────────────────────────
const navbar = document.querySelector('.navbar');
if (navbar) {
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 20);
  }, { passive: true });
}

// ─── Mobile Nav ─────────────────────────────────────────────
const hamburger  = document.querySelector('.hamburger');
const mobileNav  = document.querySelector('.mobile-nav');
const mobileNavLinks = document.querySelectorAll('.mobile-nav a');
let mobileOpen   = false;

hamburger?.addEventListener('click', () => {
  mobileOpen = !mobileOpen;
  mobileNav?.classList.toggle('open', mobileOpen);
  hamburger.setAttribute('aria-expanded', mobileOpen);
  const spans = hamburger.querySelectorAll('span');
  if (mobileOpen) {
    spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
    spans[1].style.opacity   = '0';
    spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
  } else {
    spans.forEach(s => { s.style.transform = ''; s.style.opacity = ''; });
  }
});

mobileNavLinks.forEach(link => link.addEventListener('click', () => {
  mobileOpen = false;
  mobileNav?.classList.remove('open');
  const spans = hamburger?.querySelectorAll('span');
  spans?.forEach(s => { s.style.transform = ''; s.style.opacity = ''; });
}));

// ─── Search Overlay ─────────────────────────────────────────
const searchBtn     = document.querySelector('.search-btn');
const searchOverlay = document.querySelector('.search-overlay');
const searchClose   = document.querySelector('.search-close');
const searchInput   = document.querySelector('.search-overlay input');
const searchResults = document.querySelector('.search-results');

searchBtn?.addEventListener('click', () => {
  searchOverlay?.classList.add('open');
  setTimeout(() => searchInput?.focus(), 100);
});
searchClose?.addEventListener('click', () => searchOverlay?.classList.remove('open'));
searchOverlay?.addEventListener('click', e => { if (e.target === searchOverlay) searchOverlay.classList.remove('open'); });

// AJAX Search
let searchTimer;
searchInput?.addEventListener('input', () => {
  clearTimeout(searchTimer);
  const q = searchInput.value.trim();
  if (q.length < 2) { if (searchResults) searchResults.innerHTML = ''; return; }
  searchTimer = setTimeout(async () => {
    try {
      const res  = await fetch(`${window.SITE_URL || ''}/includes/search.php?q=${encodeURIComponent(q)}`);
      const data = await res.json();
      if (!searchResults) return;
      if (!data.length) {
        searchResults.innerHTML = `<div class="search-result-item"><p style="color:var(--text-muted);font-size:.875rem">No results found for "<strong>${q}</strong>"</p></div>`;
        return;
      }
      searchResults.innerHTML = data.map(p =>
        `<a class="search-result-item" href="${window.SITE_URL || ''}/post.php?slug=${p.slug}">
          <div>
            <div style="font-weight:600;font-size:.875rem">${p.title}</div>
            <div style="font-size:.78rem;color:var(--text-muted);margin-top:2px">${p.category_name || ''}</div>
          </div>
        </a>`
      ).join('');
    } catch (err) { console.error('Search error:', err); }
  }, 300);
});

// ─── Hero Slider ─────────────────────────────────────────────
const slides  = document.querySelectorAll('.hero-slide');
const dots    = document.querySelectorAll('.hero-dot');
let current   = 0;
let heroTimer;

function goToSlide(n) {
  slides[current]?.classList.remove('active');
  dots[current]?.classList.remove('active');
  current = (n + slides.length) % slides.length;
  slides[current]?.classList.add('active');
  dots[current]?.classList.add('active');
}

function startAutoplay() {
  heroTimer = setInterval(() => goToSlide(current + 1), 5500);
}

if (slides.length > 0) {
  dots.forEach((dot, i) => dot.addEventListener('click', () => {
    clearInterval(heroTimer);
    goToSlide(i);
    startAutoplay();
  }));
  startAutoplay();
}

// ─── Reading Progress ────────────────────────────────────────
const progressBar = document.getElementById('reading-progress');
if (progressBar) {
  window.addEventListener('scroll', () => {
    const docH    = document.documentElement.scrollHeight - window.innerHeight;
    const pct     = docH > 0 ? (window.scrollY / docH) * 100 : 0;
    progressBar.style.width = pct + '%';
  }, { passive: true });
}

// ─── Back To Top ─────────────────────────────────────────────
const backToTop = document.getElementById('back-to-top');
if (backToTop) {
  window.addEventListener('scroll', () => {
    backToTop.classList.toggle('visible', window.scrollY > 400);
  }, { passive: true });
  backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

// ─── Blog View Toggle ────────────────────────────────────────
const viewBtns = document.querySelectorAll('.view-btn');
const postsGrid = document.querySelector('.posts-grid');
viewBtns.forEach(btn => btn.addEventListener('click', () => {
  viewBtns.forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  const view = btn.dataset.view;
  if (postsGrid) {
    postsGrid.classList.toggle('posts-list', view === 'list');
  }
}));

// ─── Category Filter ─────────────────────────────────────────
const filterBtns = document.querySelectorAll('.filter-btn');
filterBtns.forEach(btn => btn.addEventListener('click', () => {
  filterBtns.forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  const cat = btn.dataset.cat;
  const cards = document.querySelectorAll('.post-card-wrap');
  cards.forEach(card => {
    const match = !cat || cat === 'all' || card.dataset.cat === cat;
    card.style.display = match ? '' : 'none';
  });
}));

// ─── Toast Notifications ─────────────────────────────────────
function showToast(message, type = 'info', duration = 4000) {
  let container = document.querySelector('.toast-container');
  if (!container) {
    container = document.createElement('div');
    container.className = 'toast-container';
    document.body.appendChild(container);
  }
  const icons = { success: 'fa-check-circle', error: 'fa-times-circle', info: 'fa-info-circle' };
  const colors = { success: 'var(--success)', error: 'var(--danger)', info: 'var(--accent)' };
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerHTML = `<i class="fas ${icons[type]}" style="color:${colors[type]}"></i><span>${message}</span>`;
  container.appendChild(toast);
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(40px)';
    toast.style.transition = '0.3s ease';
    setTimeout(() => toast.remove(), 300);
  }, duration);
}

// ─── Forms with AJAX ────────────────────────────────────────
document.querySelectorAll('.ajax-form').forEach(form => {
  form.addEventListener('submit', async e => {
    e.preventDefault();
    const btn = form.querySelector('[type="submit"]');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending…';
    btn.disabled  = true;
    try {
      const res  = await fetch(form.action, { method: 'POST', body: new FormData(form) });
      const data = await res.json();
      if (data.success) {
        showToast(data.message || 'Submitted successfully!', 'success');
        form.reset();
      } else {
        showToast(data.message || 'Something went wrong.', 'error');
      }
    } catch {
      showToast('Network error. Please try again.', 'error');
    } finally {
      btn.innerHTML = originalText;
      btn.disabled  = false;
    }
  });
});

// ─── Newsletter ──────────────────────────────────────────────
document.querySelector('.newsletter-form')?.addEventListener('submit', e => {
  e.preventDefault();
  const input = e.target.querySelector('input[type="email"]');
  if (input?.value) {
    showToast('Thanks for subscribing! 🎉', 'success');
    input.value = '';
  }
});

// ─── Lazy Load Images ────────────────────────────────────────
if ('IntersectionObserver' in window) {
  const lazyImgs = document.querySelectorAll('img[data-src]');
  const imgObserver = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
        obs.unobserve(img);
      }
    });
  }, { rootMargin: '200px' });
  lazyImgs.forEach(img => imgObserver.observe(img));
}

// ─── Social Share ────────────────────────────────────────────
document.querySelectorAll('.share-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const url  = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(document.title);
    const type = btn.dataset.share;
    let shareUrl;
    if (type === 'facebook') shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
    if (type === 'twitter')  shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${text}`;
    if (type === 'whatsapp') shareUrl = `https://api.whatsapp.com/send?text=${text}%20${url}`;
    if (shareUrl) window.open(shareUrl, '_blank', 'width=600,height=400');
  });
});

// ─── Active Nav Link ─────────────────────────────────────────
(function() {
  const path  = window.location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.nav-links a').forEach(a => {
    const href = a.getAttribute('href')?.split('/').pop();
    if (href === path) a.classList.add('active');
  });
})();