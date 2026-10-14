<?php
class Juego {
    private $idJuego;
    private $titulo;
    private $precio;
    private $replica;
    private $idConsola;
    private $imagen;
    private $agotado;

    public function __construct($idJuego, $titulo, $precio, $replica, $idConsola, $imagen = null, $agotado = false) {
        $this->idJuego = $idJuego;
        $this->titulo = $titulo;
        $this->precio = $precio;
        $this->replica = $replica;
        $this->idConsola = $idConsola;
        $this->imagen = $imagen;
        $this->agotado = $agotado;
    }

    public function getIdJuego() { return $this->idJuego; }
    public function setIdJuego($idJuego) { $this->idJuego = $idJuego; }

    public function getTitulo() { return $this->titulo; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }

    public function getPrecio() { return $this->precio; }
    public function setPrecio($precio) { $this->precio = $precio; }

    public function getReplica() { return $this->replica; }
    public function setReplica($replica) { $this->replica = $replica; }

    public function getIdConsola() { return $this->idConsola; }
    public function setIdConsola($idConsola) { $this->idConsola = $idConsola; }

    public function getImagen() { return $this->imagen; }
    public function setImagen($imagen) { $this->imagen = $imagen; }

    public function getAgotado() { return $this->agotado; }
    public function setAgotado($agotado) { $this->agotado = $agotado; }
}
