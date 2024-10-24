const hamburger = document.querySelector(".nav .hamburger");
const closeIcon = document.querySelector(".close-icon");
const menuIcon = document.querySelector(".menu-icon");
const navLinks = document.querySelector(".nav-links");
const ctaBtn = document.querySelector(".cta-buttons");
const navButtons = document.querySelectorAll(".with-submenu ");

hamburger?.addEventListener("click", () => {
  navLinks.classList.toggle("active");
  ctaBtn.classList.toggle("active");
  const isMenuActive =
    navLinks.classList.contains("active") ||
    ctaBtn.classList.contains("active");
  menuIcon.style.display = isMenuActive ? "none" : "block";
  closeIcon.style.display = isMenuActive ? "block" : "none";
});

navButtons.forEach((button) => {
  button.addEventListener("click", (event) => {
    event.preventDefault();

    const clickedSubmenu = button.querySelector(".submenu");
    const arrow = button.querySelector("svg");
    navButtons.forEach((btn) => {
      const otherSubmenu = btn.querySelector(".submenu");
      const otherArrow = btn.querySelector("svg");
      if (otherSubmenu && otherSubmenu !== clickedSubmenu) {
        otherSubmenu.classList.remove("active");
        otherArrow.classList.remove("rotate");
      }
    });

    clickedSubmenu.classList.toggle("active");
    arrow.classList.toggle("rotate");
  });
});
