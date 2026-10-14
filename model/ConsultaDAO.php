<?php
require_once __DIR__ . '/Conexion.php';

class ConsultaDAO {
    public function insertar($nombre, $email, $tel, $msg, $idJuego) {
        $stmt = Conexion::getConexion()->prepare(
            "INSERT INTO contactos (nombreInteresado, eMail, numTel, msg, idJuego)
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$nombre, $email, $tel !== '' ? $tel : null, $msg, $idJuego]);
    }

    public function obtenerTodas() {
        $stmt = Conexion::getConexion()->query(
            "SELECT c.*, j.titulo
             FROM contactos c
             JOIN juegos j ON j.idJuego = c.idJuego
             ORDER BY c.fecha DESC"
        );
        return $stmt->fetchAll();
    }
}
