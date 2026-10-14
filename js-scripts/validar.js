
var Validar = {
    email: function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); },
    telefono: function (v) { return /^[0-9+\-\s]{6,20}$/.test(v); },

    mostrarError: function (campo, texto) {
        var el = document.querySelector('.error[data-for="' + campo + '"]');
        if (el) el.textContent = texto;
    },

    limpiar: function (campos) {
        campos.forEach(function (c) { Validar.mostrarError(c, ''); });
    },

    contador: function (textarea, salida) {
        var actualizar = function () { salida.textContent = textarea.value.length; };
        textarea.addEventListener('input', actualizar);
        actualizar();
    }
};
