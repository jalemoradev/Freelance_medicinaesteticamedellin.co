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
