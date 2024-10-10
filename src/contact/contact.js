const btnAll = document.querySelectorAll(".input-vs button");
btnAll.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();
    btnAll.forEach((button) => {
      const span = button.querySelector("span");
      span.innerHTML = "";
    });
    const span = btn.querySelector("span");
    span.innerHTML =
      '<svg width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
      '<path d="M4.66245 9.5002L0.387451 5.2252L1.4562 4.15645L4.66245 7.3627L11.5437 0.481445L12.6125 1.5502L4.66245 9.5002Z" fill="#D9D9D9"/>\n' +
      "</svg>\n";
  });
});



// Sélectionne tous les boutons de l'accordéon
const accordionHeaders = document.querySelectorAll('.accordion-header');
accordionHeaders.forEach(header => {
  header.addEventListener('click', () => {
    const accordionContent = header.nextElementSibling;
    accordionContent.classList.toggle('active');
    const icon = header.querySelector('.icon');
    if (accordionContent.classList.contains('active')) {
      icon.style.transform = 'rotate(180deg)'; 
    } else {
      icon.style.transform = 'rotate(0deg)'; 
    }
  });
});