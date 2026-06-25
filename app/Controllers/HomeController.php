<?php

declare(strict_types=1);

namespace App\Controllers;

class HomeController extends Controller
{
    /** Landing principal de MEM - Medicina Estética Medellín. */
    public function index(): void
    {
        $this->view('home', [], 'Programa Integral de Rejuvenecimiento Facial para Hombres | MEM Medellín');
    }
}
