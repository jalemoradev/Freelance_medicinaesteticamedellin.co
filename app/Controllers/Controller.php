<?php

declare(strict_types=1);

namespace App\Controllers;

use Flight;
use PDO;

/**
 * Controlador base. Todos los controladores heredan de aqui.
 */
abstract class Controller
{
    /**
     * Renderiza una vista dentro del layout base.
     * El contenido de $template se inyecta como $content en layout.php.
     */
    protected function view(string $template, array $data = [], string $title = ''): void
    {
        Flight::render($template, $data, 'content');
        Flight::render('layout', ['title' => $title]);
    }

    /** Conexion PDO (MariaDB) lista para usar. */
    protected function db(): PDO
    {
        return Flight::db();
    }
}
