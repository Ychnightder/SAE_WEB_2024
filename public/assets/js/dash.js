let i = 1;
/**
 * Génère un graphique avec les données et le type spécifié.
 * @param {string} canvasId - ID du canvas HTML.
 * @param {Array} allOptions - Liste complète des options possibles (labels).
 * @param {Array} rawData - Données de la base (avec `reponse` et `count`).
 * @param {string} chartType - Type de graphique ("bar", "pie", "doughnut", etc.).
 * @param {string} question - Question à afficher au-dessus du graphique.
 */
function generateChart(canvasId, allOptions, rawData, chartType, question) {
  // Crée l'élément de la question dynamiquement
  const canvas = document.getElementById(canvasId);
  const parentDiv = canvas.parentElement;
  // Vérifie si un titre existe déjà, sinon l'ajoute
  let questionElement = parentDiv.querySelector(".chart-question");
  if (!questionElement) {
    questionElement = document.createElement("h3");
    questionElement.classList.add(`chart-question-${i++}`);
    parentDiv.insertBefore(questionElement, canvas);
  }
  questionElement.textContent = question;

  // Prépare les données pour le graphique
  const mergedData = allOptions.map((option) => {
    const match = rawData.find((data) => data.reponse === option.option_text);
    return { reponse: option.option_text, count: match ? match.count : 0 };
  });

  const labels = mergedData.map((item) => item.reponse);
  const data = mergedData.map((item) => item.count);

  const ctx = canvas.getContext("2d");
  new Chart(ctx, {
    type: chartType,
    data: {
      labels: labels,
      datasets: [
        {
          label: "Nombre de réponses",
          data: data,
          backgroundColor: [
            "#FF6384",
            "#36A2EB",
            "#FFCE56",
            "#4BC0C0",
            "#9966FF",
            "#FF9F40",
            "#E7E9ED",
          ],
          borderColor: "#ccc",
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: chartType !== "bar",
          position: "top",
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              return `${context.label}: ${context.raw}`;
            },
          },
        },
      },
      scales:
        chartType === "bar"
          ? {
              y: {
                beginAtZero: true,
                title: {
                  display: true,
                  text: "Nombre de réponses",
                },
              },
              x: {
                title: {
                  display: true,
                  text: "Catégories",
                },
              },
            }
          : {},
    },
  });
}

// Q1
generateChart("pieChart-1", allOptionsAge, dataAge, "doughnut", questionAge);
generateChart("pieChart-2", allOptionsSex, dataSex, "pie", questionSex);
// //Q3
generateChart(
  "BarChart-1",
  allOptionsInsertion,
  dataInsertion,
  "bar",
  questionInsertion,
);
generateChart(
  "BarChart-2",
  allOptionsRecevez,
  dataRecevez,
  "bar",
  questionRecevez,
);
//Q2
generateChart("myChart-1", allOptionsRegion, dataRegion, "bar", questionRegion);
