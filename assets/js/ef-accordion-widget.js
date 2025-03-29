document.addEventListener("DOMContentLoaded", function () {
  const accordions = document.querySelectorAll(".elements-fusion-accordion");

  accordions.forEach((accordion) => {
    const accordionItems = accordion.querySelectorAll(".accordion-item");

    accordionItems.forEach((item) => {
      const title = item.querySelector(".accordion-title");

      title.addEventListener("click", () => {
        // Close all other items in this specific accordion
        accordionItems.forEach((otherItem) => {
          if (otherItem !== item) {
            otherItem.classList.remove("active");
            otherItem.querySelector(".accordion-content").style.display =
              "none";
          }
        });

        // Toggle the clicked item
        const isActive = item.classList.contains("active");
        if (isActive) {
          item.classList.remove("active");
          item.querySelector(".accordion-content").style.display = "none";
        } else {
          item.classList.add("active");
          item.querySelector(".accordion-content").style.display = "block";
        }
      });
    });
  });
});
