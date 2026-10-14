<?php
require_once __DIR__ . '/Conexion.php';

class UsuarioDAO {
    public function buscarPorUsuario($usuario) {
        $stmt = Conexion::getConexion()->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        return $stmt->fetch() ?: null;
    }
}