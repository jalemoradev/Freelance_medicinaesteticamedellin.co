<?php /** @var ?string $error */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel · MEM</title>
    <meta name="robots" content="noindex">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css?v=3">
    <link rel="icon" type="image/png" href="/img/logo-color.png">
</head>
<body class="adm adm-login">
    <form class="login" method="post" action="/admin/login" autocomplete="on">
        <img class="login__logo" src="/img/logo-white.png" alt="MEM" width="160" height="58">
        <h1 class="login__title">Panel administrativo</h1>
        <?php if (!empty($error)): ?>
            <p class="login__error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <label class="field">
            <span>Usuario</span>
            <input name="username" type="text" autocomplete="username" required autofocus>
        </label>
        <label class="field">
            <span>Contraseña</span>
            <span class="field__pw">
                <input id="pw" name="password" type="password" autocomplete="current-password" required>
                <button type="button" class="pw-toggle" data-pw-toggle aria-label="Mostrar contraseña">
                    <svg class="pw-eye" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
                    <svg class="pw-eye-off" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" hidden><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-7-11-7a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 7 11 7a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                </button>
            </span>
        </label>
        <button class="btn-adm" type="submit">Ingresar</button>
    </form>
    <script>
        (function () {
            var btn = document.querySelector('[data-pw-toggle]'), inp = document.getElementById('pw');
            if (!btn || !inp) return;
            btn.addEventListener('click', function () {
                var show = inp.type === 'password';
                inp.type = show ? 'text' : 'password';
                btn.setAttribute('aria-label', show ? 'Ocultar contraseña' : 'Mostrar contraseña');
                btn.querySelector('.pw-eye').hidden = show;
                btn.querySelector('.pw-eye-off').hidden = !show;
                inp.focus();
            });
        })();
    </script>
</body>
</html>
