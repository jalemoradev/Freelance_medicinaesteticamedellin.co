-- Esquema MEM — soporte completo de tildes, ñ y caracteres especiales (utf8mb4).
-- Convención: nombres de tabla y columnas en inglés.

CREATE TABLE IF NOT EXISTS consultation_bookings (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(120) NOT NULL,
    email      VARCHAR(180) NOT NULL,
    phone      VARCHAR(40)  NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de agendamiento de valoración (Infra4Fit). Nombres en inglés. utf8mb4.
CREATE TABLE IF NOT EXISTS assessment_bookings (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(120) NOT NULL,
    email        VARCHAR(180) NOT NULL,
    phone        VARCHAR(40)  NOT NULL,
    neighborhood VARCHAR(120) NOT NULL,
    created_at   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuarios del panel admin. Nombres en inglés. Contraseña HASHEADA (password_hash).
CREATE TABLE IF NOT EXISTS users (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(120) NOT NULL,
    username   VARCHAR(60)  NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
