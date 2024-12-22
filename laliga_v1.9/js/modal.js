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

    // Mostrar el modal de inicio de sesión
    function mostrarLogin() {
        const modal = document.getElementById("loginModal");
        modal.style.display = "block";
    }

    // Cerrar el modal de inicio de sesión
    function cerrarLogin() {
        const modal = document.getElementById("loginModal");
        modal.style.display = "none";
    }

    // Mostrar el modal de recuperación de contraseña
    function mostrarRecuperar() {
        const modal = document.getElementById("recuperarModal");
        modal.style.display = "block";
    }

    // Cerrar el modal de recuperación de contraseña
    function cerrarRecuperar() {
        const modal = document.getElementById("recuperarModal");
        modal.style.display = "none";
    }

    // Mostrar el modal de cambio de contraseña
    function mostrarCambiarContrasena() {
        const modal = document.getElementById("cambiarContrasenaModal");
        if (modal) {
            modal.style.display = "block";
        }
    }

    // Cerrar el modal de cambio de contraseña
    function cerrarCambiarContrasena() {
        const modal = document.getElementById("cambiarContrasenaModal");
        if (modal) {
            modal.style.display = "none";
        }
    }

    // Mostrar notificación
    function mostrarNotificacion(mensaje, tipo = "success") {
        const notificacion = document.createElement("div");
        notificacion.className = `notification ${tipo}`;
        notificacion.innerText = mensaje;

        document.body.appendChild(notificacion);

        // Mostrar la notificación
        setTimeout(() => {
            notificacion.classList.add("show");
        }, 100);

        // Ocultar y eliminar la notificación después de 3 segundos
        setTimeout(() => {
            notificacion.classList.remove("show");
            setTimeout(() => notificacion.remove(), 300);
        }, 3000);
    }

    // Cerrar cualquier modal al hacer clic fuera del contenido
    window.onclick = function (event) {
        const registroModal = document.getElementById("registroModal");
        const loginModal = document.getElementById("loginModal");
        const recuperarModal = document.getElementById("recuperarModal");
        const cambiarContrasenaModal = document.getElementById("cambiarContrasenaModal");

        if (event.target === registroModal) cerrarRegistro();
        if (event.target === loginModal) cerrarLogin();
        if (event.target === recuperarModal) cerrarRecuperar();
        if (event.target === cambiarContrasenaModal) cerrarCambiarContrasena();
    };

    // Detectar el token en la URL y mostrar el modal de cambio de contraseña
    const urlParams = new URLSearchParams(window.location.search);
    const resetToken = urlParams.get("reset_token");
    if (resetToken) {
        mostrarCambiarContrasena();
        const tokenInput = document.querySelector("#cambiarContrasenaForm input[name='reset_token']");
        if (tokenInput) tokenInput.value = resetToken;
    }

    // Exponer funciones globalmente
    window.mostrarRegistro = mostrarRegistro;
    window.cerrarRegistro = cerrarRegistro;
    window.mostrarLogin = mostrarLogin;
    window.cerrarLogin = cerrarLogin;
    window.mostrarRecuperar = mostrarRecuperar;
    window.cerrarRecuperar = cerrarRecuperar;
    window.mostrarCambiarContrasena = mostrarCambiarContrasena;
    window.cerrarCambiarContrasena = cerrarCambiarContrasena;
    window.mostrarNotificacion = mostrarNotificacion;
});
