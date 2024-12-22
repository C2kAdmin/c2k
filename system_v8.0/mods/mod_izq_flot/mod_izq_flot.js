document.addEventListener("DOMContentLoaded", function() {
    const modIzqFlot = document.querySelector('.mod_izq_flot');
    const containerSecund = document.querySelector('.left-column_secun');

    function updatePosition() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const containerTop = containerSecund.getBoundingClientRect().top + window.pageYOffset;
        const containerHeight = containerSecund.offsetHeight;
        const modHeight = modIzqFlot.offsetHeight;
        const containerBottom = containerTop + containerHeight;
        const viewportHeight = window.innerHeight;

        const columnWidth = document.querySelector('.left-column_ppal').offsetWidth;

        modIzqFlot.style.width = `${columnWidth}px`;

        if (scrollTop >= containerTop && scrollTop + viewportHeight <= containerBottom) {
            modIzqFlot.style.position = 'fixed';
            modIzqFlot.style.top = '10px';
        } else if (scrollTop + viewportHeight > containerBottom) {
            modIzqFlot.style.position = 'absolute';
            modIzqFlot.style.top = `${containerHeight - modHeight}px`;
        } else {
            modIzqFlot.style.position = 'absolute';
            modIzqFlot.style.top = '0';
        }
    }

    window.addEventListener('scroll', updatePosition);
    window.addEventListener('resize', updatePosition);
    updatePosition();
});
