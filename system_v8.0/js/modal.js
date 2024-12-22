document.addEventListener("DOMContentLoaded", function () {
    // Manejo de botones del menú
    document.querySelectorAll(".menu-button").forEach(function (button) {
        button.addEventListener("click", function () {
            document.querySelectorAll(".menu-button").forEach(function (btn) {
                btn.classList.remove("active");
            });
            this.classList.add("active");

            const modulo = this.getAttribute("data-modulo");
            cargarModulo(modulo);

            // Cerrar el menú móvil después de seleccionar una opción
            if (this.classList.contains("mobile-menu-item")) {
                document.getElementById("mobile-menu-content").classList.remove("show");
            }
        });
    });

    // Función para cargar módulos dinámicamente
    function cargarModulo(modulo) {
        const contenidoDinamico = document.getElementById("contenido_dinamico");
        contenidoDinamico.style.opacity = 0;

        fetch(modulo)
            .then(response => {
                if (!response.ok) throw new Error(`Error al cargar: ${response.statusText}`);
                return response.text();
            })
            .then(html => {
                contenidoDinamico.innerHTML = html;
                contenidoDinamico.style.opacity = 1;
                activateAnimations();
            })
            .catch(error => {
                console.error(`Error al cargar el módulo: ${error.message}`);
            });
    }

    // Manejo del menú móvil (mostrar/ocultar)
    const menuIcon = document.getElementById("menu-icon");
    if (menuIcon) {
        menuIcon.addEventListener("click", function () {
            const mobileMenuContent = document.getElementById("mobile-menu-content");
            mobileMenuContent.classList.toggle("show");
        });
    }

    // Función para activar animaciones en elementos cargados dinámicamente
    function activateAnimations() {
        const elements = document.querySelectorAll(
            ".slide-left, .slide-right, .slide-up, .slide-down, .fade-in, .fade-out, .zoom-in, .zoom-out"
        );
        elements.forEach(function (element) {
            element.classList.add(`${element.className.split(" ")[0]}-active`);
        });
    }
});
