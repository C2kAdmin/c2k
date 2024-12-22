document.addEventListener("DOMContentLoaded", function () {
    // Cargar datos del perfil
    function cargarDatosPerfil() {
        fetch("mods/mod_perfil/obtener_datos_perfil.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error al obtener los datos del perfil.");
                }
                return response.json();
            })
            .then(data => {
                document.getElementById("nombreUsuario").innerText = data.nombre_usuario || "N/A";
                document.getElementById("correoUsuario").innerText = data.correo || "N/A";
                document.getElementById("telefonoUsuario").innerText = data.telefono || "N/A";
                document.getElementById("plataformaUsuario").innerText = data.plataforma || "N/A";
                document.getElementById("generacionUsuario").innerText = data.generacion || "N/A";
                document.getElementById("posicionesUsuario").innerText = `${data.pos1 || "-"} / ${data.pos2 || "-"} / ${data.pos3 || "-"}`;
                
                const imagenPerfil = document.getElementById("imagenPerfil");
                if (data.imagen_perfil_url) {
                    imagenPerfil.src = data.imagen_perfil_url;
                    imagenPerfil.style.display = "block";
                } else {
                    imagenPerfil.style.display = "none";
                }
            })
            .catch(error => {
                console.error("Error al cargar los datos del perfil:", error);
                alert("Ocurrió un error al cargar los datos del perfil.");
            });
    }

    // Inicializar la carga de datos
    cargarDatosPerfil();
});
