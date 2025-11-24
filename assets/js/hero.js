const beams = document.querySelectorAll(".light-beam");

beams.forEach((beam) => {
  const length = beam.getTotalLength();
  const beamLength = 150;

  gsap.set(beam, {
    strokeDasharray: `${beamLength} ${length}`,
    opacity: 1,
  });

  gsap.fromTo(
    beam,
    {
      strokeDashoffset: -beamLength,
    },
    {
      strokeDashoffset: length,

      duration: 3,
      repeat: -1,
      ease: "power1.inOut",
      repeatDelay: 0.5,
    },
  );
});
