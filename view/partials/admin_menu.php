<?php ?>
<nav class="admin-menu" aria-label="Administración">
    <a href="index.php?c=admin"<?= ($seccion ?? '') === 'consultas' ? ' aria-current="page"' : '' ?>>Consultas</a>
    <a href="index.php?c=admin&amp;a=mensajes"<?= ($seccion ?? '') === 'mensajes' ? ' aria-current="page"' : '' ?>>Mensajes</a>
    <a href="index.php?c=adminjuego"<?= ($seccion ?? '') === 'juegos' ? ' aria-current="page"' : '' ?>>Juegos</a>
    <a href="index.php?c=adminconsola"<?= ($seccion ?? '') === 'consolas' ? ' aria-current="page"' : '' ?>>Consolas</a>
    <form method="post" action="index.php?c=auth&amp;a=logout">
        <input type="hidden" name="csrf" value="<?= h(Sesion::token()) ?>">
        <button type="submit" class="boton boton-chico boton-secundario">Cerrar sesión (<?= h($_SESSION['usuario'] ?? '') ?>)</button>
    </form>
</nav>
<?php if (!empty($flash)): ?>
    <p class="flash <?= $flash['tipo'] === 'error' ? 'flash-error' : 'flash-ok' ?>" role="status"><?= h($flash['msg']) ?></p>
<?php endif; ?>
