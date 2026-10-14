-- ============================================================
--  Retro Games · instalación desde cero
--  Importar desde phpMyAdmin (pestaña "Importar") o con:
--      mysql -u root -p < retro_games.sql
--  ATENCIÓN: borra y vuelve a crear la base "retro_games".
-- ============================================================
DROP DATABASE IF EXISTS retro_games;
CREATE DATABASE retro_games CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE retro_games;

CREATE TABLE consolas (
    idConsola INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(55) NOT NULL,
    fabricante VARCHAR(55)
);

CREATE TABLE juegos (
    idJuego INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    precio FLOAT,
    replica BOOL,
    idConsola INT,
    imagen VARCHAR(255) NULL,
    agotado BOOL NOT NULL DEFAULT 0,
    FOREIGN KEY (idConsola) REFERENCES consolas(idConsola)
);

CREATE TABLE contactos (
    idConsulta INT AUTO_INCREMENT PRIMARY KEY,
    nombreInteresado VARCHAR(100) NOT NULL,
    eMail VARCHAR(100) NOT NULL,
    numTel VARCHAR(50),
    msg TEXT NOT NULL,
    idJuego INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idJuego) REFERENCES juegos(idJuego)
);

CREATE TABLE mensajes_contacto (
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

CREATE TABLE usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    passwordHash VARCHAR(255) NOT NULL
);

-- Datos de ejemplo (borrarlos o reemplazarlos por los reales)
INSERT INTO consolas (nombre, fabricante) VALUES
('NES', 'Nintendo'),
('Super Nintendo', 'Nintendo'),
('Genesis', 'SEGA'),
('Game Boy', 'Nintendo'),
('PlayStation 1', 'Sony');

INSERT INTO juegos (titulo, precio, replica, idConsola, imagen, agotado) VALUES
('Castlevania III: Dracula''s Curse', NULL, 0, 1, 'castlevania3.jpg', 0),
('Super Metroid', 25000, 0, 2, 'superMetroid.jpg', 0),
('Sonic the Hedgehog', 12000, 0, 3, 'sonic1.jpg', 0),
('Earthworm Jim', NULL, 1, 3, 'earthwormjimSega.jpg', 1),
('Wario Land II', NULL, 0, 4, 'warioland2.jpg', 0);

-- El usuario administrador se crea desde el navegador con crear_admin.php
