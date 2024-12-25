<?php

global $pdo;
require "../src/php/views/headerDash.php";

?>
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

</main>
<script type="module" src="./assets/js/dash.js"></script>
</body>
</html>
