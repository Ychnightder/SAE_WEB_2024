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

  const width = 500;
  const height = 300;
  const margin = { top: 40, right: 20, bottom: 50, left: 50 };

  // Supprime l'ancien graphique s'il existe
  d3.select(`#${canvasId}`).select("svg").remove();

  const svg = d3
    .select(`#${canvasId}`)
    .append("svg")
    .attr("width", width)
    .attr("height", height);

  const chartWidth = width - margin.left - margin.right;
  const chartHeight = height - margin.top - margin.bottom;

  const chart = svg
    .append("g")
    .attr("transform", `translate(${margin.left}, ${margin.top})`);

  const xScale = d3
    .scaleBand()
    .domain(mergedData.map((d) => d.reponse))
    .range([0, chartWidth])
    .padding(0.2);

  const yScale = d3
    .scaleLinear()
    .domain([0, d3.max(mergedData, (d) => d.count)])
    .nice()
    .range([chartHeight, 0]);

  // Ajout des axes
  chart
    .append("g")
    .attr("transform", `translate(0, ${chartHeight})`)
    .call(d3.axisBottom(xScale))
    .selectAll("text")
    .attr("transform", "rotate(-45)")
    .style("text-anchor", "end");

  chart.append("g").call(d3.axisLeft(yScale));

  if (chartType === "bar") {
    // Création des barres
    chart
      .selectAll(".bar")
      .data(mergedData)
      .enter()
      .append("rect")
      .attr("class", "bar")
      .attr("x", (d) => xScale(d.reponse))
      .attr("y", (d) => yScale(d.count))
      .attr("width", xScale.bandwidth())
      .attr("height", (d) => chartHeight - yScale(d.count))
      .attr("fill", "#36A2EB");
  } else if (chartType === "pie" || chartType === "doughnut") {
    // Configuration pour les graphiques en camembert
    const radius = Math.min(chartWidth, chartHeight) / 2;
    const pieGroup = chart
      .append("g")
      .attr("transform", `translate(${chartWidth / 2}, ${chartHeight / 2})`);

    const pie = d3.pie().value((d) => d.count)(mergedData);

    const arc = d3
      .arc()
      .innerRadius(chartType === "doughnut" ? radius / 2 : 0)
      .outerRadius(radius);

    const color = d3
      .scaleOrdinal()
      .domain(mergedData.map((d) => d.reponse))
      .range(d3.schemeCategory10);

    pieGroup
      .selectAll("path")
      .data(pie)
      .enter()
      .append("path")
      .attr("d", arc)
      .attr("fill", (d) => color(d.data.reponse))
      .append("title")
      .text((d) => `${d.data.reponse}: ${d.data.count}`);
  }
}
