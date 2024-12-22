document.addEventListener("DOMContentLoaded", function() {
    // JavaScript para desplazar hasta la sección específica
    document.getElementById("boton_desplazar").addEventListener("click", function() {
        document.querySelector(".section-footer").scrollIntoView({ behavior: 'smooth' });
    });

    document.getElementById("boton_desplazar_movil").addEventListener("click", function() {
        document.querySelector(".section-footer").scrollIntoView({ behavior: 'smooth' });
        document.getElementById("mobile-menu-content").classList.remove("show");
    });

    
	
	
	
	// Gestión del menú hamburguesa
    document.getElementById("menu-icon").addEventListener("click", function(event) {
        event.stopPropagation();  // Detiene la propagación para evitar que body lo cierre inmediatamente
        toggleMobileMenu();  // Alterna la visibilidad del menú móvil
    });

    // Cierra el menú si se hace clic fuera de él
    document.body.addEventListener("click", function(event) {
        if (!event.target.closest("#mobile-menu-content") && !event.target.closest("#menu-icon")) {
            toggleMobileMenu(false);  // Cierra el menú si se clickea fuera
        }
    });
	
	
	
	

    // Funciones para manejar la apertura y cierre de todos los modales
    setupModalHandlers();
});

function setupModalHandlers() {
    // Modales de registro y login
    document.querySelector("#registroModalLink").addEventListener("click", function() {
        mostrarModal("registroModal");
    });
    document.querySelector("#loginModalLink").addEventListener("click", function() {
        mostrarModal("loginModal");
    });

    // Cerrar modales con el botón de cerrar
    document.querySelectorAll(".cerrar").forEach(btn => {
        btn.addEventListener("click", function() {
            cerrarModal(this.closest(".modal"));
        });
    });

    // Cerrar cualquier modal al hacer clic fuera del contenido
    window.onclick = function(event) {
        if (event.target.className.includes("modal")) {
            cerrarModal(event.target);
        }
    };
}

function mostrarModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "block";
    }
}

function cerrarModal(modal) {
    if (modal) {
        modal.style.display = "none";
    }
}

// Funciones adicionales como ejemplos
function mostrarRegistro() {
    mostrarModal("registroModal");
}

function mostrarLogin() {
    mostrarModal("loginModal");
}

function cerrarRegistro() {
    cerrarModal(document.getElementById("registroModal"));
}

function cerrarLogin() {
    cerrarModal(document.getElementById("loginModal"));
}

// Función para mostrar notificaciones dinámicas en la página
function mostrarNotificacion(mensaje, tipo = "success") {
    const notificacion = document.createElement("div");
    notificacion.className = `notification ${tipo}`;
    notificacion.innerText = mensaje;

    document.body.appendChild(notificacion);
    setTimeout(() => notificacion.classList.add("show"), 100);
    setTimeout(() => {
        notificacion.classList.remove("show");
        setTimeout(() => notificacion.remove(), 300);
    }, 3000);
}






document.addEventListener("DOMContentLoaded", function() {
    // JavaScript para desplazar hasta la sección específica
    document.getElementById("boton_desplazar").addEventListener("click", function() {
        document.querySelector(".section-footer").scrollIntoView({ behavior: 'smooth' });
    });

    document.getElementById("boton_desplazar_movil").addEventListener("click", function() {
        document.querySelector(".section-footer").scrollIntoView({ behavior: 'smooth' });
        document.getElementById("mobile-menu-content").classList.remove("show");
    });

    // JavaScript para mostrar/ocultar el menú móvil
    document.getElementById("menu-icon").addEventListener("click", function() {
        var mobileMenu = document.getElementById("mobile-menu-content");
        mobileMenu.classList.toggle("show");
    });

    // JavaScript para cargar módulos dinámicamente
    document.querySelectorAll(".menu-button").forEach(function(button) {
        button.addEventListener("click", function() {
            // Eliminar la clase de todos los botones
            document.querySelectorAll(".menu-button").forEach(function(btn) {
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

    function cargarModulo(modulo) {
        var contenidoDinamico = document.getElementById("contenido_dinamico");

        // Paso 1: Desvanecer el contenido actual
        contenidoDinamico.style.opacity = 0;

        // Paso 2: Esperar a que la transición se complete antes de cargar el nuevo contenido
        setTimeout(function() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Paso 3: Reemplazar el contenido una vez que el contenido actual está completamente desvanecido
                    contenidoDinamico.innerHTML = this.responseText;

                    // Paso 4: Hacer visible el nuevo contenido con una transición
                    contenidoDinamico.style.opacity = 1;

                    // Desplazar hasta la sección después de cargar el módulo usando ancla
                    var headerHeight = document.querySelector(".header").offsetHeight;
                    var anchor = document.getElementById("contenido_ancla").offsetTop - headerHeight;
                    window.scrollTo({ top: anchor, behavior: 'smooth' });

                    // Recalibrar el desplazamiento después de que el contenido se haya cargado completamente
                    contenidoDinamico.addEventListener("transitionend", function() {
                        var recalibratedTop = document.getElementById("contenido_ancla").offsetTop - headerHeight;
                        window.scrollTo({ top: recalibratedTop, behavior: 'smooth' });
                    }, { once: true });
                    activateAnimations(); // Activar animaciones después de cargar el contenido
                }
            };
            xhttp.open("GET", modulo, true);
            xhttp.send();
        }, 500); // Este valor debe coincidir con la duración de la transición de opacidad
    }

    function isVisible(element) {
        var rect = element.getBoundingClientRect();
        var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
        return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
    }

    function activateAnimations() {
        var elements = document.querySelectorAll('.slide-left, .slide-right, .slide-up, .slide-down, .fade-in, .fade-out, .zoom-in, .zoom-out, .rotate, .scale, .background-fade, .color-change, .pulse, .swing, .blink, .scroll, .shadow, .gradient, .bounce');

        elements.forEach(function(element) {
            if (isVisible(element)) {
                element.classList.forEach(function(cls) {
                    if (cls.startsWith('slide-') || cls.startsWith('fade-') || cls.startsWith('zoom-') || cls.startsWith('rotate') || cls.startsWith('scale') || cls.startsWith('background-fade') || cls.startsWith('color-change') || cls.startsWith('pulse') || cls.startsWith('swing') || cls.startsWith('blink') || cls.startsWith('scroll') || cls.startsWith('shadow') || cls.startsWith('gradient') || cls.startsWith('bounce')) {
                        element.classList.add(cls + '-active');
                    }
                });
            }
        });
    }

    // Activar las animaciones cuando se carga la página y cuando se hace scroll
    document.addEventListener('DOMContentLoaded', activateAnimations);
    document.addEventListener('scroll', activateAnimations);
});

