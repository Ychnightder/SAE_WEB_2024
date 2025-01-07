document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById("questionSelect");
    const helper = document.getElementById("selectWidthHelper");

    function adjustSelectWidth() {
        const selectedOption = select.options[select.selectedIndex].text;
        helper.textContent = selectedOption;
        // Ajoutez un léger padding pour éviter un ajustement trop serré
        select.style.width = `${helper.offsetWidth + 20}px`;
    }

    // Ajuste la largeur au chargement initial et à chaque changement
    adjustSelectWidth();
    select.addEventListener("change", adjustSelectWidth);
});

function generateChart(canvasId, allOptions, rawData, chartType, question) {
  const allCanvases = document.querySelectorAll('.lesgraphs canvas');
  allCanvases.forEach((canvas) => {
    canvas.style.display = 'none'; // Masque tous les graphiques
  });

  // Afficher le graphique correspondant
  const canvas = document.getElementById(canvasId);
  if (!canvas) return; // Si le canvas n'existe pas, on arrête la fonction
  canvas.style.display = 'block';

  if (canvas.chart) {
    canvas.destroy();
  }

  // Prépare les données pour le graphique
  const mergedData = allOptions.map((option) => {
    const match = rawData.find((data) => data.reponse === option.option_text);
    return { reponse: option.option_text, count: match ? match.count : 0 };
  });

  const labels = mergedData.map((item) => item.reponse);
  const data = mergedData.map((item) => item.count);

  const ctx = canvas.getContext("2d");
  const chart = new Chart(ctx, {
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
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: chartType !== "bar",
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              return `${context.label}: ${context.raw}`;
            },
          },
        },
      },
      scales: chartType === "bar" ? {
        y: {
          beginAtZero: true,
          title: { display: true, text: "Nombre de réponses" },
        },
        x: {
          title: { display: true, text: "Catégories" },
        },
      } : {},
    },
  });


}
