<?php $tituloPagina = 'Inicio'; $nav = 'inicio'; require __DIR__ . '/layout/header.php'; ?>

<section class="hero">
    <p class="hero-chico parpadeo">PRESS START</p>
    <h1>Bienvenido al catálogo de juegos retro</h1>
    <p class="hero-texto">
        Cartuchos y discos de las consolas clásicas: Nintendo, Sega, Sony y más.
        Explorá el catálogo por consola y consultanos el precio del juego que te interesa.
    </p>
    <p class="hero-botones">
        <a class="boton" href="index.php?c=consola&amp;a=index">Ver consolas</a>
        <a class="boton boton-secundario" href="index.php?c=pagina&amp;a=nosotros">Cómo comprar</a>
    </p>
</section>

<?php if ($consolas): ?>
<section aria-labelledby="tConsolas">
    <h2 id="tConsolas">Elegí tu consola</h2>
    <ul class="chips">
        <?php foreach ($consolas as $c): ?>
            <li><a href="index.php?c=consola&amp;a=ver&amp;id=<?= (int)$c->getIdConsola() ?>"><?= h($c->getNombre()) ?></a></li>
        <?php endforeach; ?>
    </ul>
</section>
<?php endif; ?>

<?php if ($ultimos): ?>
<section aria-labelledby="tUltimos">
    <h2 id="tUltimos">Últimos ingresos</h2>
    <div class="grilla">
        <?php foreach ($ultimos as $j) require __DIR__ . '/partials/tarjeta_juego.php'; ?>
    </div>
</section>
<?php endif; ?>

<section aria-labelledby="tPasos">
    <h2 id="tPasos">¿Cómo funciona?</h2>
    <ol class="pasos">
        <li><strong>Elegí</strong> una consola y mirá los juegos disponibles.</li>
        <li><strong>Consultá</strong> el precio del que te interese con el formulario.</li>
        <li><strong>Te respondemos</strong> por el medio que prefieras y coordinamos la compra.</li>
    </ol>
</section>

<?php require __DIR__ . '/layout/footer.php'; ?>
