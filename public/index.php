<?php

declare(strict_types=1);

/**
 * Front controller. En Hostinger esta carpeta (public/) es el document root.
 * Todas las peticiones entran aqui via .htaccess.
 */

define('BASE_PATH', dirname(__DIR__));

// Solo en desarrollo (php -S): deja que el servidor sirva archivos reales
// (css, js, imagenes) y enruta el resto al front controller.
if (PHP_SAPI === 'cli-server') {
    $file = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($file)) {
        return false;
    }
}

require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . '/app/env_loader.php';
load_env(BASE_PATH . '/.env');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require BASE_PATH . '/config/config.php';
Flight::set('config', $config);

// Errores segun entorno
if (($config['app']['env'] ?? 'production') === 'development') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
}

// Conexion MariaDB/MySQL como servicio perezoso: se crea solo al usar Flight::db()
Flight::register('db', PDO::class, [
    sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=%s',
        $config['db']['host'],
        $config['db']['port'],
        $config['db']['name'],
        $config['db']['charset']
    ),
    $config['db']['user'],
    $config['db']['pass'],
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ],
]);

// Carpeta de vistas
Flight::set('flight.views.path', BASE_PATH . '/app/Views');

// Handler 404 -> vista dentro del layout
Flight::map('notFound', function () {
    Flight::response()->status(404);
    Flight::render('404', [], 'content');
    Flight::render('layout', ['title' => 'No encontrado']);
});

// Rutas de la aplicacion
require BASE_PATH . '/routes.php';

Flight::start();
