<?php
require_once __DIR__ . '/../model/ConsolaDAO.php';
require_once __DIR__ . '/../model/JuegoDAO.php';

class ConsolaController {
    private $consolaDAO;
    private $juegoDAO;

    public function __construct() {
        $this->consolaDAO = new ConsolaDAO();
        $this->juegoDAO = new JuegoDAO();
    }

    // Lista todas las consolas
    public function index() {
        $consolas = $this->consolaDAO->obtenerTodas();
        $cantidades = $this->consolaDAO->cantidadesDeJuegos();
        require __DIR__ . '/../view/consolas.php';
    }

    // Muestra una consola y sus juegos
    public function ver($id = null) {
        $consola = $this->consolaDAO->obtenerPorId((int)$id);
        if ($consola === null) noEncontrado();

        $juegos = $this->juegoDAO->obtenerPorConsola($consola->getIdConsola());
        require __DIR__ . '/../view/consola_ver.php';
    }
}
