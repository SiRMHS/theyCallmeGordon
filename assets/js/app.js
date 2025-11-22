/* Theme JS: initialize Swiper, basic Barba + GSAP transitions */
(function () {
    'use strict';

    function initSwiper() {
        if (typeof Swiper === 'undefined') return;
        // basic swiper init for elements with class 'swiper'
        document.querySelectorAll('.swiper').forEach(function (el) {
            new Swiper(el, {
                loop: true,
                pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
                navigation: { nextEl: el.querySelector('.swiper-button-next'), prevEl: el.querySelector('.swiper-button-prev') },
                slidesPerView: 1,
            });
        });
    }

    function initBarba() {
        if (typeof barba === 'undefined' && typeof Barba === 'undefined') return;
        var b = (typeof barba !== 'undefined') ? barba : (typeof Barba !== 'undefined' ? Barba : null);
        if (!b) return;

        b.init({
            transitions: [{
                name: 'fade-transition',
                leave(data) {
                    return gsap.to(data.current.container, { opacity: 0, duration: 0.35 });
                },
                enter(data) {
                    initSwiper();
                    return gsap.from(data.next.container, { opacity: 0, duration: 0.35 });
                }
            }]
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initSwiper();
        initBarba();
    });

})();
