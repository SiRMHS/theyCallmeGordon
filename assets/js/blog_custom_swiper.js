document.addEventListener("DOMContentLoaded", () => {
  new Swiper(".bcsw-slider", {
    slidesPerView: 1,
    spaceBetween: 25,
    loop: true,
    pagination: {
      el: ".bcsw-pagination",
      clickable: true,
    },

    breakpoints: {
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
    },
  });
});
