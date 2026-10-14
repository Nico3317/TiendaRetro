<?php $tituloPagina = 'Mensajes de contacto'; $nav = ''; $seccion = 'mensajes'; require __DIR__ . '/layout/header.php'; ?>

<h1>Panel de administración</h1>
<?php require __DIR__ . '/partials/admin_menu.php'; ?>

<h2>Mensajes de contacto (<?= count($mensajes) ?>)</h2>

<?php if (empty($mensajes)): ?>
    <p>Todavía no hay mensajes.</p>
<?php else: ?>
<div class="tabla-wrap">
<table class="tabla">
    <thead>
        <tr><th>Fecha</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Motivo</th><th>Consolas</th><th>Prefiere</th><th>Mensaje</th></tr>
    </thead>
    <tbody>
    <?php foreach ($mensajes as $m): ?>
        <tr>
            <td><?= h($m['fecha']) ?></td>
            <td><?= h($m['nombre']) ?></td>
            <td><a href="mailto:<?= h($m['email']) ?>"><?= h($m['email']) ?></a></td>
            <td><?= h($m['telefono'] ?? '-') ?></td>
            <td><?= h($m['motivo']) ?></td>
            <td><?= h($m['consolasInteres'] ?? '-') ?></td>
            <td><?= h($m['preferencia']) ?></td>
            <td><?= nl2br(h($m['mensaje'])) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endif; ?>

<?php require __DIR__ . '/layout/footer.php'; ?>
