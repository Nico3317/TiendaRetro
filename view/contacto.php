<?php
$tituloPagina = 'Contacto';
$nav = 'contacto';
$scripts = ['js-scripts/validar.js', 'js-scripts/contacto.js'];
require __DIR__ . '/layout/header.php';
?>

<h1>Contacto</h1>
<p class="subtitulo">Escribinos y te respondemos a la brevedad. Los campos con * son obligatorios.</p>

<form id="formContacto" class="formulario" method="post" action="index.php?c=contacto&amp;a=enviar" novalidate>
    <div class="trampa" aria-hidden="true">
        <label>No completar este campo <input type="text" name="sitio_web" tabindex="-1" autocomplete="off"></label>
    </div>

    <label for="nombre">Nombre y apellido *</label>
    <input type="text" id="nombre" name="nombre" maxlength="100" value="<?= h($datos['nombre']) ?>">
    <span class="error" data-for="nombre"><?= h($errores['nombre'] ?? '') ?></span>

    <label for="email">Email *</label>
    <input type="email" id="email" name="email" maxlength="100" value="<?= h($datos['email']) ?>">
    <span class="error" data-for="email"><?= h($errores['email'] ?? '') ?></span>

    <label for="telefono">Teléfono</label>
    <input type="tel" id="telefono" name="telefono" maxlength="20" value="<?= h($datos['telefono']) ?>">
    <span class="error" data-for="telefono"><?= h($errores['telefono'] ?? '') ?></span>

    <label for="motivo">Motivo de la consulta *</label>
    <select id="motivo" name="motivo">
        <option value="">-- Elegí una opción --</option>
        <?php foreach (ContactoController::MOTIVOS as $v => $t): ?>
            <option value="<?= h($v) ?>" <?= $datos['motivo'] === $v ? 'selected' : '' ?>><?= h($t) ?></option>
        <?php endforeach; ?>
    </select>
    <span class="error" data-for="motivo"><?= h($errores['motivo'] ?? '') ?></span>

    <fieldset>
        <legend>Consolas que te interesan (opcional)</legend>
        <?php foreach ($consolas as $c): ?>
            <label class="inline">
                <input type="checkbox" name="consolas[]" value="<?= (int)$c->getIdConsola() ?>"
                    <?= in_array((int)$c->getIdConsola(), $datos['consolas'], true) ? 'checked' : '' ?>>
                <?= h($c->getNombre()) ?>
            </label>
        <?php endforeach; ?>
        <span class="error" data-for="consolas"><?= h($errores['consolas'] ?? '') ?></span>
    </fieldset>

    <fieldset>
        <legend>¿Cómo preferís que te contactemos? *</legend>
        <?php foreach (ContactoController::PREFERENCIAS as $v => $t): ?>
            <label class="inline">
                <input type="radio" name="preferencia" value="<?= h($v) ?>" <?= $datos['preferencia'] === $v ? 'checked' : '' ?>> <?= h($t) ?>
            </label>
        <?php endforeach; ?>
        <span class="error" data-for="preferencia"><?= h($errores['preferencia'] ?? '') ?></span>
    </fieldset>

    <label for="mensaje">Mensaje *</label>
    <textarea id="mensaje" name="mensaje" rows="6" maxlength="1000"><?= h($datos['mensaje']) ?></textarea>
    <small><span id="contador">0</span>/1000</small>
    <span class="error" data-for="mensaje"><?= h($errores['mensaje'] ?? '') ?></span>

    <label class="inline">
        <input type="checkbox" name="acepta" id="acepta" <?= $datos['acepta'] ? 'checked' : '' ?>>
        Acepto que me contacten por este mensaje *
    </label>
    <span class="error" data-for="acepta"><?= h($errores['acepta'] ?? '') ?></span>

    <div class="botones">
        <button type="submit" class="boton">Enviar mensaje</button>
        <button type="reset" class="boton boton-secundario">Limpiar</button>
    </div>
</form>

<?php require __DIR__ . '/layout/footer.php'; ?>
