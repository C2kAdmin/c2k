document.addEventListener('DOMContentLoaded', function() {
    const perfilForm = document.getElementById('perfilForm');
    const eliminarCuentaButton = document.getElementById('eliminarCuentaButton');

    // Manejar el formulario de actualización del perfil
    perfilForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(perfilForm);

        fetch('procesar_perfil.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Perfil actualizado exitosamente.');
                // Actualizar la imagen y el nombre del usuario si se modificaron
                if (data.foto_perfil) {
                    document.getElementById('imagen-usuario').src = data.foto_perfil;
                }
                if (data.username) {
                    document.getElementById('nombre-usuario').textContent = data.username;
                }
            } else {
                alert('Error al actualizar el perfil: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error al intentar actualizar el perfil:', error);
            alert('Error al intentar actualizar el perfil.');
        });
    });

    // Manejar el botón de eliminar cuenta
    eliminarCuentaButton.addEventListener('click', function() {
        if (confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')) {
            fetch('eliminar_cuenta.php', {
                method: 'POST',
                body: JSON.stringify({ email: document.getElementById('email').value }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cuenta eliminada exitosamente.');
                    window.location.href = '/index.php';
                } else {
                    alert('Error al eliminar la cuenta: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error al intentar eliminar la cuenta:', error);
                alert('Error al intentar eliminar la cuenta.');
            });
        }
    });
});
