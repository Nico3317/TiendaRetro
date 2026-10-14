-- ============================================================
--  Migración para quien YA tiene la base "retro_games" armada
--  con las tablas consolas, juegos y contactos.
--  Agrega lo nuevo sin tocar los datos existentes.
--  Pensado para MariaDB (XAMPP). Se puede ejecutar más de una vez.
-- ============================================================
USE retro_games;

-- La columna de imagen (por si todavía no existe)
ALTER TABLE juegos ADD COLUMN IF NOT EXISTS imagen VARCHAR(255) NULL;

-- Marca de "Agotado" para los juegos
ALTER TABLE juegos ADD COLUMN IF NOT EXISTS agotado BOOL NOT NULL DEFAULT 0;

-- Mensajes del formulario de contacto general
CREATE TABLE IF NOT EXISTS mensajes_contacto (
    idMensaje INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(50) NULL,
    motivo VARCHAR(80) NOT NULL,
    consolasInteres VARCHAR(255) NULL,
    preferencia VARCHAR(20) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Usuarios del panel de administración
CREATE TABLE IF NOT EXISTS usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    passwordHash VARCHAR(255) NOT NULL
);
