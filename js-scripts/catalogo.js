// Buscador y filtro del catálogo (se aplica en el navegador, sin recargar la página)
(function () {
    var buscar = document.getElementById('buscar');
    var tipo = document.getElementById('filtroTipo');
    var cuenta = document.getElementById('cuenta');
    var vacio = document.getElementById('sinResultados');
    var tarjetas = document.querySelectorAll('#catalogo .tarjeta');
    if (!buscar || !tipo || !tarjetas.length) return;

    function filtrar() {
        var texto = buscar.value.trim().toLowerCase();
        var tipoElegido = tipo.value;
        var visibles = 0;

        tarjetas.forEach(function (t) {
            var coincide = t.dataset.titulo.indexOf(texto) !== -1 &&
                           (tipoElegido === '' || t.dataset.tipo === tipoElegido);
            t.hidden = !coincide;
            if (coincide) visibles++;
        });

        cuenta.textContent = visibles;
        vacio.hidden = visibles !== 0;
    }

    buscar.addEventListener('input', filtrar);
    tipo.addEventListener('change', filtrar);
})();
