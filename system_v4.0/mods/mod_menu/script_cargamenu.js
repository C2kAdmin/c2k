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
        var headerHeight = document.querySelector(".header").offsetHeight;

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
                    setTimeout(function() {
                        document.getElementById("contenido_ancla").scrollIntoView({ behavior: 'smooth' });
                    }, 100); // Pequeña espera para recalibrar el desplazamiento después de la transición
                }
            };
            xhttp.open("GET", modulo, true);
            xhttp.send();
        }, 500); // Este valor debe coincidir con la duración de la transición de opacidad
    }
});
