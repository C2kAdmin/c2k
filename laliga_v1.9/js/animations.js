// Archivo: animations.js
// Descripción: Manejo global de activación de animaciones en la página

// Función para verificar si un elemento es visible en el viewport
function isVisible(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Función para activar animaciones cuando los elementos entran en el viewport
function activateAnimations() {
    document.querySelectorAll('.fade-in, .slide-up, .zoom-in').forEach(element => {
        if (isVisible(element) && !element.classList.contains('active')) {
            element.classList.add('active');
        }
    });
}

// Eventos para activar las animaciones
window.addEventListener('DOMContentLoaded', activateAnimations);
window.addEventListener('scroll', activateAnimations);
