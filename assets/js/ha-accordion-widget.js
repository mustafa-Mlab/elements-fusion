document.addEventListener("DOMContentLoaded", function () {
  const accordions = document.querySelectorAll(".ha-accordion");

  accordions.forEach((accordion) => {
    const accordionItems = accordion.querySelectorAll(".ha-accordion-item");

    accordionItems.forEach((item) => {
      const title = item.querySelector(".ha-accordion-title");

      title.addEventListener("click", () => {
        accordionItems.forEach((otherItem) => {
          if (otherItem !== item) {
            otherItem.classList.remove("active");
            otherItem.querySelector(".ha-accordion-content").style.display =
              "none";
          }
        });

        // Toggle the clicked item
        const isActive = item.classList.contains("active");
        if (isActive) {
          item.classList.remove("active");
          item.querySelector(".ha-accordion-content").style.display = "none";
        } else {
          item.classList.add("active");
          item.querySelector(".ha-accordion-content").style.display = "block";
        }
      });
    });
  });
});
