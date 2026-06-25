<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\ContactController;
use App\Controllers\AdminController;

/**
 * Definicion de rutas. URL -> [Controlador, metodo].
 * Agrega aqui las rutas de cada proyecto.
 */
Flight::route('GET /', [HomeController::class, 'index']);
Flight::route('POST /agendar', [ContactController::class, 'store']);

// Landing Infra4Fit migrada — se sirve tal cual (HTML standalone propio).
Flight::route('GET /infra4fit2', function () {
    header('Content-Type: text/html; charset=utf-8');
    readfile(BASE_PATH . '/app/Views/infra4fit.html');
});
// Form de valoración (Infra4Fit) -> guarda en assessment_bookings
Flight::route('POST /infra4fit2/agendar', [ContactController::class, 'storeValoracion']);
// Pantalla de confirmación Infra4Fit (migrada tal cual)
Flight::route('GET /infra4fit2/confirmation', function () {
    header('Content-Type: text/html; charset=utf-8');
    readfile(BASE_PATH . '/app/Views/infra4fit-confirmation.html');
});

// Panel admin (protegido por login)
Flight::route('GET /admin', [AdminController::class, 'index']);
Flight::route('POST /admin/login', [AdminController::class, 'login']);
Flight::route('GET /admin/logout', [AdminController::class, 'logout']);
Flight::route('GET /admin/export/@table', [AdminController::class, 'export']);
