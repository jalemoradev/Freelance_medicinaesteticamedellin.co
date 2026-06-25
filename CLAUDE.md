# CLAUDE.md — medicinaesteticamedellin.co

## Design Context

This project uses **Impeccable** for design work. Read before any UI change:
- **PRODUCT.md** — strategic (register: `brand`; personality: profesional/confiable/discreto; anti-references: spa-femenino, promesas exageradas, plantilla AI genérica).
- **DESIGN.md** — visual system (generate with `/impeccable document` once available).

Brand essentials: teal `#09a4c2` + verde lima `#9ec30a`, tipografía **Montserrat**. Mobile-first, WCAG AA, respetar `prefers-reduced-motion`.

## Project

FlightPHP MVC landing — réplica fiel del sitio en producción `medicinaesteticamedellin.co`.
Reconstruida a mano (HTML/CSS propio, sin Elementor); solo se descargaron las imágenes.

- **Run local:** `php -S localhost:8000 -t public public/index.php`
- **Deploy:** Hostinger vía Git (document root = `public/`).
