---
target: landing home
total_score: 33
p0_count: 0
p1_count: 1
timestamp: 2026-06-25T02-07-17Z
slug: app-views-home-php
---
# Critique — Landing MEM (home)

Réplica fiel de un sitio Elementor en producción. Muchas decisiones replican el original; los hallazgos se marcan como "heredado" cuando aplican.

## Design Health Score

| # | Heuristic | Score | Key Issue |
|---|-----------|-------|-----------|
| 1 | Visibility of System Status | 3 | CTAs con :hover; sin estados de carga (no hay forms) |
| 2 | Match System / Real World | 4 | Español claro, orden natural |
| 3 | User Control and Freedom | 3 | CTAs abren WhatsApp; sin trampas |
| 4 | Consistency and Standards | 4 | Botones/colores/tipografía consistentes |
| 5 | Error Prevention | 3 | Sin formularios reales (CTA→WhatsApp) |
| 6 | Recognition Rather Than Recall | 4 | Página única, todo visible |
| 7 | Flexibility and Efficiency | 3 | Un solo camino de conversión |
| 8 | Aesthetic and Minimalist Design | 3 | 6 CTAs idénticos repetidos (estrategia del original) |
| 9 | Error Recovery | 3 | Vista 404 básica; sin forms que recuperar |
| 10 | Help and Documentation | 3 | WhatsApp es el canal de ayuda |
| **Total** | | **33/40** | **Good** |

## Anti-Patterns Verdict
- LLM: NO se siente "AI generado" — es una landing de conversión real, con identidad de marca propia (teal+lima, fotos reales). No hay cards genéricas, ni eyebrows, ni gradient text.
- Detector: 2 warnings — `overused-font` y `single-font` (solo Montserrat). Ambos HEREDADOS del original.

## Priority Issues
- **[P1] Contraste del botón verde**: texto casi-blanco sobre lima `#9ec30a` ≈ 1.9:1 (falla WCAG AA 4.5:1). Heredado del original. Fix: oscurecer el verde o usar texto oscuro en los botones. Command: /impeccable colorize.
- **[P2] Enlaces sociales muertos**: Facebook/Instagram apuntan a `href="#"`. Fix: poner URLs reales. Command: /impeccable clarify.
- **[P2] Repetición de CTA idéntico (6×)**: estrategia de conversión del original, pero monótona. Fix opcional: variar microcopy. Command: /impeccable clarify.
- **[P3] Tipografía única (Montserrat)**: detector flag; intencional por fidelidad. Fix opcional: par display+texto. Command: /impeccable typeset.

## Persona Red Flags
- **Jordan (first-timer)**: value prop y CTA claros; OK. Riesgo bajo.
- **Casey (mobile)**: CTAs alcanzables, WhatsApp flotante; verificar overflow del h1 en breakpoints pequeños.
- **Riley (stress)**: enlaces sociales muertos; formularios del original eliminados (CTA→WhatsApp).
- **Diego (ejecutivo escéptico, 45 — project persona)**: busca prueba/credibilidad; la sección INVIMA/habilitación ayuda, pero faltan testimonios/casos reales.

## Minor Observations
- Tipografía única intencional (fidelidad).
- Botón verde es el elemento de marca; cualquier cambio de contraste debe decidirse vs fidelidad al original.

## Questions to Consider
- ¿Prima la fidelidad exacta al original, o se permite mejorar accesibilidad (contraste) aunque cambie un poco el look?
- ¿Los enlaces sociales deben apuntar a perfiles reales del negocio?
