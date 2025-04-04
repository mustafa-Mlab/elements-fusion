document.addEventListener("DOMContentLoaded", function () {
  // Select all progress bars with the updated 'ha-' prefix
  const bars = document.querySelectorAll(".ha-progress-bar-fill"); /* Changed prefix to ha- */
  
  bars.forEach((bar) => {
    const width = bar.style.width;
    bar.style.width = "0";
    setTimeout(() => {
      bar.style.transition = "width 1s ease-in-out";
      bar.style.width = width;
    }, 100);
  });
});
