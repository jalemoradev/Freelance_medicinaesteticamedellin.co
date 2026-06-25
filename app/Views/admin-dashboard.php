<?php
/** @var string $user */
/** @var array $tables */
/** @var array $data */
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
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css?v=2">
    <link rel="icon" type="image/png" href="/img/logo-color.png">
</head>
<body class="adm">
    <header class="adm-top">
        <img class="adm-top__logo" src="/img/logo-white.png" alt="MEM" width="138" height="50">
        <div class="adm-top__right">
            <span class="adm-top__user">Hola, <?= htmlspecialchars($user) ?></span>
            <a class="btn-adm btn-adm--ghost" href="/admin/logout">Salir</a>
        </div>
    </header>

    <main class="adm-main">
        <nav class="tabs">
            <?php foreach ($tables as $key => $meta): ?>
                <button class="tab <?= $key === $firstKey ? 'is-active' : '' ?>" data-tab="<?= $key ?>">
                    <?= htmlspecialchars($meta['title']) ?>
                </button>
            <?php endforeach; ?>
        </nav>

        <?php foreach ($tables as $key => $meta): $rows = $data[$key] ?? []; ?>
            <section class="panel <?= $key === $firstKey ? 'is-active' : '' ?>" data-panel="<?= $key ?>">
                <div class="panel__head">
                    <h2><?= htmlspecialchars($meta['title']) ?> <span class="count"><?= count($rows) ?></span></h2>
                    <a class="btn-adm" href="/admin/export/<?= $key ?>">Exportar a Excel</a>
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
            </section>
        <?php endforeach; ?>
    </main>

    <script>
        (function () {
            var tabs = document.querySelectorAll('.tabs .tab');
            tabs.forEach(function (t) {
                t.addEventListener('click', function () {
                    tabs.forEach(function (x) { x.classList.remove('is-active'); });
                    document.querySelectorAll('.panel').forEach(function (p) { p.classList.remove('is-active'); });
                    t.classList.add('is-active');
                    var p = document.querySelector('.panel[data-panel="' + t.dataset.tab + '"]');
                    if (p) p.classList.add('is-active');
                });
            });

            // Paginación por tabla (10 registros por página)
            var PER = 10;
            document.querySelectorAll('.panel').forEach(function (panel) {
                var tbody = panel.querySelector('tbody');
                var pager = panel.querySelector('[data-pager]');
                if (!tbody || !pager) return;
                var rows = Array.prototype.slice.call(tbody.querySelectorAll('tr'))
                    .filter(function (tr) { return !tr.querySelector('.empty'); });
                if (rows.length <= PER) { pager.style.display = 'none'; return; }
                var pages = Math.ceil(rows.length / PER), cur = 1;
                function mk(label, enabled, cb) {
                    var b = document.createElement('button');
                    b.className = 'pager__btn'; b.textContent = label; b.disabled = !enabled;
                    if (enabled) b.addEventListener('click', cb);
                    return b;
                }
                function render() {
                    rows.forEach(function (tr, i) {
                        tr.style.display = (i >= (cur - 1) * PER && i < cur * PER) ? '' : 'none';
                    });
                    pager.innerHTML = '';
                    pager.appendChild(mk('‹', cur > 1, function () { cur--; render(); }));
                    var info = document.createElement('span');
                    info.className = 'pager__info';
                    info.textContent = 'Página ' + cur + ' de ' + pages;
                    pager.appendChild(info);
                    pager.appendChild(mk('›', cur < pages, function () { cur++; render(); }));
                }
                render();
            });
        })();
    </script>
</body>
</html>
