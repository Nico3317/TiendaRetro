<?php $tituloPagina = 'Administrar juegos'; $nav = ''; $seccion = 'juegos'; require __DIR__ . '/layout/header.php'; ?>

<h1>Panel de administración</h1>
<?php require __DIR__ . '/partials/admin_menu.php'; ?>

<h2>Juegos (<?= count($juegos) ?>)</h2>
<p><a class="boton boton-chico" href="index.php?c=adminjuego&amp;a=nuevo">+ Nuevo juego</a></p>

<?php if (empty($juegos)): ?>
    <p>Todavía no hay juegos cargados.</p>
<?php else: ?>
<div class="tabla-wrap">
<table class="tabla">
    <thead><tr><th>Imagen</th><th>Título</th><th>Consola</th><th>Tipo</th><th>Precio</th><th>Estado</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach ($juegos as $j): ?>
        <tr>
            <td>
                <?php if ($j['imagen']): ?>
                    <img src="img/juegos/<?= h(basename($j['imagen'])) ?>" alt="" width="50" height="50" class="mini">
                <?php endif; ?>
            </td>
            <td><?= h($j['titulo']) ?></td>
            <td><?= h($j['consola']) ?></td>
            <td><?= $j['replica'] ? 'Réplica' : 'Original' ?></td>
            <td><?= $j['precio'] !== null ? '$' . number_format($j['precio'], 2, ',', '.') : 'Consultar' ?></td>
            <td><?= !empty($j['agotado']) ? 'Agotado' : 'Disponible' ?></td>
            <td class="acciones">
                <a href="index.php?c=adminjuego&amp;a=editar&amp;id=<?= (int)$j['idJuego'] ?>">Editar</a>
                <form method="post" action="index.php?c=adminjuego&amp;a=eliminar" data-confirm="¿Eliminar este juego?">
                    <input type="hidden" name="csrf" value="<?= h(Sesion::token()) ?>">
                    <input type="hidden" name="idJuego" value="<?= (int)$j['idJuego'] ?>">
                    <button type="submit" class="boton boton-chico boton-peligro">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endif; ?>

<?php require __DIR__ . '/layout/footer.php'; ?>
