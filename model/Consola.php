<?php
    class Consola{
            private $idConsola;
            private $nombre;
            private $fabricante;

            public function __construct($idConsola,$nombre,$fabricante){
                    $this->idConsola = $idConsola;
                    $this->nombre = $nombre;
                    $this->fabricante = $fabricante;
            }

            public function getIdConsola(){
                return $this->idConsola;
            }
            public function setIdConsola($idConsola){
                $this->idConsola = $idConsola;
            }

            public function getNombre(){
                return $this->nombre;
            }
            public function setNombre($nombre){
                $this->nombre = $nombre;
            }

            public function getFabricante(){
                return $this->fabricante;
            }
            public function setFabricante($fabricante){
                $this->fabricante = $fabricante;
            }
    }

?>