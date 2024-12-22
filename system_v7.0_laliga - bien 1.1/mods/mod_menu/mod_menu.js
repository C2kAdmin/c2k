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

            if (this.classList.contains("mobile-menu-item")) {
                document.getElementById("mobile-menu-content").classList.remove("show");
            }
        });
    });

    // Función principal para cargar módulos
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

                if (modulo.includes("mod_registro")) {
                    cargarEstilosScriptsRegistro(); // Inicializar intl-tel-input
                    aplicarAnimacionAleatoria(contenidoDinamico); // Aplicar animación al módulo de registro
                }

                recalibrarDesplazamiento();
                activateAnimations();
                reactivarBotonDesplazar();
            })
            .catch(error => {
                console.error(`Error al cargar el módulo: ${error.message}`);
            });
    }

    // Función para cargar estilos y scripts de mod_registro
    function cargarEstilosScriptsRegistro() {
        // Cargar estilos de intl-tel-input
        if (!document.querySelector('link[href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"]')) {
            const link = document.createElement("link");
            link.rel = "stylesheet";
            link.href = "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css";
            document.head.appendChild(link);
        }

        // Cargar script de intl-tel-input
        if (!document.querySelector('script[src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"]')) {
            const script = document.createElement("script");
            script.src = "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js";
            script.onload = () => inicializarIntlTelInput();
            document.body.appendChild(script);
        } else {
            inicializarIntlTelInput();
        }
    }

    // Función para inicializar intl-tel-input
    function inicializarIntlTelInput() {
        const telefono = document.getElementById("telefono");
        const pais = document.getElementById("pais");
        if (telefono) {
            const iti = intlTelInput(telefono, {
                initialCountry: "auto",
                geoIpLookup: function (callback) {
                    fetch("https://ipinfo.io/json?token=YOUR_VALID_TOKEN") // Reemplaza con tu token válido
                        .then(res => res.json())
                        .then(data => callback(data.country || "us"))
                        .catch(() => callback("us"));
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                separateDialCode: true,
            });

            telefono.addEventListener("countrychange", function () {
                const countryData = iti.getSelectedCountryData();
                pais.value = countryData.name;
            });
        }
    }

    // Función para aplicar una animación aleatoria
    function aplicarAnimacionAleatoria(elemento) {
        const animaciones = [
            "slide-left",
            "slide-right",
            "slide-up",
            "slide-down",
            "fade-in",
            "zoom-in",
            "rotate",
            "bounce"
        ];
        const animacionSeleccionada = animaciones[Math.floor(Math.random() * animaciones.length)];
        
        elemento.classList.add(animacionSeleccionada);

        // Eliminar la clase de animación después de la duración
        setTimeout(() => {
            elemento.classList.remove(animacionSeleccionada);
        }, 1000); // Ajusta el tiempo según la duración de tus animaciones
    }

    // Función para recalibrar el desplazamiento
    function recalibrarDesplazamiento() {
        const headerHeight = document.querySelector(".header").offsetHeight;
        const anchor = document.getElementById("contenido_ancla").offsetTop - headerHeight;
        window.scrollTo({ top: anchor, behavior: "smooth" });
    }

    // Función para reactivar el evento del botón de desplazamiento
    function reactivarBotonDesplazar() {
        const botonDesplazar = document.getElementById("boton_desplazar");
        if (botonDesplazar) {
            botonDesplazar.addEventListener("click", function () {
                document.querySelector(".section-footer").scrollIntoView({ behavior: "smooth" });
            });
        }

        const botonDesplazarMovil = document.getElementById("boton_desplazar_movil");
        if (botonDesplazarMovil) {
            botonDesplazarMovil.addEventListener("click", function () {
                document.querySelector(".section-footer").scrollIntoView({ behavior: "smooth" });
                document.getElementById("mobile-menu-content").classList.remove("show");
            });
        }
    }

    // Activar animaciones al cargar módulos dinámicos
    function activateAnimations() {
        const elements = document.querySelectorAll(
            ".slide-left, .slide-right, .slide-up, .slide-down, .fade-in, .fade-out, .zoom-in, .zoom-out, .rotate, .scale, .background-fade, .color-change, .pulse, .swing, .blink, .scroll, .shadow, .gradient, .bounce"
        );
        elements.forEach(function (element) {
            if (isVisible(element)) {
                element.classList.forEach(function (cls) {
                    if (
                        cls.startsWith("slide-") ||
                        cls.startsWith("fade-") ||
                        cls.startsWith("zoom-") ||
                        cls.startsWith("rotate") ||
                        cls.startsWith("scale") ||
                        cls.startsWith("background-fade") ||
                        cls.startsWith("color-change") ||
                        cls.startsWith("pulse") ||
                        cls.startsWith("swing") ||
                        cls.startsWith("blink") ||
                        cls.startsWith("scroll") ||
                        cls.startsWith("shadow") ||
                        cls.startsWith("gradient") ||
                        cls.startsWith("bounce")
                    ) {
                        element.classList.add(`${cls}-active`);
                    }
                });
            }
        });
    }

    // Función para verificar si un elemento es visible
    function isVisible(element) {
        const rect = element.getBoundingClientRect();
        const viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
        return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
    }

    // Inicialización de animaciones y eventos de desplazamiento
    activateAnimations();
    reactivarBotonDesplazar();
});
