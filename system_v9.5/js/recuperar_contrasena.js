document.addEventListener("DOMContentLoaded", function () {
    // Mostrar el modal de recuperación
    function mostrarRecuperar() {
        const modal = document.getElementById("recuperarModal");
        modal.style.display = "block";
    }

    // Cerrar el modal de recuperación
    function cerrarRecuperar() {
        const modal = document.getElementById("recuperarModal");
        modal.style.display = "none";
    }

    // Manejar la recuperación de contraseña
    document.querySelector("#recuperarForm").addEventListener("submit", function (e) {
        e.preventDefault(); // Evitar la recarga de la página

        const formData = new FormData(this);

        fetch("procesar_recuperar.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    mostrarNotificacion(data.message, "success");
                    cerrarRecuperar(); // Cerrar el modal
                    document.querySelector("#recuperarForm").reset(); // Limpiar el formulario
                } else {
                    mostrarNotificacion(data.message, "error");
                }
            })
            .catch((error) => {
                console.error("Error al enviar solicitud:", error);
                mostrarNotificacion("Ocurrió un error. Intenta nuevamente.", "error");
            });
    });

    // Exponer funciones globalmente
    window.mostrarRecuperar = mostrarRecuperar;
    window.cerrarRecuperar = cerrarRecuperar;
});
