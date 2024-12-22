// mod_flot_izq.js

document.addEventListener('DOMContentLoaded', function() {
    var modFlotIzq = document.querySelector('.mod_flot_izq');
    var containerSecund = document.querySelector('.left-column_secun');
    var header = document.querySelector('.header');

    function ajustarModuloFlotante() {
        var rect = containerSecund.getBoundingClientRect();
        var offsetTop = window.pageYOffset || document.documentElement.scrollTop;
        var containerTop = rect.top + offsetTop;
        var containerBottom = rect.bottom + offsetTop - window.innerHeight;
        var headerHeight = header.offsetHeight;

        if (window.innerWidth > 768) {
            if (offsetTop > containerTop - headerHeight && offsetTop < containerBottom) {
                modFlotIzq.style.position = 'fixed';
                modFlotIzq.style.top = headerHeight + 'px'; // Ajusta el valor según la altura del header
                modFlotIzq.style.width = (containerSecund.clientWidth - 3) + 'px'; // Mantener el ancho del contenedor
                modFlotIzq.style.left = '2px'; // Ajuste de 2 píxeles a la izquierda
            } else {
                modFlotIzq.style.position = 'relative';
                modFlotIzq.style.top = 'initial';
                modFlotIzq.style.width = 'calc(100% - 3px)'; // Ancho ajustado del módulo flotante
                modFlotIzq.style.left = '0'; // Restablecer el valor de left
            }
        } else {
            modFlotIzq.style.position = 'relative';
            modFlotIzq.style.top = 'initial';
            modFlotIzq.style.width = '100%'; // Ancho normal en dispositivos móviles
            modFlotIzq.style.left = '0'; // Restablecer el valor de left
        }
    }

    window.addEventListener('scroll', ajustarModuloFlotante);
    window.addEventListener('resize', ajustarModuloFlotante);
    ajustarModuloFlotante(); // Llamada inicial
});
