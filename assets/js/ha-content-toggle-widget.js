document.addEventListener("DOMContentLoaded", function () {
  // Select toggle buttons and panels with the updated 'ha-' prefix
  const toggleButtons = document.querySelectorAll(
    ".ha-toggle-switch .ha-toggle-btn" /* Changed prefix to ha- */
  );
  const togglePanels = document.querySelectorAll(
    ".ha-toggle-content .ha-toggle-panel" /* Changed prefix to ha- */
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
      document.querySelector(`.ha-toggle-panel.${target}`).classList.add("active"); /* Changed prefix to ha- */
    });
  });
});
