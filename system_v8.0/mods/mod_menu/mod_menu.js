document.addEventListener("DOMContentLoaded", function () {
    // Manejo de botones del menú
    document.querySelectorAll(".menu-button").forEach(function (button) {
        button.addEventListener("click", function () {
            // Remover la clase activa de todos los botones
            document.querySelectorAll(".menu-button").forEach(function (btn) {
                btn.classList.remove("active");
            });
            // Activar el botón actual
            this.classList.add("active");

            // Obtener el módulo desde el atributo data-modulo
            const modulo = this.getAttribute("data-modulo");
            cargarModulo(modulo);
        });
    });

    // Función para cargar módulos dinámicamente
    function cargarModulo(modulo) {
        const contenidoDinamico = document.getElementById("contenido_dinamico");
        contenidoDinamico.style.opacity = 0; // Animación inicial (opacidad)

        fetch(modulo) // Hacer una petición al archivo del módulo
            .then(response => {
                if (!response.ok) throw new Error(`Error al cargar: ${response.statusText}`);
                return response.text();
            })
            .then(html => {
                // Insertar el contenido dinámico
                contenidoDinamico.innerHTML = html;
                contenidoDinamico.style.opacity = 1; // Restaurar opacidad

                // Opcional: Inicializar funcionalidades específicas si el módulo requiere scripts adicionales
                if (modulo.includes("mod_registro")) {
                    cargarEstilosScriptsRegistro();
                }

                // Activar animaciones en los elementos cargados
                activateAnimations();
            })
            .catch(error => {
                console.error(`Error al cargar el módulo: ${error.message}`);
            });
    }

    // Función para cargar estilos y scripts de mod_registro (si aplica)
    function cargarEstilosScriptsRegistro() {
        if (!document.querySelector('link[href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"]')) {
            const link = document.createElement("link");
            link.rel = "stylesheet";
            link.href = "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css";
            document.head.appendChild(link);
        }

        if (!document.querySelector('script[src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"]')) {
            const script = document.createElement("script");
            script.src = "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js";
            document.body.appendChild(script);
        }
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
