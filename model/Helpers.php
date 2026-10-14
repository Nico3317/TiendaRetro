<?php
// Escapa texto antes de mostrarlo en HTML (protege contra XSS)
function h($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

// Muestra la página 404 y corta la ejecución
function noEncontrado() {
    http_response_code(404);
    $tituloPagina = 'No encontrado';
    $nav = '';
    require __DIR__ . '/../view/404.php';
    exit;
}

function redirigir($url) {
    header('Location: ' . $url);
    exit;
}
