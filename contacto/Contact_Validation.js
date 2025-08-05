document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const nombreInput = document.getElementById('nombre');
    const correoInput = document.getElementById('correo');
    const telefonoInput = document.getElementById('telefono');
    const mensajeInput = document.getElementById('mensaje');

    const nombreError = document.getElementById('nombreError');
    const correoError = document.getElementById('correoError');
    const telefonoError = document.getElementById('telefonoError');
    const mensajeError = document.getElementById('mensajeError');

    // Función para mostrar errores
    function showError(element, message) {
        element.textContent = message;
        element.style.display = 'block';
        element.previousElementSibling.classList.add('invalid'); // Añade clase para borde rojo
    }

    // Función para ocultar errores
    function hideError(element) {
        element.textContent = '';
        element.style.display = 'none';
        element.previousElementSibling.classList.remove('invalid'); // Remueve clase
    }

    // Validar Nombre
    nombreInput.addEventListener('input', function() {
        if (nombreInput.value.trim() === '') {
            showError(nombreError, 'El nombre es obligatorio.');
        } else {
            hideError(nombreError);
        }
    });

    // Validar Correo
    correoInput.addEventListener('input', function() {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (correoInput.value.trim() === '') {
            showError(correoError, 'El correo electrónico es obligatorio.');
        } else if (!emailPattern.test(correoInput.value.trim())) {
            showError(correoError, 'Ingresa un correo electrónico válido.');
        } else {
            hideError(correoError);
        }
    });

    // Validar Teléfono (opcional, según tu patrón)
    telefonoInput.addEventListener('input', function() {
        const phonePattern = /^[0-9]{10}$/; // Asume 10 dígitos numéricos
        if (telefonoInput.value.trim() !== '' && !phonePattern.test(telefonoInput.value.trim())) {
            showError(telefonoError, 'Ingresa un número de teléfono válido (10 dígitos).');
        } else {
            hideError(telefonoError);
        }
    });

    // Validar Mensaje
    mensajeInput.addEventListener('input', function() {
        if (mensajeInput.value.trim() === '') {
            showError(mensajeError, 'El mensaje es obligatorio.');
        } else {
            hideError(mensajeError);
        }
    });

    // Validación final al enviar el formulario
    form.addEventListener('submit', function(event) {
        let isValid = true;

        // Forzar validación en todos los campos al enviar
        if (nombreInput.value.trim() === '') {
            showError(nombreError, 'El nombre es obligatorio.');
            isValid = false;
        } else {
            hideError(nombreError);
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (correoInput.value.trim() === '') {
            showError(correoError, 'El correo electrónico es obligatorio.');
            isValid = false;
        } else if (!emailPattern.test(correoInput.value.trim())) {
            showError(correoError, 'Ingresa un correo electrónico válido.');
            isValid = false;
        } else {
            hideError(correoError);
        }

        const phonePattern = /^[0-9]{10}$/;
        if (telefonoInput.value.trim() !== '' && !phonePattern.test(telefonoInput.value.trim())) {
            showError(telefonoError, 'Ingresa un número de teléfono válido (10 dígitos).');
            isValid = false;
        } else {
            hideError(telefonoError);
        }

        if (mensajeInput.value.trim() === '') {
            showError(mensajeError, 'El mensaje es obligatorio.');
            isValid = false;
        } else {
            hideError(mensajeError);
        }

        if (!isValid) {
            event.preventDefault(); // Detener el envío del formulario si hay errores
            alert('Por favor, corrige los errores en el formulario.');
        }
    });
});
