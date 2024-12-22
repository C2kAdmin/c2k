document.addEventListener("DOMContentLoaded", function () {
    // Manejar el inicio de sesión
    document.querySelector("#loginForm").addEventListener("submit", function (e) {
        e.preventDefault(); // Evitar la recarga de la página

        const formData = new FormData(this);

        fetch("procesar_login.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    mostrarNotificacion(data.message, "success");
                    setTimeout(() => {
                        location.reload(); // Recargar la página para reflejar el inicio de sesión
                    }, 2000); // Espera para que el usuario vea el mensaje
                } else {
                    mostrarNotificacion(data.message, "error");
                }
            })
            .catch((error) => {
                console.error("Error al iniciar sesión:", error);
                mostrarNotificacion("Ocurrió un error. Intenta nuevamente.", "error");
            });
    });
});
