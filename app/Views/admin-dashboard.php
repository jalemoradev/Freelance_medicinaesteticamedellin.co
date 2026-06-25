<?php
/** @var string $user */
/** @var array $tables */
/** @var array $data */
/** @var array $stats */
$firstKey = array_key_first($tables);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard · MEM</title>
    <meta name="robots" content="noindex">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css?v=3">
    <link rel="icon" type="image/png" href="/img/logo-color.png">
</head>
<body class="dash">

    <aside class="side" data-side>
        <div class="side__brand">
            <img src="/img/logo-white.png" alt="MEM" width="120" height="44">
        </div>
        <nav class="side__nav">
            <?php foreach ($tables as $key => $meta): ?>
                <button class="nav-item <?= $key === $firstKey ? 'is-active' : '' ?>" data-nav="<?= $key ?>" type="button">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 5h18M3 12h18M3 19h18"/></svg>
                    <span><?= htmlspecialchars($meta['title']) ?></span>
                    <em class="nav-item__count"><?= (int) ($stats[$key]['total'] ?? 0) ?></em>
                </button>
            <?php endforeach; ?>
        </nav>
        <div class="side__foot">
            <div class="side__user">
                <span class="side__avatar"><?= strtoupper(mb_substr($user, 0, 1)) ?></span>
                <span class="side__uname"><?= htmlspecialchars($user) ?></span>
            </div>
            <a class="side__logout" href="/admin/logout">Cerrar sesión</a>
        </div>
    </aside>

    <div class="dash__main">
        <header class="dash__top">
            <button class="dash__burger" data-burger type="button" aria-label="Menú">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
            </button>
            <div>
                <h1 class="dash__title" data-title><?= htmlspecialchars($tables[$firstKey]['title']) ?></h1>
                <p class="dash__sub">Registros de agendamiento</p>
            </div>
        </header>

        <div class="dash__content">
            <?php foreach ($tables as $key => $meta): $rows = $data[$key] ?? []; $s = $stats[$key] ?? ['total' => 0, 'week' => 0, 'today' => 0]; ?>
                <section class="view <?= $key === $firstKey ? 'is-active' : '' ?>" data-view="<?= $key ?>">

                    <div class="kpis">
                        <div class="kpi">
                            <span class="kpi__label">Total registros</span>
                            <span class="kpi__num"><?= (int) $s['total'] ?></span>
                        </div>
                        <div class="kpi">
                            <span class="kpi__label">Últimos 7 días</span>
                            <span class="kpi__num"><?= (int) $s['week'] ?></span>
                        </div>
                        <div class="kpi">
                            <span class="kpi__label">Hoy</span>
                            <span class="kpi__num"><?= (int) $s['today'] ?></span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__head">
                            <h2 class="card__title"><?= htmlspecialchars($meta['title']) ?></h2>
                            <div class="card__actions">
                                <label class="search">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                                    <input type="search" placeholder="Buscar…" data-search aria-label="Buscar">
                                </label>
                                <a class="btn-export" href="/admin/export/<?= $key ?>">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"/></svg>
                                    Exportar
                                </a>
                            </div>
                        </div>

                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr><?php foreach ($meta['labels'] as $l): ?><th><?= htmlspecialchars($l) ?></th><?php endforeach; ?></tr>
                                </thead>
                                <tbody>
                                <?php if (empty($rows)): ?>
                                    <tr><td class="empty" colspan="<?= count($meta['labels']) ?>">Aún no hay registros.</td></tr>
                                <?php else: foreach ($rows as $row): ?>
                                    <tr><?php foreach ($meta['cols'] as $c): ?><td><?= htmlspecialchars((string) ($row[$c] ?? '')) ?></td><?php endforeach; ?></tr>
                                <?php endforeach; endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="pager" data-pager></div>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        (function () {
            // Navegación sidebar <-> vistas
            var navs = document.querySelectorAll('.nav-item');
            var title = document.querySelector('[data-title]');
            var side = document.querySelector('[data-side]');
            navs.forEach(function (n) {
                n.addEventListener('click', function () {
                    navs.forEach(function (x) { x.classList.remove('is-active'); });
                    document.querySelectorAll('.view').forEach(function (v) { v.classList.remove('is-active'); });
                    n.classList.add('is-active');
                    var v = document.querySelector('.view[data-view="' + n.dataset.nav + '"]');
                    if (v) v.classList.add('is-active');
                    if (title) title.textContent = n.querySelector('span').textContent;
                    if (side) side.classList.remove('is-open');
                });
            });
            // Menú móvil
            var burger = document.querySelector('[data-burger]');
            if (burger && side) burger.addEventListener('click', function () { side.classList.toggle('is-open'); });

            // Búsqueda + paginación por vista
            var PER = 10;
            document.querySelectorAll('.view').forEach(function (view) {
                var tbody = view.querySelector('tbody');
                var pager = view.querySelector('[data-pager]');
                var search = view.querySelector('[data-search]');
                if (!tbody) return;
                var all = Array.prototype.slice.call(tbody.querySelectorAll('tr')).filter(function (tr) { return !tr.querySelector('.empty'); });
                var cur = 1, filtered = all;

                function mk(label, enabled, cb) {
                    var b = document.createElement('button');
                    b.className = 'pager__btn'; b.textContent = label; b.disabled = !enabled;
                    if (enabled) b.addEventListener('click', cb);
                    return b;
                }
                function render() {
                    all.forEach(function (tr) { tr.style.display = 'none'; });
                    var pages = Math.max(1, Math.ceil(filtered.length / PER));
                    if (cur > pages) cur = pages;
                    filtered.forEach(function (tr, i) { if (i >= (cur - 1) * PER && i < cur * PER) tr.style.display = ''; });
                    if (!pager) return;
                    pager.innerHTML = '';
                    if (filtered.length <= PER) { pager.style.display = 'none'; return; }
                    pager.style.display = 'flex';
                    pager.appendChild(mk('‹', cur > 1, function () { cur--; render(); }));
                    var info = document.createElement('span'); info.className = 'pager__info';
                    info.textContent = 'Página ' + cur + ' de ' + pages; pager.appendChild(info);
                    pager.appendChild(mk('›', cur < pages, function () { cur++; render(); }));
                }
                if (search) {
                    search.addEventListener('input', function () {
                        var q = search.value.trim().toLowerCase();
                        filtered = q ? all.filter(function (tr) { return tr.textContent.toLowerCase().indexOf(q) > -1; }) : all;
                        cur = 1; render();
                    });
                }
                if (all.length) render();
            });
        })();
    </script>
</body>
</html>
