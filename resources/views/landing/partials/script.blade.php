<script>
(function () {
  'use strict';
  var d = document, root = d.documentElement;
  root.classList.add('js');
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Sticky header shadow
  var header = d.querySelector('.site-header');
  var onScroll = function () { header.classList.toggle('scrolled', window.scrollY > 8); };
  onScroll(); window.addEventListener('scroll', onScroll, { passive: true });

  // Mobile menu
  var burger = d.querySelector('.burger'), nav = d.getElementById('mainNav');
  function setMenu(open) {
    nav.classList.toggle('open', open);
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    burger.setAttribute('aria-label', open ? burger.dataset.close : burger.dataset.open);
  }
  burger.addEventListener('click', function () { setMenu(!nav.classList.contains('open')); });
  nav.addEventListener('click', function (e) { if (e.target.closest('a')) setMenu(false); });
  d.addEventListener('keydown', function (e) { if (e.key === 'Escape' && nav.classList.contains('open')) { setMenu(false); burger.focus(); } });

  // Active nav indicator
  var links = [].slice.call(d.querySelectorAll('.main-nav ul a'));
  if ('IntersectionObserver' in window) {
    var so = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) links.forEach(function (a) { a.classList.toggle('active', a.getAttribute('href') === '#' + en.target.id); });
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    links.forEach(function (a) { var s = d.querySelector(a.getAttribute('href')); if (s) so.observe(s); });

    // Reveal on scroll
    var ro = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) { if (en.isIntersecting) { en.target.classList.add('in'); ro.unobserve(en.target); } });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
    d.querySelectorAll('.reveal').forEach(function (el) { reduce ? el.classList.add('in') : ro.observe(el); });
  } else {
    d.querySelectorAll('.reveal').forEach(function (el) { el.classList.add('in'); });
  }

  // Solution tabs (WAI-ARIA tabs pattern)
  var tabs = [].slice.call(d.querySelectorAll('[role=tab]'));
  function select(i, focus) {
    tabs.forEach(function (t, j) {
      var on = i === j, p = d.getElementById(t.getAttribute('aria-controls'));
      t.setAttribute('aria-selected', on ? 'true' : 'false');
      t.tabIndex = on ? 0 : -1;
      p.hidden = !on;
    });
    if (focus) tabs[i].focus();
    tabs[i].scrollIntoView && window.innerWidth < 1060 && tabs[i].scrollIntoView({ block: 'nearest', inline: 'center', behavior: reduce ? 'auto' : 'smooth' });
  }
  tabs.forEach(function (t, i) {
    t.addEventListener('click', function () { select(i); });
    t.addEventListener('keydown', function (e) {
      var k = e.key, n = tabs.length, next = null;
      if (k === 'ArrowDown' || k === 'ArrowRight') next = (i + 1) % n;
      if (k === 'ArrowUp' || k === 'ArrowLeft') next = (i - 1 + n) % n;
      if (k === 'Home') next = 0; if (k === 'End') next = n - 1;
      if (next !== null) { e.preventDefault(); select(next, true); }
    });
  });
  d.querySelectorAll('[data-tab]').forEach(function (a) { a.addEventListener('click', function () { select(+a.dataset.tab); }); });

  // Solution CTA pre-selects project type
  d.querySelectorAll('[data-project-type]').forEach(function (a) {
    a.addEventListener('click', function () { var s = d.getElementById('f-type'); if (s) s.selectedIndex = +a.dataset.projectType + 1; });
  });

  // FAQ accordion
  d.querySelectorAll('.faq-item button').forEach(function (b) {
    b.addEventListener('click', function () {
      var item = b.closest('.faq-item'), open = !item.classList.contains('open');
      item.classList.toggle('open', open);
      b.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  });

  // Show all projects
  var more = d.getElementById('moreWork');
  if (more) more.addEventListener('click', function () {
    var g = d.querySelector('.work-grid'); var on = g.classList.toggle('show-all');
    more.setAttribute('aria-expanded', on ? 'true' : 'false');
    if (on) g.querySelectorAll('.is-extra').forEach(function (el) { el.classList.add('in'); });
  });

  // Contact form: client + server validation, real result
  var form = d.getElementById('contactForm'); if (!form) return;
  var T = window.DV_I18N || {}, msg = d.getElementById('formMsg'), btn = form.querySelector('[type=submit]'), btnLabel = btn.querySelector('span');
  var idle = btnLabel.textContent;
  function setErr(name, text) {
    var f = form.elements[name]; if (!f) return;
    var wrap = f.closest('.field'), e = d.getElementById('e-' + name);
    wrap.classList.toggle('invalid', !!text);
    f.setAttribute('aria-invalid', text ? 'true' : 'false');
    if (e) { e.textContent = text || ''; text ? f.setAttribute('aria-describedby', e.id) : f.removeAttribute('aria-describedby'); }
  }
  function check(name) {
    var f = form.elements[name], v = (f.value || '').trim(), t = '';
    if (f.required && !v) t = T.required;
    else if (name === 'email' && v && !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v)) t = T.email;
    else if (name === 'phone' && v && !/^[+()0-9\s.\-]{6,}$/.test(v)) t = T.phone;
    else if (name === 'project_idea' && v && v.length < 10) t = T.min;
    setErr(name, t); return !t;
  }
  var names = ['name', 'email', 'phone', 'project_type', 'project_idea'];
  names.forEach(function (n) { var f = form.elements[n]; f.addEventListener('blur', function () { if (f.value) check(n); }); f.addEventListener('input', function () { if (f.closest('.field').classList.contains('invalid')) check(n); }); });
  function show(ok, text) { msg.hidden = false; msg.className = 'form-msg ' + (ok ? 'ok' : 'ko'); msg.textContent = text; }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    msg.hidden = true;
    var valid = names.map(check).every(Boolean);
    if (!valid) { var bad = form.querySelector('[aria-invalid=true]'); if (bad) bad.focus(); return; }
    btn.disabled = true; btnLabel.textContent = btn.dataset.sending;
    fetch(form.action, {
      method: 'POST',
      headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': d.querySelector('meta[name=csrf-token]').content, 'X-Requested-With': 'XMLHttpRequest' },
      body: new FormData(form)
    }).then(function (r) {
      return r.json().catch(function () { return {}; }).then(function (data) {
        if (r.ok && data.success) { form.reset(); show(true, data.message || T.success); return; }
        if (r.status === 422 && data.errors) {
          Object.keys(data.errors).forEach(function (k) { setErr(k, data.errors[k][0]); });
          var bad = form.querySelector('[aria-invalid=true]'); if (bad) bad.focus();
        }
        show(false, (r.status === 422 && data.message) ? T.error : T.error);
      });
    }).catch(function () { show(false, T.network); })
      .finally(function () { btn.disabled = false; btnLabel.textContent = idle; });
  });
})();
</script>
