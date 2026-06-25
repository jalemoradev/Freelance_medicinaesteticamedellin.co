<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Modelo de ejemplo. Demuestra como un modelo concreto solo
 * declara su tabla y reutiliza los helpers del Model base.
 */
class Note extends Model
{
    protected string $table = 'notes';
}
