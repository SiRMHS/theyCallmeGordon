(function ($) {
  gsap.registerPlugin(MotionPathPlugin);
  $(window).on("elementor/frontend/init", function () {
    var scope = $(".box");
    scope.each(function () {
      const box = $(this)[0];
      const light = box.querySelector(".light");

      if (!light || !box) {
        console.error(
          "GSAP setup failed: .light or .box not found in this scope.",
        );
        return;
      }

      gsap.set(light, { opacity: 0 });

      const spin = gsap.to(light, {
        motionPath: {
          path: [
            { x: -80, y: -80 },
            { x: 80, y: -80 },
            { x: 80, y: 80 },
            { x: -80, y: 80 },
            { x: -80, y: -80 },
          ],
          curviness: 1,
          autoRotate: false,
        },
        duration: 2,
        repeat: -1,
        ease: "none",
        paused: true,
      });

      box.addEventListener("mouseenter", () => {
        gsap.to(light, { opacity: 1, duration: 0.3 });
        spin.play();
      });

      box.addEventListener("mouseleave", () => {
        gsap.to(light, { opacity: 0, duration: 0.3 });
        spin.pause();
      });
    });
  });
})(jQuery);
