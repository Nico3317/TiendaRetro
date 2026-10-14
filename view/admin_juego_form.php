<?php
$tituloPagina = $juego ? 'Editar juego' : 'Nuevo juego';
$nav = '';
$seccion = 'juegos';
require __DIR__ . '/layout/header.php';
?>

<h1>Panel de administración</h1>
<?php require __DIR__ . '/partials/admin_menu.php'; ?>

<h2><?= $juego ? 'Editar juego' : 'Nuevo juego' ?></h2>

<form class="formulario" method="post" action="index.php?c=adminjuego&amp;a=guardar" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?= h(Sesion::token()) ?>">
    <input type="hidden" name="idJuego" value="<?= $juego ? (int)$juego->getIdJuego() : 0 ?>">

    <label for="titulo">Título *</label>
    <input type="text" id="titulo" name="titulo" maxlength="255" value="<?= h($datos['titulo']) ?>" required>
    <span class="error"><?= h($errores['titulo'] ?? '') ?></span>

    <label for="idConsola">Consola *</label>
    <select id="idConsola" name="idConsola" required>
        <option value="">-- Elegí una --</option>
        <?php foreach ($consolas as $c): ?>
            <option value="<?= (int)$c->getIdConsola() ?>" <?= (string)$datos['idConsola'] === (string)$c->getIdConsola() ? 'selected' : '' ?>>
                <?= h($c->getNombre()) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <span class="error"><?= h($errores['idConsola'] ?? '') ?></span>

    <label for="precio">Precio (vacío = «Consultar precio»)</label>
    <input type="number" id="precio" name="precio" step="0.01" min="0" value="<?= h($datos['precio']) ?>">
    <span class="error"><?= h($errores['precio'] ?? '') ?></span>

    <fieldset>
        <legend>Tipo</legend>
        <label class="inline"><input type="radio" name="replica" value="0" <?= $datos['replica'] === '0' ? 'checked' : '' ?>> Original</label>
        <label class="inline"><input type="radio" name="replica" value="1" <?= $datos['replica'] === '1' ? 'checked' : '' ?>> Réplica</label>
    </fieldset>

    <label class="inline">
        <input type="checkbox" name="agotado" <?= $datos['agotado'] ? 'checked' : '' ?>> Agotado
    </label>

    <label for="imagen">Imagen (JPG, PNG o WEBP, hasta 5 MB; se reduce automáticamente a 900 px)</label>
    <?php if ($juego && $juego->getImagen()): ?>
        <img src="img/juegos/<?= h(basename($juego->getImagen())) ?>" alt="Imagen actual" width="120" class="mini">
        <small>Si subís otra, reemplaza a esta.</small>
    <?php endif; ?>
    <input type="file" id="imagen" name="imagen" accept="image/jpeg,image/png,image/webp">
    <span class="error"><?= h($errores['imagen'] ?? '') ?></span>

    <div class="botones">
        <button type="submit" class="boton">Guardar</button>
        <a class="boton boton-secundario" href="index.php?c=adminjuego">Cancelar</a>
    </div>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>
