<?php  ?>
<article class="tarjeta" data-titulo="<?= h(mb_strtolower($j->getTitulo())) ?>" data-tipo="<?= $j->getReplica() ? 'replica' : 'original' ?>">
    <div class="tarjeta-img">
        <?php if ($j->getAgotado()): ?>
            <span class="etiqueta etiqueta-agotado">Agotado</span>
        <?php endif; ?>
        <img src="img/juegos/<?= h(basename($j->getImagen() ?: 'sin-imagen.png')) ?>"
             alt="<?= h($j->getTitulo()) ?>" width="400" height="400" loading="lazy">
    </div>
    <div class="tarjeta-cuerpo">
        <h3><?= h($j->getTitulo()) ?></h3>
        <p><span class="etiqueta <?= $j->getReplica() ? 'etiqueta-replica' : 'etiqueta-original' ?>"><?= $j->getReplica() ? 'Réplica' : 'Original' ?></span></p>
        <?php if ($j->getPrecio() !== null): ?>
            <p class="precio">$<?= number_format($j->getPrecio(), 2, ',', '.') ?></p>
        <?php else: ?>
            <a class="boton boton-chico" href="index.php?c=consulta&amp;a=formulario&amp;id=<?= (int)$j->getIdJuego() ?>">Consultar precio</a>
        <?php endif; ?>
    </div>
</article>
