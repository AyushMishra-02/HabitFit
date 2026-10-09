const tracker = document.querySelector("#tracker");
const result = document.querySelector("#tracker-result");

if (tracker && result) {
  const buttons = [...tracker.querySelectorAll("button")];

  const updateResult = () => {
    const count = buttons.filter((button) => button.getAttribute("aria-pressed") === "true").length;
    const message = count === 0
      ? "0 of 7 days marked. Pick one easy win."
      : count < 3
        ? `${count} of 7 days marked. Momentum is starting.`
        : count < 5
          ? `${count} of 7 days marked. That is a solid week.`
          : `${count} of 7 days marked. Strong consistency.`;

    result.textContent = message;
  };

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const isPressed = button.getAttribute("aria-pressed") === "true";
      button.setAttribute("aria-pressed", String(!isPressed));
      updateResult();
    });
  });
}

// Scroll Reveal Animations
const revealElements = document.querySelectorAll("[data-reveal]");

const revealObserver = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("revealed");
      observer.unobserve(entry.target);
    }
  });
}, {
  root: null,
  threshold: 0.15,
  rootMargin: "0px 0px -50px 0px"
});

revealElements.forEach(el => revealObserver.observe(el));

// Back to Top Button
const backToTopBtn = document.querySelector(".back-to-top");
if (backToTopBtn) {
  window.addEventListener("scroll", () => {
    if (window.scrollY > 400) {
      backToTopBtn.classList.add("visible");
    } else {
      backToTopBtn.classList.remove("visible");
    }
  });

  backToTopBtn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}
