<?php $tituloPagina = 'Administrar consolas'; $nav = ''; $seccion = 'consolas'; require __DIR__ . '/layout/header.php'; ?>

<h1>Panel de administración</h1>
<?php require __DIR__ . '/partials/admin_menu.php'; ?>

<h2>Consolas (<?= count($consolas) ?>)</h2>
<p><a class="boton boton-chico" href="index.php?c=adminconsola&amp;a=nueva">+ Nueva consola</a></p>

<?php if (empty($consolas)): ?>
    <p>Todavía no hay consolas cargadas.</p>
<?php else: ?>
<div class="tabla-wrap">
<table class="tabla">
    <thead><tr><th>Nombre</th><th>Fabricante</th><th>Juegos</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach ($consolas as $c): ?>
        <tr>
            <td><?= h($c->getNombre()) ?></td>
            <td><?= h($c->getFabricante() ?? '') ?></td>
            <td><?= (int)($cantidades[$c->getIdConsola()] ?? 0) ?></td>
            <td class="acciones">
                <a href="index.php?c=adminconsola&amp;a=editar&amp;id=<?= (int)$c->getIdConsola() ?>">Editar</a>
                <form method="post" action="index.php?c=adminconsola&amp;a=eliminar" data-confirm="¿Eliminar esta consola?">
                    <input type="hidden" name="csrf" value="<?= h(Sesion::token()) ?>">
                    <input type="hidden" name="idConsola" value="<?= (int)$c->getIdConsola() ?>">
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
