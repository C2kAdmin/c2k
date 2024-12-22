// mods/mod_sesion/mod_login.js

document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(loginForm);

        fetch('https://c2k.cl/laliga_V1.0/mods/mod_sesion/procesar_login.php', {
            method: 'POST',
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    mostrarNotificacion(data.message, 'success');
                    // Actualizar la interfaz con información del usuario
                    cargarModulo('mods/mod_dashboard/mod_dashboard.php');
                } else {
                    mostrarNotificacion(data.error, 'error');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                mostrarNotificacion('Error al iniciar sesión.', 'error');
            });
    });
});
