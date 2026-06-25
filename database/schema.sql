-- Esquema MEM — soporte completo de tildes, ñ y caracteres especiales (utf8mb4).
-- Convención: nombres de tabla y columnas en inglés.

CREATE TABLE IF NOT EXISTS consultation_bookings (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(120) NOT NULL,
    email      VARCHAR(180) NOT NULL,
    phone      VARCHAR(40)  NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
