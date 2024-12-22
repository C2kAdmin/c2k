// mods/mod_googlemaps/mod_googlemaps.js
document.addEventListener('DOMContentLoaded', function() {
    var mapContainer = document.querySelector('.map-container');
    if (mapContainer) {
        mapContainer.classList.add('slide-up');
    }
    activateAnimations(); // Activar animaciones después de cargar el contenido
});
