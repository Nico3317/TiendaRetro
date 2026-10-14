<?php $tituloPagina = 'Consultas de precio'; $nav = ''; $seccion = 'consultas'; require __DIR__ . '/layout/header.php'; ?>

<h1>Panel de administración</h1>
<?php require __DIR__ . '/partials/admin_menu.php'; ?>

<h2>Consultas de precio (<?= count($consultas) ?>)</h2>

<?php if (empty($consultas)): ?>
    <p>Todavía no hay consultas.</p>
<?php else: ?>
<div class="tabla-wrap">
<table class="tabla">
    <thead>
        <tr><th>Fecha</th><th>Juego</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Mensaje</th></tr>
    </thead>
    <tbody>
    <?php foreach ($consultas as $c): ?>
        <tr>
            <td><?= h($c['fecha']) ?></td>
            <td><?= h($c['titulo']) ?></td>
            <td><?= h($c['nombreInteresado']) ?></td>
            <td><a href="mailto:<?= h($c['eMail']) ?>"><?= h($c['eMail']) ?></a></td>
            <td><?= h($c['numTel'] ?? '-') ?></td>
            <td><?= nl2br(h($c['msg'])) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endif; ?>

<?php require __DIR__ . '/layout/footer.php'; ?>
