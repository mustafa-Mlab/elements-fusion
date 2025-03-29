document.addEventListener("DOMContentLoaded", function () {
  const countdown = document.querySelector(".ef-countdown-timer");
  const targetDate = new Date(countdown.dataset.date).getTime();
  const expiryAction = countdown.dataset.expiryAction;
  const expiryMessage = countdown.dataset.expiryMessage;
  const expiryRedirect = countdown.dataset.expiryRedirect;

  function updateCountdown() {
    const now = new Date().getTime();
    const distance = targetDate - now;

    if (distance < 0) {
      clearInterval(timer);

      if (expiryAction === "message") {
        countdown.innerHTML = `<div class="ef-countdown-expiry-message">${expiryMessage}</div>`;
      } else if (expiryAction === "redirect" && expiryRedirect) {
        window.location.href = expiryRedirect;
      }

      return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    countdown.querySelector("#days").textContent = days;
    countdown.querySelector("#hours").textContent = hours;
    countdown.querySelector("#minutes").textContent = minutes;
    countdown.querySelector("#seconds").textContent = seconds;
  }

  const timer = setInterval(updateCountdown, 1000);
  updateCountdown();
});
