<?php
require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/Consola.php';

class ConsolaDAO {
    public function obtenerTodas() {
        $stmt = Conexion::getConexion()->query("SELECT * FROM consolas ORDER BY nombre");
        $consolas = [];
        foreach ($stmt as $f) {
            $consolas[] = new Consola($f['idConsola'], $f['nombre'], $f['fabricante']);
        }
        return $consolas;
    }

    public function obtenerPorId($id) {
        $stmt = Conexion::getConexion()->prepare("SELECT * FROM consolas WHERE idConsola = ?");
        $stmt->execute([$id]);
        $f = $stmt->fetch();
        return $f ? new Consola($f['idConsola'], $f['nombre'], $f['fabricante']) : null;
    }

    // Devuelve [idConsola => cantidad de juegos]
    public function cantidadesDeJuegos() {
        $stmt = Conexion::getConexion()->query("SELECT idConsola, COUNT(*) FROM juegos GROUP BY idConsola");
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function insertar($nombre, $fabricante) {
        $stmt = Conexion::getConexion()->prepare("INSERT INTO consolas (nombre, fabricante) VALUES (?, ?)");
        return $stmt->execute([$nombre, $fabricante !== '' ? $fabricante : null]);
    }

    public function actualizar($id, $nombre, $fabricante) {
        $stmt = Conexion::getConexion()->prepare("UPDATE consolas SET nombre = ?, fabricante = ? WHERE idConsola = ?");
        return $stmt->execute([$nombre, $fabricante !== '' ? $fabricante : null, $id]);
    }

    public function eliminar($id) {
        $stmt = Conexion::getConexion()->prepare("DELETE FROM consolas WHERE idConsola = ?");
        return $stmt->execute([$id]);
    }
}
