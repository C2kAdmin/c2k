document.addEventListener("DOMContentLoaded", function () {
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
                    cargarEstilosScriptsRegistro();
                }
                activateAnimations();
                recalibrarDesplazamiento();
            })
            .catch(error => {
                console.error(`Error al cargar el módulo: ${error.message}`);
            });
    }

    function activateAnimations() {
        const elements = document.querySelectorAll(
            ".slide-left, .slide-right, .slide-up, .slide-down, .fade-in, .fade-out, .zoom-in, .zoom-out"
        );
        elements.forEach(function (element) {
            element.classList.add(`${element.className.split(" ")[0]}-active`);
        });
    }

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
            script.onload = () => inicializarIntlTelInput();
            document.body.appendChild(script);
        } else {
            inicializarIntlTelInput();
        }
    }

    function inicializarIntlTelInput() {
        const telefono = document.getElementById("telefono");
        const pais = document.getElementById("pais");
        if (telefono) {
            const iti = intlTelInput(telefono, {
                initialCountry: "auto",
                geoIpLookup: function (callback) {
                    fetch("https://ipinfo.io/json?token=YOUR_VALID_TOKEN")
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

    function recalibrarDesplazamiento() {
        const headerHeight = document.querySelector(".header").offsetHeight;
        const anchor = document.getElementById("contenido_ancla").offsetTop - headerHeight;
        window.scrollTo({ top: anchor, behavior: "smooth" });
    }
});
