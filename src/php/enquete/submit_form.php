<?php
require "../src/php/config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    $db = new Database();
    $pdo = $db->connect();
    $reponses = $_POST['reponses']?? [];

    foreach ($reponses as $id_question => $reponse) {
        try {
            // Prepare and execute the insert query
            $query = $pdo->prepare("
            INSERT INTO Réponses (reponse, id_question, id_utilisateur)
            VALUES (:reponse, :id_question, :id_utilisateur)
        ");
            $query->execute([
                'reponse' => $reponse,
                'id_question' => $id_question,
                'id_utilisateur' => 20
            ]);
        } catch (PDOException $e) {
            // Handle database errors
            echo "<pre>";
            echo "Error saving response for question : " . $e->getMessage();
            echo "</pre>";
        }
    }
}