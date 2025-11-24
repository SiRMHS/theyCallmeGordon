document.addEventListener("DOMContentLoaded", function() {
    new Swiper(".swiper", {
        direction: "vertical",
        speed: 800,
        parallax: true,
        centeredSlides: true,
        slidesPerView: "auto",
        spaceBetween: 4,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        }
    });
});
