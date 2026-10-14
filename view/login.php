<?php $tituloPagina = 'Acceso administrador'; $nav = ''; require __DIR__ . '/layout/header.php'; ?>

<h1>Acceso administrador</h1>
<p class="subtitulo">Solo para el dueño del sitio.</p>

<form class="formulario" method="post" action="index.php?c=auth&amp;a=autenticar">
    <input type="hidden" name="csrf" value="<?= h(Sesion::token()) ?>">

    <?php if (!empty($flash)): ?>
        <p class="flash flash-error" role="alert"><?= h($flash['msg']) ?></p>
    <?php endif; ?>

    <label for="usuario">Usuario</label>
    <input type="text" id="usuario" name="usuario" maxlength="50" required autofocus autocomplete="username">

    <label for="clave">Contraseña</label>
    <input type="password" id="clave" name="clave" required autocomplete="current-password">

    <button type="submit" class="boton">Ingresar</button>
</form>

<p><a href="index.php">‹ Volver al sitio</a></p>

<?php require __DIR__ . '/layout/footer.php'; ?>
