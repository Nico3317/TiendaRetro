</main>

<footer class="site-footer">
    <div class="contenedor footer-fila">
        <p>© <?= date('Y') ?> Retro Games · Catálogo de juegos retro</p>
        <p>
            <?php if (isset($_SESSION['idUsuario'])): ?>
                <a href="index.php?c=admin">Panel de administración</a>
            <?php else: ?>
                <a href="index.php?c=auth&amp;a=login">Acceso administrador</a>
            <?php endif; ?>
        </p>
    </div>
</footer>

<script src="js-scripts/sitio.js"></script>
<?php foreach (($scripts ?? []) as $js): ?>
<script src="<?= h($js) ?>"></script>
<?php endforeach; ?>
</body>
</html>
