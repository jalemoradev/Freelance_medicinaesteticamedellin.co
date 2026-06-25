<?php

declare(strict_types=1);

/**
 * Cargador de variables .env sin librerías.
 * Lee CLAVE=valor y las expone vía env() / $_ENV / getenv().
 */
function load_env(string $path): void
{
    if (!is_file($path)) {
        return;
    }
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || !str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        // Quitar comillas envolventes ("..." o '...')
        if (strlen($value) >= 2
            && ($value[0] === '"' || $value[0] === "'")
            && $value[strlen($value) - 1] === $value[0]) {
            $value = substr($value, 1, -1);
        }
        if ($key === '') {
            continue;
        }
        $_ENV[$key] = $value;
        putenv("{$key}={$value}");
    }
}

/**
 * Lee una variable de entorno con valor por defecto.
 * Convierte true/false/null de texto a su tipo real.
 */
function env(string $key, mixed $default = null): mixed
{
    $value = $_ENV[$key] ?? getenv($key);
    if ($value === false || $value === null || $value === '') {
        return $default;
    }
    return match (strtolower((string) $value)) {
        'true'  => true,
        'false' => false,
        'null'  => null,
        default => $value,
    };
}
