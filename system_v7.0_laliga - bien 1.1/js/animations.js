// animations.js

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

document.addEventListener('DOMContentLoaded', activateAnimations);
document.addEventListener('scroll', activateAnimations);
