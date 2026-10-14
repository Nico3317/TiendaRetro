<?php
// Variables esperadas: $tituloPagina (string), $nav (string, opcional)
$tituloPagina = $tituloPagina ?? 'Retro Games';
$nav = $nav ?? '';
$enlaces = [
    'inicio'    => ['index.php', 'Inicio'],
    'consolas'  => ['index.php?c=consola&a=index', 'Consolas'],
    'nosotros'  => ['index.php?c=pagina&a=nosotros', 'Cómo comprar'],
    'contacto'  => ['index.php?c=contacto&a=formulario', 'Contacto'],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($tituloPagina) ?> · Retro Games</title>
    <meta name="description" content="Catálogo de juegos retro: NES, Super Nintendo, Mega Drive, Game Boy y más. Consultá el precio de cada juego.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<a class="saltar" href="#contenido">Saltar al contenido</a>

<header class="site-header">
    <div class="contenedor header-fila">
        <a class="logo" href="index.php" aria-label="Retro Games, ir al inicio">
            <span class="logo-bloque" aria-hidden="true"></span>RETRO GAMES
        </a>
        <button class="menu-boton" type="button" aria-expanded="false" aria-controls="menuPrincipal">Menú</button>
        <nav id="menuPrincipal" class="menu" aria-label="Principal">
            <?php foreach ($enlaces as $clave => [$url, $texto]): ?>
                <a href="<?= h($url) ?>"<?= $nav === $clave ? ' aria-current="page"' : '' ?>><?= h($texto) ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</header>

<main id="contenido" class="contenedor">
