document.addEventListener("DOMContentLoaded", function () {
    // Desplazamiento hasta una sección específica
    document.getElementById("boton_desplazar").addEventListener("click", function () {
        document.querySelector(".section-footer").scrollIntoView({ behavior: 'smooth' });
    });

    document.getElementById("boton_desplazar_movil").addEventListener("click", function () {
        document.querySelector(".section-footer").scrollIntoView({ behavior: 'smooth' });
        document.getElementById("mobile-menu-content").classList.remove("show");
    });

    // Mostrar/ocultar menú móvil
    document.getElementById("menu-icon").addEventListener("click", function () {
        var mobileMenu = document.getElementById("mobile-menu-content");
        mobileMenu.classList.toggle("show");
    });

    // Cargar módulos dinámicamente
    document.querySelectorAll(".menu-button").forEach(function (button) {
        button.addEventListener("click", function () {
            document.querySelectorAll(".menu-button").forEach(function (btn) {
                btn.classList.remove("active");
            });
            this.classList.add("active");

            var modulo = this.getAttribute("data-modulo");
            cargarModulo(modulo);

            if (this.classList.contains("mobile-menu-item")) {
                document.getElementById("mobile-menu-content").classList.remove("show");
            }
        });
    });

    function cargarModulo(modulo) {
        const contenidoDinamico = document.getElementById("contenido_dinamico");

        // Desvanecer el contenido actual
        contenidoDinamico.style.opacity = 0;

        // Cargar contenido según el tipo de módulo
        fetch(modulo)
            .then(response => {
                if (!response.ok) throw new Error(`Error al cargar el módulo: ${modulo}`);
                return response.text();
            })
            .then(html => {
                if (modulo.includes("mod_registro")) {
                    cargarModuloShadow(html, contenidoDinamico);
                } else {
                    contenidoDinamico.innerHTML = html;
                }
                contenidoDinamico.style.opacity = 1; // Hacer visible el contenido
            })
            .catch(error => {
                console.error(`Error al cargar el módulo: ${error.message}`);
                contenidoDinamico.innerHTML = `<p>Error al cargar el módulo.</p>`;
            });
    }

    function cargarModuloShadow(html, contenedor) {
        contenedor.innerHTML = ''; // Limpiar contenido previo
        const shadowHost = document.createElement("div");
        const shadow = shadowHost.attachShadow({ mode: "open" });

        // Extraer estilos y contenido
        const styleMatch = html.match(/<style>([\s\S]*?)<\/style>/);
        const styleContent = styleMatch ? styleMatch[1] : '';
        const htmlContent = html.replace(/<style>[\s\S]*?<\/style>/, '');

        // Insertar contenido y estilos
        shadow.innerHTML = `<style>${styleContent}</style>${htmlContent}`;
        contenedor.appendChild(shadowHost);
    }
});
