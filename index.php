<?php
session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
session_start();

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');

require_once __DIR__ . '/model/Helpers.php';


$controladores = [
    'pagina'       => 'PaginaController',
    'consola'      => 'ConsolaController',
    'consulta'     => 'ConsultaController',
    'contacto'     => 'ContactoController',
    'auth'         => 'AuthController',
    'admin'        => 'AdminController',
    'adminjuego'   => 'AdminJuegoController',
    'adminconsola' => 'AdminConsolaController'
];

$c = $_GET['c'] ?? 'pagina';
$id = $_GET['id'] ?? null;

$a = $_GET['a'] ?? ($c === 'pagina' ? 'inicio' : 'index');

if (!is_string($c) || !is_string($a) || !isset($controladores[$c])) {
    noEncontrado();
}

$clase = $controladores[$c];
require_once __DIR__ . "/controller/$clase.php";
$controlador = new $clase();

if ($a === '' || $a[0] === '_' || !is_callable([$controlador, $a])) {
    noEncontrado();
}

is_string($id) ? $controlador->$a($id) : $controlador->$a();
