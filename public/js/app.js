/* Animaciones de entrada — sin librerías (~1KB).
   Robusto: revela TODO lo que llega al viewport (incluso en scroll rápido o
   saltos de ancla). El contenido nunca queda oculto: si JS o motion fallan,
   no se activa el modo oculto. */
(function () {
  var root = document.documentElement;

  // reduced-motion: no animar nada, contenido visible tal cual.
  if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  // Sin requestAnimationFrame (navegadores muy viejos): no arriesgar, dejar visible.
  if (!window.requestAnimationFrame) return;

  // Activa "oculto hasta revelar" antes de pintar (este script va en <head>).
  root.classList.add('reveal-ready');

  // Failsafe: si init no corre en 3s, mostramos todo.
  var failsafe = setTimeout(function () { root.classList.remove('reveal-ready'); }, 3000);

  function init() {
    clearTimeout(failsafe);
    var pending = [].slice.call(document.querySelectorAll('.site-header, section'));
    if (!pending.length) { root.classList.remove('reveal-ready'); return; }

    function sweep() {
      var vh = window.innerHeight || document.documentElement.clientHeight;
      pending = pending.filter(function (el) {
        // Revela si el borde superior ya entró al 90% del viewport (o quedó arriba).
        if (el.getBoundingClientRect().top < vh * 0.9) { el.classList.add('in'); return false; }
        return true;
      });
      if (!pending.length) {
        window.removeEventListener('scroll', onScroll);
        window.removeEventListener('resize', onScroll);
      }
    }

    var ticking = false;
    function onScroll() {
      if (!ticking) { ticking = true; requestAnimationFrame(function () { sweep(); ticking = false; }); }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll, { passive: true });
    sweep(); // revela lo que ya está sobre el pliegue al cargar
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

/* Modal "Agenda tu asesoría": se abre desde todos los CTA (.btn) y envía a /agendar */
(function () {
  function ready(fn) {
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', fn);
    else fn();
  }
  ready(function () {
    var modal = document.getElementById('agenda-modal');
    var form = document.getElementById('agenda-form');
    if (!modal || !form) return;
    var msg = document.getElementById('agenda-msg');
    var phoneInput = document.getElementById('m-phone');

    // Banderas + indicativo + validación de teléfono (intl-tel-input)
    var iti = null;
    if (window.intlTelInput && phoneInput) {
      iti = window.intlTelInput(phoneInput, {
        initialCountry: 'co',
        preferredCountries: ['co', 'mx', 'ar', 'pe', 'cl', 'ec', 've', 'us', 'es'],
        separateDialCode: true,
        autoPlaceholder: 'aggressive',
        utilsScript: '/assets/vendor/intl-tel-input/js/utils.js'
      });
    }

    function openModal(e) { if (e) e.preventDefault(); if (modal.showModal) modal.showModal(); else modal.setAttribute('open', ''); }
    function closeModal() { if (modal.close) modal.close(); else modal.removeAttribute('open'); }

    document.querySelectorAll('a.btn:not([data-keep-wa])').forEach(function (b) { b.addEventListener('click', openModal); });
    modal.querySelectorAll('[data-close]').forEach(function (b) { b.addEventListener('click', closeModal); });
    modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });

    function setErr(field, text) {
      var el = form.querySelector('[data-err-for="' + field + '"]');
      if (el) el.textContent = text || '';
    }
    function validEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }

    // Validación por campo (cliente)
    function validate() {
      var ok = true;
      if (form.name.value.trim().length < 2) { setErr('name', 'Ingresa tu nombre.'); ok = false; } else setErr('name', '');
      if (!validEmail(form.email.value.trim())) { setErr('email', 'Ingresa un correo válido.'); ok = false; } else setErr('email', '');
      if (!phoneInput.value.trim()) { setErr('phone', 'Ingresa tu teléfono.'); ok = false; }
      else if (iti && !iti.isValidNumber()) { setErr('phone', 'Número de teléfono no válido.'); ok = false; }
      else if (!iti && phoneInput.value.replace(/\D/g, '').length < 7) { setErr('phone', 'Ingresa un teléfono válido.'); ok = false; }
      else setErr('phone', '');
      return ok;
    }

    // Limpiar el error mientras el usuario corrige
    ['name', 'email'].forEach(function (f) { form[f].addEventListener('input', function () { setErr(f, ''); }); });
    phoneInput.addEventListener('input', function () { setErr('phone', ''); });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (msg) { msg.textContent = ''; msg.className = 'modal__msg'; }
      if (!validate()) {
        var firstErr = form.querySelector('.modal__err:not(:empty)');
        if (firstErr && firstErr.previousElementSibling && firstErr.previousElementSibling.focus) {
          firstErr.previousElementSibling.focus();
        }
        return;
      }

      var fd = new FormData();
      fd.append('name', form.name.value.trim());
      fd.append('email', form.email.value.trim());
      fd.append('phone', iti ? iti.getNumber() : phoneInput.value.trim());

      var btn = form.querySelector('.modal__submit');
      var label = btn.textContent;
      btn.disabled = true; btn.textContent = 'Enviando…';

      fetch('/agendar', { method: 'POST', body: fd, headers: { 'X-Requested-With': 'fetch' } })
        .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, d: d }; }); })
        .then(function (res) {
          if (res.ok && res.d.ok) {
            if (msg) { msg.className = 'modal__msg is-ok'; msg.textContent = res.d.message || '¡Gracias!'; }
            form.reset();
            if (iti) iti.setCountry('co');
            setTimeout(closeModal, 2400);
          } else if (msg) {
            msg.className = 'modal__msg is-error';
            msg.textContent = (res.d && res.d.errors ? res.d.errors.join(' ') : 'Revisa los datos e intenta de nuevo.');
          }
        })
        .catch(function () { if (msg) { msg.className = 'modal__msg is-error'; msg.textContent = 'Error de conexión. Intenta de nuevo.'; } })
        .finally(function () { btn.disabled = false; btn.textContent = label; });
    });
  });
})();
