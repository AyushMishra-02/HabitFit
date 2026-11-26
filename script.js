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

// Theme Toggle Logic
const themeToggles = document.querySelectorAll(".theme-toggle");
if (themeToggles.length > 0) {
  themeToggles.forEach(toggle => {
    toggle.addEventListener("click", () => {
      document.documentElement.classList.toggle("dark-theme");
      const isDark = document.documentElement.classList.contains("dark-theme");
      localStorage.setItem("theme", isDark ? "dark" : "light");
    });
  });
}

// Client-side Login Form Handler (prevents HTTP 405 POST on static hosts)
const loginForm = document.querySelector("#login-form");
if (loginForm) {
  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const emailInput = loginForm.querySelector("#email");
    const statusEl = document.querySelector("#login-status");
    const email = emailInput ? emailInput.value.trim() : "";
    if (email) {
      localStorage.setItem("habitfit_user", email);
    }
    if (statusEl) {
      statusEl.style.color = "#10b981";
      statusEl.textContent = "Signed in! Redirecting to your HabitFit plan...";
    }
    setTimeout(() => {
      window.location.href = "index.html";
    }, 800);
  });
}
