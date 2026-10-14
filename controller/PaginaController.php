<?php
require_once __DIR__ . '/../model/JuegoDAO.php';
require_once __DIR__ . '/../model/ConsolaDAO.php';

// Páginas informativas: inicio y "cómo comprar"
class PaginaController {
    public function inicio() {
        $ultimos = (new JuegoDAO())->obtenerUltimos(4);
        $consolas = (new ConsolaDAO())->obtenerTodas();
        require __DIR__ . '/../view/inicio.php';
    }

    public function nosotros() {
        require __DIR__ . '/../view/nosotros.php';
    }
}
