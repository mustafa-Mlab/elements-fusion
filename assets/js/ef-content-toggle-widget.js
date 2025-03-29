document.addEventListener("DOMContentLoaded", function () {
  const toggleButtons = document.querySelectorAll(
    ".ef-toggle-switch .toggle-btn"
  );
  const togglePanels = document.querySelectorAll(
    ".ef-toggle-content .toggle-panel"
  );

  toggleButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const target = this.dataset.toggle;

      // Remove active class from all buttons and panels
      toggleButtons.forEach((btn) =>
        btn.setAttribute("aria-expanded", "false")
      );
      togglePanels.forEach((panel) => panel.classList.remove("active"));

      // Add active class to the selected button and panel
      this.setAttribute("aria-expanded", "true");
      document.querySelector(`.toggle-panel.${target}`).classList.add("active");
    });
  });
});
