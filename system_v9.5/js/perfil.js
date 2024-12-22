document.addEventListener("DOMContentLoaded", function() {
    var updateForm = document.getElementById('actualizarPerfilForm');
    var iti;  // Variable para almacenar la instancia de intlTelInput

    function setupIntlTelInput() {
        var input = document.getElementById('telefono');
        if (input) {
            if (iti) {
                iti.destroy();  // Destruye la instancia anterior si existe
            }
            iti = window.intlTelInput(input, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js", // Util script para formato y validación
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    fetch('https://ipinfo.io/json')
                        .then(response => response.json())
                        .then(data => callback(data.country.toLowerCase()))
                        .catch(() => callback('us'));
                },
                nationalMode: true,
                formatOnDisplay: true,
                separateDialCode: true
            });
        }
    }

    if (updateForm) {
        updateForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(updateForm);

            fetch('procesar_actualizar_perfil.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Perfil actualizado correctamente.');
                    cerrarActualizarPerfil();
                } else {
                    alert('Error al actualizar el perfil: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        });
    }

    document.getElementById("foto_perfil").addEventListener("change", previewImage);

    window.mostrarActualizarPerfil = function() {
        document.getElementById("actualizarPerfilModal").style.display = "block";
        setupIntlTelInput();  // Inicializa el input de teléfono cada vez que se muestra el modal
    };

    window.cerrarActualizarPerfil = function() {
        document.getElementById("actualizarPerfilModal").style.display = "none";
        if (iti && iti.destroy) {
            iti.destroy();  // Destruye la instancia de intlTelInput para evitar problemas de inicialización
            iti = null;  // Asegúrate de limpiar la variable
        }
    };

    function previewImage() {
        var file = document.getElementById("foto_perfil").files[0];
        if (file) {
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                document.getElementById("profile_pic_preview").setAttribute("src", event.target.result);
            };
            fileReader.readAsDataURL(file);
        }
    }
});
