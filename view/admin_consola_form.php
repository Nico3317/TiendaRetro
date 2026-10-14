<?php
$tituloPagina = $consola ? 'Editar consola' : 'Nueva consola';
$nav = '';
$seccion = 'consolas';
require __DIR__ . '/layout/header.php';
?>

<h1>Panel de administración</h1>
<?php require __DIR__ . '/partials/admin_menu.php'; ?>

<h2><?= $consola ? 'Editar consola' : 'Nueva consola' ?></h2>

<form class="formulario" method="post" action="index.php?c=adminconsola&amp;a=guardar">
    <input type="hidden" name="csrf" value="<?= h(Sesion::token()) ?>">
    <input type="hidden" name="idConsola" value="<?= $consola ? (int)$consola->getIdConsola() : 0 ?>">

    <label for="nombre">Nombre *</label>
    <input type="text" id="nombre" name="nombre" maxlength="55" value="<?= h($datos['nombre']) ?>" required>
    <span class="error"><?= h($errores['nombre'] ?? '') ?></span>

    <label for="fabricante">Fabricante</label>
    <input type="text" id="fabricante" name="fabricante" maxlength="55" value="<?= h($datos['fabricante']) ?>">
    <span class="error"><?= h($errores['fabricante'] ?? '') ?></span>

    <div class="botones">
        <button type="submit" class="boton">Guardar</button>
        <a class="boton boton-secundario" href="index.php?c=adminconsola">Cancelar</a>
    </div>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>
