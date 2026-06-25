<?php

declare(strict_types=1);

use App\Controllers\HomeController;

/**
 * Definicion de rutas. URL -> [Controlador, metodo].
 * Agrega aqui las rutas de cada proyecto.
 */
Flight::route('GET /', [HomeController::class, 'index']);
