<?php $wa = Flight::get('config')['app']['wa_link']; ?>

<!-- NAV -->
<header class="nav">
    <div class="shell nav__row">
        <img class="nav__logo" src="/img/logo-color.png" alt="MEM - Medicina Estética Medellín" width="168" height="60" decoding="async" fetchpriority="high">
        <a class="btn btn--sm nav__cta" href="<?= $wa ?>">Quiero agendar mi asesoría profesional</a>
    </div>
</header>

<!-- HERO -->
<section class="hero" style="background-image:url('/img/Banner-programa-MEM-Medicina-estetica.jpg');">
    <div class="shell hero__inner">
        <p class="kicker">"Miles de hombres en el mundo se realizan estos procedimientos y nadie lo sabe".</p>
        <h1 class="hero__title">Rejuvenece hasta 10 años <em>sin perder naturalidad,</em> mostrando tu juventud en tu entorno social y laboral.</h1>
        <div class="hero__actions">
            <a class="btn btn--lg" href="<?= $wa ?>">Quiero agendar mi asesoría profesional</a>
        </div>
    </div>
</section>

<!-- PILARES / beneficios -->
<section class="pillars">
    <div class="shell pillars__grid">
        <div class="pillars__lead">
            <h2>Elimina arrugas, rellena y rejuvenece tu rostro…sin cirugías y con resultados visibles desde la primera sesión.</h2>
            <ul class="ticks">
                <li>Sin incapacidad ni reposo</li>
                <li>Sin exageraciones</li>
                <li>Sin riesgos</li>
            </ul>
        </div>
        <div class="pillars__cards">
            <figure class="treat">
                <img src="/img/2-MEM-Medicina-estetica.png" alt="Ácido Hialurónico" loading="lazy" decoding="async">
                <figcaption>Acido Hialuronico</figcaption>
            </figure>
            <figure class="treat">
                <img src="/img/3-MEM-Medicina-estetica.png" alt="Bioestimuladores" loading="lazy" decoding="async">
                <figcaption>Bioestimuladores</figcaption>
            </figure>
            <figure class="treat">
                <img src="/img/1-MEM-Medicina-estetica.png" alt="Botox" loading="lazy" decoding="async">
                <figcaption>Botox</figcaption>
            </figure>
        </div>
    </div>
</section>

<!-- PROGRAMA para hombres -->
<section class="split-feature">
    <div class="shell split-feature__grid">
        <div class="split-feature__copy">
            <h2>Programa integral de rejuvenecimiento facial para hombres</h2>
            <p>Programa Integral de Rejuvenecimiento facial: Botox, Ácido Hialurónico y Bioestimuladores naturales de colágeno.</p>
            <p class="lead-accent">¿No sabes por dónde empezar?</p>
            <p>Agenda hoy <strong>–GRATIS–</strong> tu asesoría profesional con un médico especializado y toma una decisión informada.</p>
            <p class="pricetag">Puedes empezar con <span>$600.000</span></p>
            <a class="btn" href="<?= $wa ?>">Quiero rejuvenecer como estas celebridades</a>
        </div>
        <figure class="split-feature__img">
            <img src="/img/rejuvenecimiento-MEM-Medicina-estetica.png" alt="Antes y después rejuvenecimiento facial" loading="lazy" decoding="async">
        </figure>
    </div>
</section>

<!-- PROBLEMA ¿cansado? -->
<section class="problem">
    <figure class="problem__media">
        <img src="/img/cansado-mem.jpg" alt="Hombre cansado" loading="lazy" decoding="async">
    </figure>
    <div class="problem__panel">
        <div class="problem__copy">
            <h2>¿Te ves cansado, envejecido o apagado aunque no te sientas así?</h2>
            <p>Las arrugas y líneas de expresión marcan una edad que no sientes.</p>
            <p>Los surcos, ojeras y labios pierden volumen, quitándote frescura.</p>
            <p>La piel luce opaca, flácida o manchada, robándote vitalidad.</p>
        </div>
    </div>
</section>

<!-- RESULTADOS -->
<section class="results">
    <div class="shell results__grid">
        <div class="results__head">
            <h2>Resultados <em>extraordinarios</em></h2>
        </div>
        <figure class="results__img">
            <img src="/img/antes-y-despues-MEM-Medicina-estetica.png" alt="Antes y después" loading="lazy" decoding="async">
        </figure>
    </div>
</section>

<!-- CELEBRIDADES -->
<section class="split-feature split-feature--alt">
    <div class="shell split-feature__grid split-feature__grid--rev">
        <figure class="split-feature__img">
            <img src="/img/celebridades-programa-MEM-Medicina-estetica-1024x575.png" alt="Celebridades" loading="lazy" decoding="async">
        </figure>
        <div class="split-feature__copy">
            <h2>Muchas celebridades</h2>
            <p>se han realizado estos procedimientos y todos se preguntan</p>
            <p class="lead-accent">¿cómo han logrado rejuvenecer?</p>
            <a class="btn" href="<?= $wa ?>">Quiero rejuvenecer como estas celebridades</a>
        </div>
    </div>
</section>

<!-- NECESIDADES (oscura, números grandes) -->
<section class="needs" style="background-image:url('/img/resumen-programa-MEM-Medicina-estetica.jpg');">
    <div class="shell">
        <header class="needs__head">
            <h2>Programa Integral <em>de Rejuvenecimiento Facial</em></h2>
            <p>Te presentamos nuestro Programa Integral de Rejuvenecimiento Facial, diseñado para identificar cada necesidad específica de tu rostro:</p>
            <p class="needs__q">¿Qué necesita tu rostro? Elige tu solución ideal:</p>
        </header>
        <div class="needs__grid">
            <article class="need">
                <span class="need__no">01</span>
                <h3>Minimizar arrugas y líneas de expresión</h3>
                <p>El Botox suaviza y previene arrugas y líneas de expresión, devolviéndote esa imagen fresca y vital que sentías perdida.</p>
            </article>
            <article class="need">
                <span class="need__no">02</span>
                <h3>Rellenar surcos, ojeras, labios o código de barras</h3>
                <p>El Ácido Hialurónico rellena de manera natural surcos como los nasogenianos, ojeras o líneas del labio superior, devolviéndote frescura y juventud.</p>
            </article>
            <article class="need">
                <span class="need__no">03</span>
                <h3>Mejorar la calidad, elasticidad y luminosidad de tu piel</h3>
                <p>Los Bioestimuladores de colágeno (como Sculptra o Radiesse) estimulan tu piel desde adentro, mejorando firmeza, textura y luminosidad con resultados progresivos.</p>
            </article>
        </div>
    </div>
</section>

<!-- PROCESO (timeline) -->
<section class="journey">
    <div class="shell">
        <header class="sec-head">
            <h2>¿Cómo será tu experiencia desde este momento?</h2>
            <p>Es muy fácil…solo tienes que seguir estos pasos:</p>
        </header>
        <ol class="timeline">
            <li class="tl">
                <div class="tl__dot"><img src="/img/Registro-programa-MEM-Medicina-estetica.jpg" alt="Registro" loading="lazy" decoding="async"></div>
                <p>Dale clic al botón y regístrate en el formulario con tu nombre, correo y celular.</p>
            </li>
            <li class="tl">
                <div class="tl__dot"><img src="/img/asesoria-MEM-Medicina-estetica.jpg" alt="Asesoría" loading="lazy" decoding="async"></div>
                <p>Dale "enviar", y uno de nuestros asesores se pondrá en contacto contigo a través de Whatsapp.</p>
            </li>
            <li class="tl">
                <div class="tl__dot"><img src="/img/preguntas-MEM-Medicina-estetica.jpg" alt="Preguntas" loading="lazy" decoding="async"></div>
                <p>Aclara tus dudas y programa tu asesoría.</p>
            </li>
            <li class="tl">
                <div class="tl__dot"><img src="/img/cita-MEM-Medicina-estetica.jpg" alt="Cita" loading="lazy" decoding="async"></div>
                <p>Asiste a tu cita, recibe la asesoría y el documento con tu plan personalizado.</p>
            </li>
            <li class="tl">
                <div class="tl__dot"><img src="/img/procedimiento-MEM-Medicina-estetica.jpg" alt="Procedimiento" loading="lazy" decoding="async"></div>
                <p>Evalúa si empiezas el mismo día, o también podrás programar la fecha de inicio.</p>
            </li>
        </ol>
        <div class="sec-cta"><a class="btn btn--lg" href="<?= $wa ?>">Quiero agendar mi asesoría profesional</a></div>
    </div>
</section>

<!-- PRECIOS -->
<section class="pricing">
    <div class="shell">
        <header class="sec-head">
            <h2>Solo por tiempo limitado</h2>
            <p>agenda tu ASESORÍA PROFESIONAL completamente GRATIS.</p>
            <p>Estamos seguros que te vas a sorprender con los resultados y con tu experiencia.</p>
        </header>
        <div class="tiers">
            <article class="tier">
                <header class="tier__head">
                    <span class="tier__no">Paquete 1:</span>
                    <h3>MACHO OMEGA</h3>
                    <div class="tier__price">$600.000 <span>COP</span></div>
                </header>
                <p>Incluye: 50 unidades de Botox + Hidratación facial. Recupera una apariencia descansada y firme en menos de una hora. Ideal para hombres ejecutivos que desean suavizar líneas de expresión sin perder su carácter. El toque justo para lucir renovado y seguro en cada reunión.</p>
            </article>
            <article class="tier">
                <header class="tier__head">
                    <span class="tier__no">Paquete 2:</span>
                    <h3>MACHO BETA</h3>
                    <div class="tier__price">$1.490.000 <span>COP</span></div>
                </header>
                <p>Incluye: 50 unidades de Botox + 1 jeringa de ácido hialurónico + limpieza facial profunda con Hydrafacial. Un tratamiento completo para restaurar volumen en zonas clave del rostro, reducir arrugas y mejorar la textura de la piel. Pensado para hombres que quieren resultados visibles pero discretos.</p>
            </article>
            <article class="tier">
                <header class="tier__head">
                    <span class="tier__no">Paquete 3:</span>
                    <h3>MACHO ALPHA</h3>
                    <div class="tier__price">$3.490.000 <span>COP</span></div>
                </header>
                <p>Incluye: 50 unidades de Botox + 1 jeringa de ácido hialurónico + Bioestimulador (Radiesse o Sculptra) + limpieza facial profunda + Plasma Rico en Plaquetas. La fórmula definitiva del rejuvenecimiento masculino. Estimula la producción de colágeno, redefine el contorno facial, hidrata a profundidad y potencia la regeneración celular. Ideal para quienes quieren verse más jóvenes, firmes y en control.</p>
            </article>
        </div>
        <div class="sec-cta"><a class="btn btn--lg" href="<?= $wa ?>">Quiero agendar mi asesoría profesional</a></div>
    </div>
</section>

<!-- PARA TI SI -->
<section class="fit">
    <div class="shell fit__grid">
        <h2 class="fit__title">Este programa es para ti si…</h2>
        <ol class="fit__list">
            <li>Notas arrugas o líneas que te hacen lucir mayor o cansado(a).</li>
            <li>Sientes pérdida de volumen en zonas como labios, ojeras o surcos faciales.</li>
            <li>Tu piel se ve flácida, opaca o ha perdido elasticidad.</li>
            <li>Buscas resultados naturales, no artificiales o exagerados.</li>
            <li>Quieres que un médico especialista en estética facial, te asesore en lo que realmente necesitas.</li>
        </ol>
    </div>
</section>

<!-- BENEFICIOS ASESORÍA -->
<section class="perks">
    <div class="shell">
        <h2>Beneficios de tomar la ASESORÍA PROFESIONAL</h2>
        <ul class="perks__list ticks">
            <li>Evaluación 100% personalizada según tu tipo de rostro, piel y objetivos.</li>
            <li>Recomendación médica experta, basada en tu necesidad real (no en moda o tendencias).</li>
            <li>Plan de tratamiento integral y seguro, ajustado a tus expectativas y presupuesto.</li>
            <li>Prevención de errores comunes al automedicarte o buscar soluciones sin respaldo profesional.</li>
            <li>Acompañamiento durante y después del procedimiento para garantizar tu satisfacción.</li>
        </ul>
    </div>
</section>

<!-- CONFIANZA + DUDAS -->
<section class="closer">
    <div class="closer__dark" style="background-image:url('/img/resumen-programa-MEM-Medicina-estetica.jpg');">
        <div class="closer__inner">
            <h2>Programa Integral <em>de Rejuvenecimiento Facial</em></h2>
            <ul class="ticks ticks--light">
                <li>Tenemos amplia experiencia en rejuvenecimiento facial.</li>
                <li>Contamos con un equipo médico calificado y especializado.</li>
                <li>Más de 1500 pacientes satisfechos.</li>
                <li>Tratamientos seguros y efectivos.</li>
                <li>Resultados visibles y naturales.</li>
                <li>Todos nuestros productos tienen Registro INVIMA.</li>
                <li>Nuestra clínica está debidamente habilitada por la Seccional de Salud de Antioquia y por la Secretaría de Salud de Medellín.</li>
            </ul>
            <a class="btn btn--lg" href="<?= $wa ?>">Quiero agendar mi asesoría profesional</a>
        </div>
    </div>
    <div class="closer__light">
        <div class="closer__inner">
            <h2>¿Tienes dudas?</h2>
            <p>¿Quieres hablar con uno de nuestros especialistas antes de programar tu asesoría profesional?</p>
            <a class="btn btn--lg" href="<?= $wa ?>" data-keep-wa target="_blank" rel="noopener">Quiero resolver dudas</a>
        </div>
    </div>
</section>

<!-- Modal: agendar asesoría -->
<dialog class="modal" id="agenda-modal" aria-label="Agenda tu asesoría profesional">
    <form class="modal__card" id="agenda-form" method="post" action="/agendar" novalidate>
        <button class="modal__x" type="button" data-close aria-label="Cerrar">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
        <img class="modal__logo" src="/img/logo-white.png" alt="MEM - Medicina Estética Medellín" width="170" height="61" decoding="async">

        <div class="modal__field">
            <label for="m-name">Tu nombre</label>
            <input id="m-name" name="name" type="text" autocomplete="name" required>
            <span class="modal__err" data-err-for="name"></span>
        </div>

        <div class="modal__field">
            <label for="m-email">Tu correo electrónico</label>
            <input id="m-email" name="email" type="email" autocomplete="email" required>
            <span class="modal__err" data-err-for="email"></span>
        </div>

        <div class="modal__field">
            <label for="m-phone">Tu teléfono</label>
            <input id="m-phone" name="phone" type="tel" inputmode="numeric" placeholder="Ej: 300 123 4567" autocomplete="tel" required>
            <span class="modal__err" data-err-for="phone"></span>
        </div>

        <button class="btn modal__submit" type="submit">Quiero agendar mi asesoria</button>
        <p class="modal__msg" id="agenda-msg" role="status" aria-live="polite"></p>
    </form>
</dialog>

<!-- WhatsApp -->
<a class="wa-float" href="<?= $wa ?>" target="_blank" rel="noopener" aria-label="Escríbenos por WhatsApp">
    <svg width="30" height="30" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M.1 24l1.7-6.2A11.9 11.9 0 1 1 12 24a11.9 11.9 0 0 1-5.7-1.5L.1 24zM6.6 20l.4.2a9.9 9.9 0 0 0 5 1.4 9.9 9.9 0 1 0-8.4-4.6l.3.4-1 3.6 3.7-1zM17.5 14.3c-.1-.2-.5-.3-1-.6s-1.2-.6-1.4-.6c-.2-.1-.3-.1-.5.1l-.7.8c-.1.2-.2.2-.5.1a8 8 0 0 1-2.4-1.5 9 9 0 0 1-1.6-2c-.2-.3 0-.4.1-.6l.5-.5c.1-.1.1-.3.2-.4 0-.2 0-.3 0-.4l-.7-1.7c-.2-.5-.4-.4-.5-.4h-.5c-.2 0-.4 0-.6.3a2.8 2.8 0 0 0-.9 2.1c0 1.3.9 2.5 1 2.6.1.2 1.8 2.8 4.4 3.9 1.6.7 2.2.7 3 .6.5-.1 1.2-.5 1.4-1 .2-.5.2-.9.1-1z"/></svg>
</a>
