// Validación del formulario de contacto general
(function () {
    var form = document.getElementById('formContacto');
    if (!form) return;

    Validar.contador(document.getElementById('mensaje'), document.getElementById('contador'));

    form.addEventListener('submit', function (e) {
        var f = form.elements;
        var primero = null;
        var err = function (campo, texto, elemento) {
            Validar.mostrarError(campo, texto);
            if (!primero) primero = elemento;
        };

        Validar.limpiar(['nombre', 'email', 'telefono', 'motivo', 'preferencia', 'mensaje', 'acepta']);

        if (f.nombre.value.trim().length < 2) err('nombre', 'Ingresá tu nombre (mínimo 2 caracteres).', f.nombre);
        if (!Validar.email(f.email.value.trim())) err('email', 'Ingresá un email válido.', f.email);

        var tel = f.telefono.value.trim();
        if (tel !== '' && !Validar.telefono(tel)) err('telefono', 'Solo números, +, - y espacios (6 a 20).', f.telefono);
        else if (f.preferencia.value !== 'email' && tel === '') err('telefono', 'Cargá un teléfono para contactarte por esa vía.', f.telefono);

        if (f.motivo.value === '') err('motivo', 'Elegí el motivo de tu consulta.', f.motivo);

        var lm = f.mensaje.value.trim().length;
        if (lm < 10 || lm > 1000) err('mensaje', 'El mensaje debe tener entre 10 y 1000 caracteres.', f.mensaje);
        if (!f.acepta.checked) err('acepta', 'Tenés que aceptar que te contactemos.', f.acepta);

        if (primero) { e.preventDefault(); primero.focus(); }
    });

    // Al limpiar el formulario también se limpian los errores y el contador
    form.addEventListener('reset', function () {
        Validar.limpiar(['nombre', 'email', 'telefono', 'motivo', 'consolas', 'preferencia', 'mensaje', 'acepta']);
        setTimeout(function () { document.getElementById('contador').textContent = '0'; }, 0);
    });
})();
