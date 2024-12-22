// Función para mostrar notificaciones personalizadas
function mostrarNotificacion(mensaje, tipo = "info") {
    const notificacion = document.createElement("div");
    notificacion.className = `notificacion ${tipo}`;
    notificacion.textContent = mensaje;

    // Agregar la notificación al DOM
    document.body.appendChild(notificacion);

    // Eliminar la notificación después de 3 segundos
    setTimeout(() => {
        notificacion.remove();
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function () {
    const telefonoInput = document.querySelector('#telefono');

    if (telefonoInput) {
        const iti = intlTelInput(telefonoInput, {
            initialCountry: 'auto',
            geoIpLookup: function (callback) {
                fetch('https://ipapi.co/json/')
                    .then(response => response.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback('US'));
            },
            utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js'
        });

        telefonoInput.addEventListener('blur', function () {
            if (!iti.isValidNumber()) {
                telefonoInput.classList.add('error');
                mostrarNotificacion('Por favor, ingrese un número de teléfono válido.', 'error');
            } else {
                telefonoInput.classList.remove('error');
            }
        });
    }

    const registroForm = document.getElementById('registroForm');
    registroForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(registroForm);

        fetch('https://c2k.cl/laliga_V1.0/mods/mod_registro/procesar_registro.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mostrarNotificacion(data.message, 'success');
                    registroForm.reset();
                } else {
                    mostrarNotificacion('Error: ' + data.error, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarNotificacion('Error al procesar el registro.', 'error');
            });
    });
});
