<?php
require_once __DIR__ . '/Conexion.php';

// Mensajes del formulario de contacto general (no ligados a un juego)
class MensajeDAO {
    public function insertar($nombre, $email, $telefono, $motivo, $consolas, $preferencia, $mensaje) {
        $stmt = Conexion::getConexion()->prepare(
            "INSERT INTO mensajes_contacto (nombre, email, telefono, motivo, consolasInteres, preferencia, mensaje)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $nombre, $email,
            $telefono !== '' ? $telefono : null,
            $motivo,
            $consolas !== '' ? $consolas : null,
            $preferencia, $mensaje
        ]);
    }

    public function obtenerTodos() {
        return Conexion::getConexion()
            ->query("SELECT * FROM mensajes_contacto ORDER BY fecha DESC")
            ->fetchAll();
    }
}
