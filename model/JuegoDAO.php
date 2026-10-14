<?php
require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/Juego.php';

class JuegoDAO {
    private function hidratar($f) {
        return new Juego(
            $f['idJuego'],
            $f['titulo'],
            $f['precio'] !== null ? (float)$f['precio'] : null,
            (bool)$f['replica'],
            $f['idConsola'],
            $f['imagen'] ?? null,
            (bool)($f['agotado'] ?? 0)
        );
    }

    public function obtenerPorConsola($idConsola) {
        $stmt = Conexion::getConexion()->prepare("SELECT * FROM juegos WHERE idConsola = ? ORDER BY titulo");
        $stmt->execute([$idConsola]);
        return array_map([$this, 'hidratar'], $stmt->fetchAll());
    }

    public function obtenerPorId($id) {
        $stmt = Conexion::getConexion()->prepare("SELECT * FROM juegos WHERE idJuego = ?");
        $stmt->execute([$id]);
        $f = $stmt->fetch();
        return $f ? $this->hidratar($f) : null;
    }

    // Los últimos juegos cargados (para la página de inicio)
    public function obtenerUltimos($cantidad) {
        $stmt = Conexion::getConexion()->query("SELECT * FROM juegos ORDER BY idJuego DESC LIMIT " . (int)$cantidad);
        return array_map([$this, 'hidratar'], $stmt->fetchAll());
    }

    // Listado para el panel de administración (incluye el nombre de la consola)
    public function obtenerTodos() {
        $stmt = Conexion::getConexion()->query(
            "SELECT j.*, c.nombre AS consola FROM juegos j
             JOIN consolas c ON c.idConsola = j.idConsola
             ORDER BY c.nombre, j.titulo"
        );
        return $stmt->fetchAll();
    }

    public function insertar($titulo, $precio, $replica, $idConsola, $imagen, $agotado) {
        $stmt = Conexion::getConexion()->prepare(
            "INSERT INTO juegos (titulo, precio, replica, idConsola, imagen, agotado) VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$titulo, $precio, (int)$replica, $idConsola, $imagen, (int)$agotado]);
    }

    public function actualizar($id, $titulo, $precio, $replica, $idConsola, $imagen, $agotado) {
        $stmt = Conexion::getConexion()->prepare(
            "UPDATE juegos SET titulo = ?, precio = ?, replica = ?, idConsola = ?, imagen = ?, agotado = ?
             WHERE idJuego = ?"
        );
        return $stmt->execute([$titulo, $precio, (int)$replica, $idConsola, $imagen, (int)$agotado, $id]);
    }

    public function eliminar($id) {
        $stmt = Conexion::getConexion()->prepare("DELETE FROM juegos WHERE idJuego = ?");
        return $stmt->execute([$id]);
    }
}
