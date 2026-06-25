<?php

declare(strict_types=1);

namespace App\Models;

use Flight;
use PDO;

/**
 * Modelo base. Acceso minimo a MariaDB via PDO.
 * Los modelos concretos definen $table y heredan los helpers.
 */
abstract class Model
{
    protected PDO $db;
    protected string $table = '';

    public function __construct()
    {
        $this->db = Flight::db();
    }

    /** Ejecuta una consulta preparada y devuelve todas las filas. */
    protected function query(string $sql, array $params = []): array
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /** Todas las filas de la tabla del modelo. */
    public function all(): array
    {
        return $this->query("SELECT * FROM {$this->table}");
    }

    /** Una fila por id, o null si no existe. */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
