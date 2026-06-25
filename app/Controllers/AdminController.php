<?php

declare(strict_types=1);

namespace App\Controllers;

use Flight;

class AdminController extends Controller
{
    /** Tablas exportables: clave => [título, etiquetas de columnas, columnas SQL] */
    private const TABLES = [
        'consultation_bookings' => [
            'title' => 'Página principal',
            'labels' => ['ID', 'Nombre', 'Correo', 'Teléfono', 'Fecha'],
            'cols'   => ['id', 'name', 'email', 'phone', 'created_at'],
        ],
        'assessment_bookings' => [
            'title' => 'Infra4Fit2',
            'labels' => ['ID', 'Nombre', 'Correo', 'Teléfono', 'Barrio / Zona', 'Fecha'],
            'cols'   => ['id', 'name', 'email', 'phone', 'neighborhood', 'created_at'],
        ],
    ];

    private function authed(): bool
    {
        return !empty($_SESSION['admin_id']);
    }

    /** GET /admin — login si no hay sesión; dashboard si la hay. */
    public function index(): void
    {
        if (!$this->authed()) {
            Flight::render('admin-login', ['error' => null]);
            return;
        }
        $data = [];
        $stats = [];
        $today0 = strtotime('today');
        $week0  = strtotime('-6 days 00:00:00');
        foreach (self::TABLES as $key => $meta) {
            $rows = $this->db()
                ->query("SELECT * FROM {$key} ORDER BY id DESC")
                ->fetchAll(\PDO::FETCH_ASSOC);
            $data[$key] = $rows;
            $today = 0;
            $week = 0;
            foreach ($rows as $r) {
                $ts = strtotime((string) ($r['created_at'] ?? ''));
                if ($ts === false) {
                    continue;
                }
                if ($ts >= $today0) {
                    $today++;
                }
                if ($ts >= $week0) {
                    $week++;
                }
            }
            $stats[$key] = ['total' => count($rows), 'today' => $today, 'week' => $week];
        }
        Flight::render('admin-dashboard', [
            'user'   => $_SESSION['admin_name'] ?? 'Admin',
            'tables' => self::TABLES,
            'data'   => $data,
            'stats'  => $stats,
        ]);
    }

    /** POST /admin/login */
    public function login(): void
    {
        $req = Flight::request();
        $username = trim((string) $req->data->username);
        $password = (string) $req->data->password;

        $stmt = $this->db()->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id']   = $user['id'];
            $_SESSION['admin_name'] = $user['name'];
            Flight::redirect('/admin');
            return;
        }
        Flight::render('admin-login', ['error' => 'Usuario o contraseña incorrectos.']);
    }

    /** GET /admin/logout */
    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        Flight::redirect('/admin');
    }

    /** GET /admin/export/@table — descarga Excel con formato. */
    public function export(string $table): void
    {
        if (!$this->authed()) {
            Flight::redirect('/admin');
            return;
        }
        if (!isset(self::TABLES[$table])) {
            Flight::halt(404, 'Tabla no válida');
            return;
        }
        $meta = self::TABLES[$table];
        $rows = $this->db()
            ->query("SELECT * FROM {$table} ORDER BY id DESC")
            ->fetchAll(\PDO::FETCH_ASSOC);

        $this->sendXls($table, $meta['title'], $meta['labels'], $meta['cols'], $rows);
    }

    /** Genera un Excel (SpreadsheetML) con header de color, sin librerías. */
    private function sendXls(string $table, string $title, array $labels, array $cols, array $rows): void
    {
        $file = $table . '_' . date('Y-m-d') . '.xls';
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Cache-Control: max-age=0');

        $esc = static fn($v) => htmlspecialchars((string) $v, ENT_QUOTES | ENT_XML1, 'UTF-8');

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<?mso-application progid="Excel.Sheet"?>' . "\n";
        echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">';
        echo '<Styles>';
        echo '<Style ss:ID="hdr"><Font ss:Bold="1" ss:Color="#FFFFFF" ss:Size="11"/>'
            . '<Interior ss:Color="#09A4C2" ss:Pattern="Solid"/>'
            . '<Alignment ss:Vertical="Center" ss:Horizontal="Left"/>'
            . '<Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#0B8CA5"/></Borders></Style>';
        echo '<Style ss:ID="cell"><Borders><Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#E3ECF0"/></Borders></Style>';
        echo '</Styles>';
        echo '<Worksheet ss:Name="' . $esc(mb_substr($title, 0, 28)) . '"><Table>';

        // Anchos de columna
        foreach ($labels as $_) {
            echo '<Column ss:Width="160"/>';
        }
        // Header
        echo '<Row ss:Height="22">';
        foreach ($labels as $label) {
            echo '<Cell ss:StyleID="hdr"><Data ss:Type="String">' . $esc($label) . '</Data></Cell>';
        }
        echo '</Row>';
        // Filas
        foreach ($rows as $row) {
            echo '<Row>';
            foreach ($cols as $c) {
                echo '<Cell ss:StyleID="cell"><Data ss:Type="String">' . $esc($row[$c] ?? '') . '</Data></Cell>';
            }
            echo '</Row>';
        }
        echo '</Table></Worksheet></Workbook>';
        exit;
    }
}
