document.addEventListener("DOMContentLoaded", function () {
    // JavaScript para desplazar hasta la sección específica
    document.getElementById("boton_desplazar").addEventListener("click", function () {
        document.querySelector(".section-footer").scrollIntoView({ behavior: "smooth" });
    });

    document.getElementById("boton_desplazar_movil").addEventListener("click", function () {
        document.querySelector(".section-footer").scrollIntoView({ behavior: "smooth" });
        document.getElementById("mobile-menu-content").classList.remove("show");
    });

    // JavaScript para mostrar/ocultar el menú móvil
    document.getElementById("menu-icon").addEventListener("click", function () {
        var mobileMenu = document.getElementById("mobile-menu-content");
        mobileMenu.classList.toggle("show");
    });

    // JavaScript para cargar módulos dinámicamente
    document.querySelectorAll(".menu-button").forEach(function (button) {
        button.addEventListener("click", function () {
            // Eliminar la clase de todos los botones
            document.querySelectorAll(".menu-button").forEach(function (btn) {
                btn.classList.remove("active");
            });

            // Agregar la clase al botón clickeado
            this.classList.add("active");

            var modulo = this.getAttribute("data-modulo");
            cargarModulo(modulo);
            if (this.classList.contains("mobile-menu-item")) {
                document.getElementById("mobile-menu-content").classList.remove("show");
            }
        });
    });

    // Función para cargar módulos dinámicamente
    function cargarModulo(modulo) {
        var contenidoDinamico = document.getElementById("contenido_dinamico");

        // Paso 1: Desvanecer el contenido actual
        contenidoDinamico.style.opacity = 0;

        // Paso 2: Cargar el nuevo contenido
        setTimeout(function () {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Paso 3: Reemplazar el contenido
                    contenidoDinamico.innerHTML = this.responseText;

                    // Paso 4: Hacer visible el nuevo contenido
                    contenidoDinamico.style.opacity = 1;

                    // Inicializar el JS del módulo cargado
                    if (modulo.includes("mod_registro")) {
                        inicializarRegistro();
                    }
                    if (modulo.includes("mod_sesion")) {
                        inicializarSesion();
                    }

                    // Activar animaciones
                    activateAnimations();
                }
            };
            xhttp.open("GET", modulo, true);
            xhttp.send();
        }, 500); // Este valor debe coincidir con la duración de la transición de opacidad
    }

    // Función para inicializar el módulo de registro después de cargarlo dinámicamente
    function inicializarRegistro() {
        const telefonoInput = document.querySelector("#telefono");

        if (telefonoInput) {
            const iti = intlTelInput(telefonoInput, {
                initialCountry: "auto",
                geoIpLookup: function (callback) {
                    fetch("https://ipapi.co/json/")
                        .then((response) => response.json())
                        .then((data) => callback(data.country_code))
                        .catch(() => callback("US"));
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });

            telefonoInput.addEventListener("blur", function () {
                if (!iti.isValidNumber()) {
                    telefonoInput.classList.add("error");
                    mostrarNotificacion("Por favor, ingrese un número de teléfono válido.", "error");
                } else {
                    telefonoInput.classList.remove("error");
                }
            });
        }

        const registroForm = document.getElementById("registroForm");
        registroForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(registroForm);

            fetch("https://c2k.cl/laliga_V1.0/mods/mod_registro/procesar_registro.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        mostrarNotificacion(data.message, "success");
                        registroForm.reset();
                    } else {
                        mostrarNotificacion("Error: " + data.error, "error");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    mostrarNotificacion("Error al procesar el registro.", "error");
                });
        });
    }

    alquier módulo dinámico, pero vamos a asegurarnos de que el módulo de sesión se inicialice correctamente después de cargarse.

En tu mod_menu.js, modifica o agrega lo siguiente:

javascript
Copiar código
// Función para cargar módulos dinámicamente
function cargarModulo(modulo) {
    var contenidoDinamico = document.getElementById("contenido_dinamico");

    console.log(`Intentando cargar el módulo: ${modulo}`); // Depuración

    // Paso 1: Desvanecer el contenido actual
    contenidoDinamico.style.opacity = 0;

    // Paso 2: Cargar el nuevo contenido
    setTimeout(function () {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Paso 3: Reemplazar el contenido
                contenidoDinamico.innerHTML = this.responseText;

                // Paso 4: Hacer visible el nuevo contenido
                contenidoDinamico.style.opacity = 1;

                // Inicializar el JS del módulo cargado
                if (modulo.includes("mod_registro")) {
                    inicializarRegistro();
                }
                if (modulo.includes("mod_sesion")) {
                    inicializarSesion();
                }

                // Activar animaciones
                activateAnimations();
            } else if (this.readyState == 4) {
                console.error(`Error al cargar el módulo: ${modulo} (status: ${this.status})`);
            }
        };
        xhttp.open("GET", modulo, true);
        xhttp.send();
    }, 500); // Este valor debe coincidir con la duración de la transición de opacidad
}

// Función para inicializar el módulo de inicio de sesión después de cargarlo dinámicamente
function inicializarSesion() {
    console.log("Inicializando el módulo de inicio de sesión.");

    const sesionForm = document.getElementById("sesionForm");
    if (sesionForm) {
        sesionForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(sesionForm);

            fetch("mods/mod_sesion/procesar_login.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        mostrarNotificacion(data.message, "success");
                        // Recargar o actualizar elementos relacionados con la sesión
                        window.location.reload();
                    } else {
                        mostrarNotificacion("Error: " + data.error, "error");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    mostrarNotificacion("Error al procesar el inicio de sesión.", "error");
                });
        });
    } else {
        console.error("Formulario de inicio de sesión no encontrado.");
    }
}

    // Función para mostrar notificaciones emergentes
    function mostrarNotificacion(mensaje, tipo) {
        const notification = document.createElement("div");
        notification.className = `notification ${tipo}`;
        notification.textContent = mensaje;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add("show");
        }, 100);

        setTimeout(() => {
            notification.classList.remove("show");
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    // Funciones de animación
    function isVisible(element) {
        var rect = element.getBoundingClientRect();
        var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
        return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
    }

    function activateAnimations() {
        var elements = document.querySelectorAll(
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
                        element.classList.add(cls + "-active");
                    }
                });
            }
        });
    }

    // Activar las animaciones cuando se carga la página y cuando se hace scroll
    document.addEventListener("DOMContentLoaded", activateAnimations);
    document.addEventListener("scroll", activateAnimations);
});
