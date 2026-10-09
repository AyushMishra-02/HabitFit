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
