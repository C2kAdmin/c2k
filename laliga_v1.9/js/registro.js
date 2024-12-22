document.addEventListener("DOMContentLoaded", function () {
    // Mostrar el modal de registro
    function mostrarRegistro() {
        const modal = document.getElementById("registroModal");
        modal.style.display = "block";
    }

    // Cerrar el modal de registro
    function cerrarRegistro() {
        const modal = document.getElementById("registroModal");
        modal.style.display = "none";
    }

    // Configuración de intl-tel-input para el campo de teléfono
    const telefonoInput = document.querySelector("#telefono");
    const paisInput = document.querySelector("#pais"); // Campo oculto para el país

    const iti = window.intlTelInput(telefonoInput, {
        initialCountry: "cl",
        geoIpLookup: function (callback) {
            fetch("https://ipinfo.io/json?token=your_api_token_here")
                .then((response) => response.json())
                .then((data) => callback(data.country || "cl"))
                .catch(() => callback("cl"));
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        separateDialCode: true,
    });

    // Actualizar el campo oculto de país al cambiar el código de teléfono
    telefonoInput.addEventListener("countrychange", function () {
        const countryData = iti.getSelectedCountryData();
        paisInput.value = countryData.name; // Actualiza el nombre del país
    });

    // Validar las posiciones seleccionadas
    function validarPosiciones() {
        const pos1 = document.querySelector("#pos1").value;
        const pos2 = document.querySelector("#pos2").value;
        const pos3 = document.querySelector("#pos3").value;

        if (pos1 === pos2 || pos1 === pos3 || pos2 === pos3) {
            mostrarNotificacion("Las posiciones seleccionadas deben ser diferentes.", "error");
            return false;
        }
        return true;
    }

    // Manejar el registro de usuario
    document.querySelector("#registroForm").addEventListener("submit", function (e) {
        e.preventDefault(); // Evitar la recarga de la página

        // Validar las posiciones antes de enviar
        if (!validarPosiciones()) {
            return;
        }

        // Asegurarse de que el campo de país está actualizado antes de enviar
        const countryData = iti.getSelectedCountryData();
        paisInput.value = countryData.name || ""; // Asegura que haya un valor

        const formData = new FormData(this);

        fetch("procesar_registro.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    mostrarNotificacion(data.message, "success");
                    cerrarRegistro(); // Cerrar el modal
                    document.querySelector("#registroForm").reset(); // Limpiar el formulario
                } else {
                    mostrarNotificacion(data.message, "error");
                }
            })
            .catch((error) => {
                console.error("Error al registrar:", error);
                mostrarNotificacion("Ocurrió un error. Intenta nuevamente.", "error");
            });
    });

    // Exponer funciones globalmente
    window.mostrarRegistro = mostrarRegistro;
    window.cerrarRegistro = cerrarRegistro;
});