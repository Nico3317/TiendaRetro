<?php $tituloPagina = 'Consolas'; $nav = 'consolas'; require __DIR__ . '/layout/header.php'; ?>

<h1>Consolas</h1>
<p class="subtitulo">Elegí una consola para ver su catálogo.</p>

<?php if (empty($consolas)): ?>
    <p>Todavía no hay consolas cargadas.</p>
<?php endif; ?>

<div class="grilla grilla-consolas">
<?php foreach ($consolas as $c):
    $n = (int)($cantidades[$c->getIdConsola()] ?? 0);
    $marca = preg_replace('/[^a-z0-9]+/', '', mb_strtolower((string)$c->getFabricante()));
?>
    <a class="consola-card marca-<?= h($marca) ?>" href="index.php?c=consola&amp;a=ver&amp;id=<?= (int)$c->getIdConsola() ?>">
        <span class="consola-nombre"><?= h($c->getNombre()) ?></span>
        <span class="consola-fab"><?= h($c->getFabricante() ?: 'Sin fabricante') ?></span>
        <span class="consola-cant"><?= $n ?> <?= $n === 1 ? 'juego' : 'juegos' ?></span>
    </a>
<?php endforeach; ?>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>
