// Comportamientos comunes a todo el sitio
(function () {
    // Menú desplegable en celulares
    var boton = document.querySelector('.menu-boton');
    var menu = document.getElementById('menuPrincipal');
    if (boton && menu) {
        boton.addEventListener('click', function () {
            var abierto = menu.classList.toggle('abierto');
            boton.setAttribute('aria-expanded', abierto ? 'true' : 'false');
        });
    }

    // Pide confirmación antes de enviar formularios marcados con data-confirm (borrados)
    document.querySelectorAll('form[data-confirm]').forEach(function (f) {
        f.addEventListener('submit', function (e) {
            if (!window.confirm(f.getAttribute('data-confirm'))) e.preventDefault();
        });
    });
})();
