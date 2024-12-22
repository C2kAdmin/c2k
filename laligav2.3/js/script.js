// Archivo: js/script.js

document.addEventListener("DOMContentLoaded", () => {
    const menuButtons = document.querySelectorAll(".menu-button");
    const mainContent = document.getElementById("main-content");
    const hamburgerMenu = document.getElementById("hamburger-menu");
    const menu = document.getElementById("menu");

    // Manejo de clics en los botones del menú
    menuButtons.forEach(button => {
        button.addEventListener("click", () => {
            const moduleName = button.getAttribute("data-module");
            loadModule(moduleName);
            if (menu.classList.contains("visible")) {
                menu.classList.remove("visible"); // Cierra el menú tras seleccionar un módulo
            }
        });
    });

    // Mostrar/ocultar menú en dispositivos móviles
    hamburgerMenu.addEventListener("click", () => {
        menu.classList.toggle("visible");
    });

    // Función para cargar módulos dinámicamente
    function loadModule(moduleName) {
        fetch(`mods/${moduleName}/${moduleName}.php`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error al cargar el módulo: ${moduleName}`);
                }
                return response.text();
            })
            .then(html => {
                mainContent.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                mainContent.innerHTML = "<p>Error al cargar el contenido. Inténtalo más tarde.</p>";
            });
    }
});
