<?php $tituloPagina = 'Cómo comprar'; $nav = 'nosotros'; require __DIR__ . '/layout/header.php'; ?>

<h1>Cómo comprar</h1>
<p class="subtitulo">Todo lo que tenés que saber antes de consultar un juego.</p>

<section aria-labelledby="tQuienes">
    <h2 id="tQuienes">Quiénes somos</h2>
    <p>
        Retro Games es un catálogo de juegos de consolas clásicas para jugadores y coleccionistas.
        Cada juego se muestra con su foto, la consola a la que pertenece y si es original o réplica.
    </p>
</section>

<section aria-labelledby="tPasos">
    <h2 id="tPasos">Paso a paso</h2>
    <ol class="pasos">
        <li><strong>Explorá el catálogo</strong> por consola. Podés buscar por título y filtrar entre originales y réplicas.</li>
        <li><strong>Consultá el precio</strong> del juego que te interese. Los precios se informan por consulta porque pueden variar según el estado y la disponibilidad.</li>
        <li><strong>Te contactamos</strong> por email, llamada o WhatsApp, como prefieras, y acordamos precio, forma de pago y entrega.</li>
    </ol>
</section>

<section aria-labelledby="tFaq">
    <h2 id="tFaq">Preguntas frecuentes</h2>
    <details>
        <summary>¿Qué diferencia hay entre original y réplica?</summary>
        <p>Un juego <strong>original</strong> es el cartucho o disco fabricado en su época por la compañía. Una <strong>réplica</strong> (o reproducción) es una copia moderna que funciona en la consola original. En cada juego del catálogo indicamos claramente cuál es.</p>
    </details>
    <details>
        <summary>¿Por qué algunos juegos no muestran el precio?</summary>
        <p>En esos casos el precio se consulta con el botón <em>Consultar precio</em>. Completás el formulario y te respondemos con el valor actualizado.</p>
    </details>
    <details>
        <summary>¿Qué significa «Agotado»?</summary>
        <p>Que ese juego se vendió. Igual podés consultarnos por si vuelve a ingresar, o buscar una alternativa en la misma consola.</p>
    </details>
    <details>
        <summary>¿Busco un juego que no veo en el catálogo?</summary>
        <p>Escribinos desde la página de <a href="index.php?c=contacto&amp;a=formulario">contacto</a> eligiendo el motivo «Busco un juego que no está en el catálogo».</p>
    </details>
</section>

<p class="centrado"><a class="boton" href="index.php?c=consola&amp;a=index">Ver el catálogo</a></p>

<?php require __DIR__ . '/layout/footer.php'; ?>
