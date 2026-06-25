<?php

declare(strict_types=1);

/**
 * Configuración derivada del .env (no contiene secretos; se puede versionar).
 * Los valores reales viven en .env (ignorado por git).
 */
return [
    'app' => [
        'name'    => env('APP_NAME', 'MEM - Medicina Estética Medellín'),
        'env'     => env('APP_ENV', 'production'),
        'wa_link' => env('WA_LINK', 'https://wa.link/nd1uez'),
    ],
    'db' => [
        'host'    => env('DB_HOST', 'localhost'),
        'port'    => env('DB_PORT', '3306'),
        'name'    => env('DB_NAME', ''),
        'user'    => env('DB_USER', ''),
        'pass'    => env('DB_PASS', ''),
        'charset' => env('DB_CHARSET', 'utf8mb4'),
    ],
];
