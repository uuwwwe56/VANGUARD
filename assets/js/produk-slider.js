// ===============================
// SLIDE PRODUK (DRAG SCROLL)
// ===============================
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".card-slider").forEach((slider) => {
    let isDown = false;
    let startX = 0;
    let scrollLeft = 0;
    let isDragging = false;

    slider.addEventListener("mousedown", (e) => {
      isDown = true;
      isDragging = false;
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
      slider.classList.add("dragging");
    });

    slider.addEventListener("mouseleave", () => {
      isDown = false;
      slider.classList.remove("dragging");
    });

    slider.addEventListener("mouseup", () => {
      isDown = false;
      slider.classList.remove("dragging");
      setTimeout(() => (isDragging = false), 50);
    });

    slider.addEventListener("mousemove", (e) => {
      if (!isDown) return;
      e.preventDefault();
      isDragging = true;

      const x = e.pageX - slider.offsetLeft;
      const walk = (x - startX) * 1.5;
      slider.scrollLeft = scrollLeft - walk;
    });

    // Mencegah klik saat drag
    slider.querySelectorAll("a, button").forEach((el) => {
      el.addEventListener("click", function (e) {
        if (isDragging) {
          e.preventDefault();
          e.stopImmediatePropagation();
        }
      });
    });
  });

  // ===============================
  // BOOTSTRAP POPOVER
  // ===============================
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {
    new bootstrap.Popover(el);
  });
});
