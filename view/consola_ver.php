<?php
$tituloPagina = $consola->getNombre();
$nav = 'consolas';
$scripts = ['js-scripts/catalogo.js'];
require __DIR__ . '/layout/header.php';
?>

<p class="migas"><a href="index.php?c=consola&amp;a=index">Consolas</a> › <?= h($consola->getNombre()) ?></p>
<h1><?= h($consola->getNombre()) ?></h1>
<?php if ($consola->getFabricante()): ?>
    <p class="subtitulo"><?= h($consola->getFabricante()) ?></p>
<?php endif; ?>

<?php if (empty($juegos)): ?>
    <p>Todavía no hay juegos cargados para esta consola.</p>
<?php else: ?>
    <div class="filtros" role="search">
        <label for="buscar" class="sr-only">Buscar por título</label>
        <input type="search" id="buscar" placeholder="Buscar por título..." autocomplete="off">
        <label for="filtroTipo" class="sr-only">Tipo</label>
        <select id="filtroTipo">
            <option value="">Originales y réplicas</option>
            <option value="original">Solo originales</option>
            <option value="replica">Solo réplicas</option>
        </select>
        <span class="filtros-cuenta" aria-live="polite">
            <span id="cuenta"><?= count($juegos) ?></span> de <?= count($juegos) ?> juegos
        </span>
    </div>

    <p id="sinResultados" class="aviso" hidden>No hay juegos que coincidan con la búsqueda.</p>

    <div class="grilla" id="catalogo">
        <?php foreach ($juegos as $j) require __DIR__ . '/partials/tarjeta_juego.php'; ?>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/layout/footer.php'; ?>
