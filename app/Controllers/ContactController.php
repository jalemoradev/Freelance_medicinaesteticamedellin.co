<?php

declare(strict_types=1);

namespace App\Controllers;

use Flight;

class ContactController extends Controller
{
    /** Recibe el formulario del modal y guarda en consultation_bookings. */
    public function store(): void
    {
        $req   = Flight::request();
        $name  = trim((string) $req->data->name);
        $email = trim((string) $req->data->email);
        $phone = trim((string) $req->data->phone);

        $errors = [];
        if ($name === '' || mb_strlen($name) < 2) {
            $errors[] = 'Ingresa tu nombre.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Ingresa un correo válido.';
        }
        if (mb_strlen(preg_replace('/\D/', '', $phone)) < 7) {
            $errors[] = 'Ingresa un teléfono válido.';
        }

        if ($errors) {
            Flight::json(['ok' => false, 'errors' => $errors], 422);
            return;
        }

        try {
            $stmt = $this->db()->prepare(
                'INSERT INTO consultation_bookings (name, email, phone) VALUES (?, ?, ?)'
            );
            $stmt->execute([$name, $email, $phone]);
            Flight::json([
                'ok' => true,
                'message' => '¡Gracias! Pronto un asesor te contactará.',
            ]);
        } catch (\Throwable $e) {
            Flight::json([
                'ok' => false,
                'errors' => ['No pudimos guardar tu solicitud. Intenta de nuevo.'],
            ], 500);
        }
    }

    /** Recibe el formulario de Infra4Fit y guarda en assessment_bookings. */
    public function storeValoracion(): void
    {
        $req    = Flight::request();
        $name   = trim((string) $req->data->nombre);
        $email  = trim((string) $req->data->correo);
        $phone  = trim((string) $req->data->celular);
        $barrio = trim((string) $req->data->barrio);

        $errors = [];
        if ($name === '' || mb_strlen($name) < 2) {
            $errors[] = 'Ingresa tu nombre.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Ingresa un correo válido.';
        }
        if (mb_strlen(preg_replace('/\D/', '', $phone)) < 7) {
            $errors[] = 'Ingresa un teléfono válido.';
        }
        if ($barrio === '') {
            $errors[] = 'Ingresa tu barrio o zona.';
        }

        if ($errors) {
            Flight::json(['ok' => false, 'errors' => $errors], 422);
            return;
        }

        try {
            $stmt = $this->db()->prepare(
                'INSERT INTO assessment_bookings (name, email, phone, neighborhood) VALUES (?, ?, ?, ?)'
            );
            $stmt->execute([$name, $email, $phone, $barrio]);
            Flight::json(['ok' => true]);
        } catch (\Throwable $e) {
            Flight::json([
                'ok' => false,
                'errors' => ['No pudimos guardar tu solicitud. Intenta de nuevo.'],
            ], 500);
        }
    }
}
