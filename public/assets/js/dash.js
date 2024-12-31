import * as d3 from "https://cdn.jsdelivr.net/npm/d3@7/+esm";


// Dimensions du graphique
const width = 400;
const height = 400;
const radius = Math.min(width, height) / 2;

// Sélectionner l'élément SVG où le graphique sera dessiné
const svg = d3.select("#pie-chart")
    .append("svg")
    .attr("width", width)
    .attr("height", height)
    .append("g")
    .attr("transform", `translate(${width / 2},${height / 2})`);

// Palette de couleurs
const color = d3.scaleOrdinal(d3.schemeCategory10);

// Fonction pie pour transformer les données en format adapté à un graphique en camembert
const pie = d3.pie().value(d => d.count); // 'count' représente les valeurs à afficher dans le camembert

// Arc pour dessiner les secteurs
const arc = d3.arc().outerRadius(radius - 10).innerRadius(0);
const arcOver = d3.arc().outerRadius(radius).innerRadius(0);

// Sélectionner les groupes de secteurs et les ajouter à l'élément SVG
const g = svg.selectAll(".arc")
    .data(pie(ageData)) // Utiliser les données transformées par la fonction pie
    .enter()
    .append("g")
    .attr("class", "arc")
    .on("mouseover", function(event, d) {
        d3.select(this).select("path").transition().duration(200).attr("d", arcOver);
    })
    .on("mouseout", function(event, d) {
        d3.select(this).select("path").transition().duration(200).attr("d", arc);
    });

// Dessiner les secteurs
g.append("path")
    .attr("d", arc)
    .style("fill", d => color(d.data.reponse)); // Utilisation de la réponse pour colorer le secteur

// Ajouter les labels à chaque secteur
g.append("text")
    .attr("transform", d => "translate(" + arc.centroid(d) + ")")
    .attr("dy", ".35em")
    .style("text-anchor", "middle")
    .text(d => d.data.reponse); // Affichage de la réponse dans le secteur
// ---------------------------- barre




// Dimensions du graphique
const width2 = 500;
const height2 = 300;

// Créer l'élément SVG
const svg2 = d3.select("#bar-chart")
    .append("svg")
    .attr("width", width)
    .attr("height", height);

// Définir l'échelle des barres (sur l'axe Y) et des labels (sur l'axe X)
const x = d3.scaleBand()
    .domain(sexeData.map(d => d.sexe))
    .range([0, width])
    .padding(0.1);

const y = d3.scaleLinear()
    .domain([0, d3.max(sexeData, d => d.count)])
    .nice() // Pour arrondir les valeurs
    .range([height, 0]);

// Ajouter l'axe X (horizontal) et l'axe Y (vertical)
svg2.append("g")
    .selectAll(".bar")
    .data(sexeData)
    .enter()
    .append("rect")
    .attr("class", "bar")
    .attr("x", d => x(d.sexe))
    .attr("y", d => y(d.count))
    .attr("width", x.bandwidth())
    .attr("height", d => height - y(d.count))
    .style("fill", "steelblue");

// Ajouter l'axe X (horizontal)
svg2.append("g")
    .attr("transform", `translate(0,${height})`)
    .call(d3.axisBottom(x));

// Ajouter l'axe Y (vertical)
svg2.append("g")
    .call(d3.axisLeft(y));

// Ajouter des labels sur chaque barre
svg2.selectAll(".label")
    .data(sexeData)
    .enter()
    .append("text")
    .attr("class", "label")
    .attr("x", d => x(d.sexe) + x.bandwidth() / 2)
    .attr("y", d => y(d.count) - 5)
    .attr("text-anchor", "middle")
    .text(d => d.count);
