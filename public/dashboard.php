<?php
require "../src/php/views/headerDash.php";
require_once "../src/php/helpers/fonction.php";
require "../src/php/config/database.php";
$db = new Database();
$pdo = $db->connect();
$ageData = $db->chargerReponse($pdo,1);
$sexeData = $db->chargerReponse($pdo,2);

?>
<script>
    <?php
    convertirEnJS("ageData", $ageData);
    convertirEnJS("sexeData ",$sexeData);
    ?>
</script>
<header>
    <h1>Dashboard</h1>
</header>

<main>
    <!-- Première boîte avec un graphique -->
    <div class="box">
        <h2>Graphique Camembert</h2>
        <div id="pie-chart"></div>
    </div>

    <!-- Deuxième boîte avec un graphique -->
    <div class="box">
        <h2>Graphique en Barres</h2>
        <div id="bar-chart"></div>
    </div>
    <div class="box">
        <h2>Tableaux</h2>
        <div id="tab-chart"></div>
    </div>

</main>


<script type="module" src="./assets/js/dash.js"></script>


