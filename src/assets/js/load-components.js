// // Load header
//
// import { header } from "src/assets/js/shared-js/header ";
//
// function getPathPrefix() {
//   // Get the current path
//   const currentPath = window.location.pathname;
//
//   // Check if we're in a subdirectory
//   if (
//     currentPath.includes("/contact/") ||
//     currentPath.endsWith("/contact.html") ||
//     currentPath.includes("/adhesion-connexion/") ||
//     currentPath.endsWith("/adhesion-connexion.html")
//   ) {
//     return "../"; // Go up one level
//   }
//
//   return "./"; // Stay in current directory
// }
//
// function loadHeader() {
//   const pathPrefix = getPathPrefix();
//   return fetch(`${pathPrefix}Test-html/header.html`)
//     .then((response) => {
//       if (!response.ok) {
//         throw new Error(`HTTP error! status: ${response.status}`);
//       }
//       return response.text();
//     })
//     .then((data) => {
//       document.getElementById("header-placeholder").innerHTML = data;
//       header();
//     })
//     .catch((error) => console.error("Header loading error:", error));
// }
//
// // Load footer
//
// function loadFooter() {
//   const pathPrefix = getPathPrefix();
//   return fetch(`${pathPrefix}Test-html/footer.html`)
//     .then((response) => {
//       if (!response.ok) {
//         throw new Error(`HTTP error! status: ${response.status}`);
//       }
//       return response.text();
//     })
//     .then((data) => {
//       document.getElementById("footer-placeholder").innerHTML = data;
//     })
//     .catch((error) => console.error("Footer loading error:", error));
// }
//
// document.addEventListener("DOMContentLoaded", function () {
//   loadHeader();
//   loadFooter();
// });
