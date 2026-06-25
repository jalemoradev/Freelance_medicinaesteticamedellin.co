<?php

declare(strict_types=1);

/**
 * Copia este archivo a config/config.php y completa tus credenciales.
 * config/config.php NUNCA se sube a git (contiene secretos).
 */
return [
    'app' => [
        'name' => 'Flight MVC Starter',
        // 'development' muestra errores en pantalla. En Hostinger usa 'production'.
        'env'  => 'development',
    ],
    'db' => [
        'host'    => '127.0.0.1',
        'port'    => '3306',
        'name'    => 'flight_starter_demo',
        'user'    => 'root',
        'pass'    => '',
        'charset' => 'utf8mb4',
    ],
];
