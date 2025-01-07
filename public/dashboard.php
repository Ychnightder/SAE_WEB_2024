<?php
session_start();
require "../src/php/views/headerDash.php";
use Pierr\SaeWeb\php\Database\Database;
require_once "../src/php/helpers/fonction.php";
require  '../vendor/autoload.php';
$db = new Database();
$pdo = $db->connect();
$questions = $db->chargerLesQuestions($pdo);

// Charger toutes les questions pour le menu déroulant
$questions = $db->chargerLesQuestions($pdo);

// Vérifier si une question est sélectionnée
$questionId = isset($_GET['question_id']) ? intval($_GET['question_id']) : null;
$questionText = null;
$options = [];
$responses = [];

if ($questionId) {
    $questionText = $db->ChargerTexteQuestion($pdo, $questionId);
    $options = $db->chargerLesOptions($pdo, $questionId);
    $responses = $db->chargerReponse($pdo, $questionId);
}

?>
<script>
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

    console.log("Script chargé : generateChart disponible ?", typeof generateChart === "function");

</script>

<header>
  <div class="logo">
      <h1>Dashboard</h1>
  </div>
    <div class="filtre">
        <form action="dashboard.php" method="get">
            <div class="box" id="questionBox">
                <label for="questionSelect">Sélectionner une Question</label>
                <select id="questionSelect" name="question_id" onchange="this.form.submit()">
                    <option value="" >Choisir une question</option>
                    <?php foreach ($questions as $question): ?>
                        <?php if ($question['type_question'] !== "textarea"): ?>
                            <option value="<?php echo $question['id_question']; ?>" <?php echo $questionId == $question['id_question'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($question['texte_question']); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
        <span id="selectWidthHelper" style="position: absolute; visibility: hidden; white-space: nowrap;"></span>
    </div>
    <div class="logout">
        <a href="index.php">Déconnexion</a>
    </div>
</header>

<main>
    <?php if ($questionId): ?>
        <h2 class="questionSelectionner"><?php echo htmlspecialchars($questionText); ?></h2>
        <div id="graphButtons">
            <h3>Choisir le Type de Graphique</h3>
            <div class="btn-all">
            <button class="btn-pie-chart" type="button" onclick="generateChart('pie-chart', allOptions, data, 'pie', question)">Graphique Camembert</button>
            <button class="btn-bar-chart" type="button" onclick="generateChart('bar-chart', allOptions, data, 'bar', question)">Graphique en Barres</button>
            <button class="btn-doughnut-chart" type="button" onclick="generateChart('doughnut-chart', allOptions, data, 'doughnut', question)">Graphique Doughnut</button>
            </div>
        </div>
    <div class="lesgraphs">
        <canvas style="display: none" id="pie-chart"></canvas>
        <canvas style="display: none" id="bar-chart"></canvas>
        <canvas style="display: none" id="doughnut-chart"></canvas>
    </div>
    <?php else: ?>
        <p>Veuillez sélectionner une question pour afficher un graphique.</p>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

