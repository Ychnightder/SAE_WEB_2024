// let i = 1;
// /**
//  * Génère un graphique avec les données et le type spécifié.
//  * @param {string} canvasId - ID du canvas HTML.
//  * @param {Array} allOptions - Liste complète des options possibles (labels).
//  * @param {Array} rawData - Données de la base (avec `reponse` et `count`).
//  * @param {string} chartType - Type de graphique ("bar", "pie", "doughnut", etc.).
//  * @param {string} question - Question à afficher au-dessus du graphique.
//  *//**
//  * Génère un graphique avec les données et le type spécifié.
//  * @param {string} canvasId - ID du canvas HTML.
//  * @param {Array} allOptions - Liste complète des options possibles (labels).
//  * @param {Array} rawData - Données de la base (avec `reponse` et `count`).
//  * @param {string} chartType - Type de graphique ("bar", "pie", "doughnut", etc.).
//  * @param {string} question - Question à afficher au-dessus du graphique.
//  */
// function generateChart(canvasId, allOptions, rawData, chartType, question) {
//   const canvas = document.getElementById(canvasId);
//   if (!canvas) return;
//
//   // Prépare les données pour le graphique
//   const mergedData = allOptions.map((option) => {
//     const match = rawData.find((data) => data.reponse === option.option_text);
//     return { reponse: option.option_text, count: match ? match.count : 0 };
//   });
//
//   const labels = mergedData.map((item) => item.reponse);
//   const data = mergedData.map((item) => item.count);
//
//   const ctx = canvas.getContext("2d");
//   new Chart(ctx, {
//     type: chartType,
//     data: {
//       labels: labels,
//       datasets: [
//         {
//           label: "Nombre de réponses",
//           data: data,
//           backgroundColor: [
//             "#FF6384",
//             "#36A2EB",
//             "#FFCE56",
//             "#4BC0C0",
//             "#9966FF",
//             "#FF9F40",
//             "#E7E9ED",
//           ],
//           borderColor: "#ccc",
//           borderWidth: 1,
//         },
//       ],
//     },
//     options: {
//       responsive: true,
//       maintainAspectRatio: false,
//       plugins: {
//         legend: {
//           display: chartType !== "bar",
//         },
//         tooltip: {
//           callbacks: {
//             label: function (context) {
//               return `${context.label}: ${context.raw}`;
//             },
//           },
//         },
//       },
//       scales: chartType === "bar" ? {
//         y: {
//           beginAtZero: true,
//           title: { display: true, text: "Nombre de réponses" },
//         },
//         x: {
//           title: { display: true, text: "Catégories" },
//         },
//       } : {},
//     },
//   });
// }
