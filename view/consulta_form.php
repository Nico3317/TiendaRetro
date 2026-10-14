<?php
$tituloPagina = 'Consultar precio';
$nav = 'consolas';
$scripts = ['js-scripts/validar.js', 'js-scripts/consulta.js'];
require __DIR__ . '/layout/header.php';
?>

<h1>Consultar precio</h1>
<p class="subtitulo">Juego: <strong><?= h($juego->getTitulo()) ?></strong></p>

<form id="formConsulta" class="formulario" method="post" action="index.php?c=consulta&amp;a=enviar" novalidate>
    <input type="hidden" name="idJuego" value="<?= (int)$juego->getIdJuego() ?>">
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

    <fieldset>
        <legend>¿Cómo preferís que te contactemos?</legend>
        <?php foreach (['email' => 'Email', 'telefono' => 'Llamada', 'whatsapp' => 'WhatsApp'] as $v => $t): ?>
            <label class="inline">
                <input type="radio" name="contacto" value="<?= h($v) ?>" <?= $datos['contacto'] === $v ? 'checked' : '' ?>> <?= h($t) ?>
            </label>
        <?php endforeach; ?>
        <span class="error" data-for="contacto"><?= h($errores['contacto'] ?? '') ?></span>
    </fieldset>

    <label for="mensaje">Mensaje *</label>
    <textarea id="mensaje" name="mensaje" rows="5" maxlength="1000"><?= h($datos['mensaje']) ?></textarea>
    <small><span id="contador">0</span>/1000</small>
    <span class="error" data-for="mensaje"><?= h($errores['mensaje'] ?? '') ?></span>

    <label class="inline">
        <input type="checkbox" name="acepta" id="acepta" <?= $datos['acepta'] ? 'checked' : '' ?>>
        Acepto que me contacten por mi consulta *
    </label>
    <span class="error" data-for="acepta"><?= h($errores['acepta'] ?? '') ?></span>

    <button type="submit" class="boton">Enviar consulta</button>
</form>

<p><a href="index.php?c=consola&amp;a=ver&amp;id=<?= (int)$juego->getIdConsola() ?>">‹ Volver al catálogo</a></p>

<?php require __DIR__ . '/layout/footer.php'; ?>
