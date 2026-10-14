<?php
require_once __DIR__ . '/../model/Sesion.php';
require_once __DIR__ . '/../model/ConsultaDAO.php';
require_once __DIR__ . '/../model/MensajeDAO.php';

// Panel del dueño: consultas de precio y mensajes recibidos
class AdminController {
    public function __construct() {
        // Guardia: toda acción de este controlador exige estar logueado
        Sesion::requerirLogin();
    }

    public function index() {
        $consultas = (new ConsultaDAO())->obtenerTodas();
        $flash = Sesion::tomarFlash();
        require __DIR__ . '/../view/admin_index.php';
    }

    public function mensajes() {
        $mensajes = (new MensajeDAO())->obtenerTodos();
        $flash = Sesion::tomarFlash();
        require __DIR__ . '/../view/admin_mensajes.php';
    }
}
