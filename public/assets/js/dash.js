function showGraphButtons() {
  const questionSelect = document.getElementById("questionSelect");
  const graphButtons = document.getElementById("graphButtons");
  const graphBoxPie = document.getElementById("graphBoxPie");
  const graphBoxBar = document.getElementById("graphBoxBar");

  // Vérifier si une question a été sélectionnée
  if (questionSelect.value) {
    // Afficher les boutons de sélection des graphiques
    graphButtons.style.display = "block";
    graphBoxPie.style.display = "none";
    graphBoxBar.style.display = "none";
  } else {
    // Masquer les boutons de sélection des graphiques si aucune question n'est sélectionnée
    graphButtons.style.display = "none";
    graphBoxPie.style.display = "none";
    graphBoxBar.style.display = "none";
  }
}

function generatePieChart(label, data) {
  const graphBoxPie = document.getElementById("graphBoxPie");
  const graphBoxBar = document.getElementById("graphBoxBar");
  const pieChartCanvas = document.getElementById("pie-chart");
  const barChartCanvas = document.getElementById("bar-chart");

  graphBoxBar.style.display = "none";
  graphBoxPie.style.display = "block";
  barChartCanvas.style.display = "none";
  pieChartCanvas.style.display = "block";

  new Chart(pieChartCanvas, {
    type: "pie",
    data: {
      labels: ["Option 1", "Option 2", "Option 3"],
      datasets: [
        {
          label: "Répartition",
          data: [10, 30, 60],
          backgroundColor: ["#FF5733", "#33FF57", "#3357FF"],
          hoverOffset: 4,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "top",
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.label + ": " + tooltipItem.raw + " %";
            },
          },
        },
      },
    },
  });
}

function generateBarChart(label, data) {
  const graphBoxPie = document.getElementById("graphBoxPie");
  const graphBoxBar = document.getElementById("graphBoxBar");
  const pieChartCanvas = document.getElementById("pie-chart");
  const barChartCanvas = document.getElementById("bar-chart");

  graphBoxBar.style.display = "block";
  graphBoxPie.style.display = "none";
  barChartCanvas.style.display = "block";
  pieChartCanvas.style.display = "none";

  new Chart(barChartCanvas, {
    type: "bar",
    data: {
      labels: ["Option 1", "Option 2", "Option 3"],
      datasets: [
        {
          label: "Répartition",
          data: [10, 30, 60],
          backgroundColor: "#007bff",
          borderColor: "#0056b3",
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "top",
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.label + ": " + tooltipItem.raw + " %";
            },
          },
        },
      },
    },
  });
}

function generateBoth(label, data) {
  const graphBoxPie = document.getElementById("graphBoxPie");
  const graphBoxBar = document.getElementById("graphBoxBar");
  const pieChartCanvas = document.getElementById("pie-chart");
  const barChartCanvas = document.getElementById("bar-chart");

  graphBoxBar.style.display = "block";
  graphBoxPie.style.display = "block";
  barChartCanvas.style.display = "block";
  pieChartCanvas.style.display = "block";

  new Chart(barChartCanvas, {
    type: "bar",
    data: {
      labels: ["Option 1", "Option 2", "Option 3"],
      datasets: [
        {
          label: "Répartition",
          data: [10, 30, 60],
          backgroundColor: "#007bff",
          borderColor: "#0056b3",
          borderWidth: 1,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "top",
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.label + ": " + tooltipItem.raw + " %";
            },
          },
        },
      },
    },
  });
  new Chart(pieChartCanvas, {
    type: "pie",
    data: {
      labels: ["Option 1", "Option 2", "Option 3"],
      datasets: [
        {
          label: "Répartition",
          data: [10, 30, 60],
          backgroundColor: ["#FF5733", "#33FF57", "#3357FF"],
          hoverOffset: 4,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "top",
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.label + ": " + tooltipItem.raw + " %";
            },
          },
        },
      },
    },
  });
}
