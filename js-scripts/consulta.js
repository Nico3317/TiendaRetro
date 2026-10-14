// Validación del formulario "Consultar precio"
(function () {
    var form = document.getElementById('formConsulta');
    if (!form) return;

    Validar.contador(document.getElementById('mensaje'), document.getElementById('contador'));

    form.addEventListener('submit', function (e) {
        var f = form.elements;
        var primero = null;
        var err = function (campo, texto, elemento) {
            Validar.mostrarError(campo, texto);
            if (!primero) primero = elemento;
        };

        Validar.limpiar(['nombre', 'email', 'telefono', 'contacto', 'mensaje', 'acepta']);

        if (f.nombre.value.trim().length < 2) err('nombre', 'Ingresá tu nombre (mínimo 2 caracteres).', f.nombre);
        if (!Validar.email(f.email.value.trim())) err('email', 'Ingresá un email válido.', f.email);

        var tel = f.telefono.value.trim();
        if (tel !== '' && !Validar.telefono(tel)) err('telefono', 'Solo números, +, - y espacios (6 a 20).', f.telefono);
        else if (f.contacto.value !== 'email' && tel === '') err('telefono', 'Cargá un teléfono para contactarte por esa vía.', f.telefono);

        var lm = f.mensaje.value.trim().length;
        if (lm < 10 || lm > 1000) err('mensaje', 'El mensaje debe tener entre 10 y 1000 caracteres.', f.mensaje);
        if (!f.acepta.checked) err('acepta', 'Tenés que aceptar que te contactemos.', f.acepta);

        if (primero) { e.preventDefault(); primero.focus(); }
    });
})();
