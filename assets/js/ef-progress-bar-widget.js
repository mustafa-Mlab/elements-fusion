document.addEventListener("DOMContentLoaded", function () {
  const bars = document.querySelectorAll(".ef-progress-bar-fill");
  bars.forEach((bar) => {
    const width = bar.style.width;
    bar.style.width = "0";
    setTimeout(() => {
      bar.style.transition = "width 1s ease-in-out";
      bar.style.width = width;
    }, 100);
  });
});
