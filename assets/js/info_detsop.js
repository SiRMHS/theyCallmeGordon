const beamsm = document.querySelectorAll(".md");

beamsm.forEach((beamm) => {
  const lengthm = beamm.getTotalLength();
  const beamLengthm = 150;

  gsap.set(beamm, {
    strokeDasharray: `${beamLengthm} ${lengthm}`,
    opacity: 1,
  });

  let tl = gsap.timeline({
    repeat: -1,
    repeatDelay: 0.5,
  });
  tl.fromTo(
    beamm,
    {
      strokeDashoffset: -beamLengthm,
    },
    {
      strokeDashoffset: lengthm,

      duration: 2,
      ease: "power1.inOut",
      repeatDelay: 0.5,
    },
    1,
  );
  tl.fromTo(
    ".cer",
    {
      transformOrigin: "50% 50%",

      scale: 0.1,
      opacity: 1,
    },
    {
      transformOrigin: "50% 50%",
      scale: 3,
      opacity: 0,
      duration: 2,
      ease: "power1.out",
    },
    2,
  );
});
