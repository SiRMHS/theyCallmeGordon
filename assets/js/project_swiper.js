const swiper = new Swiper(".swiper", {
  loop: true,
  centeredSlides: true,
  slidesPerView: "auto",
  spaceBetween: 28,
  grabCursor: true,
  speed: 600,
  rtl: true,
  rtlTranslate: true,
});

document.getElementById("prevBtn").addEventListener("click", () => {
  swiper.slidePrev();
});

و;
document.getElementById("nextBtn").addEventListener("click", () => {
  swiper.slideNext();
});
