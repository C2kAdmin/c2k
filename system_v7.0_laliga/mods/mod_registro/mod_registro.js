document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form_registro");

    if (!form) {
        console.error("No se encontró el formulario.");
        return;
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Evitar el envío estándar del formulario

        const formData = new FormData(form);

        fetch("mods/mod_registro/procesar_registro.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.status === "success") {
                    // Mostrar mensaje de éxito dentro de la página
                    mostrarMensaje("success", data.message);
                } else {
                    // Mostrar mensaje de error
                    mostrarMensaje("error", data.message);
                }
            })
            .catch((error) => {
                console.error("Error al procesar el registro:", error);
                mostrarMensaje("error", "Hubo un problema al procesar el registro.");
            });
    });

    function mostrarMensaje(tipo, mensaje) {
        const mensajeDiv = document.createElement("div");
        mensajeDiv.className = `alert ${tipo}`;
        mensajeDiv.textContent = mensaje;

        const formContainer = document.querySelector(".mod_registro");
        formContainer.insertBefore(mensajeDiv, formContainer.firstChild);

        // Ocultar el mensaje después de 5 segundos
        setTimeout(() => {
            mensajeDiv.remove();
        }, 5000);
    }
});
