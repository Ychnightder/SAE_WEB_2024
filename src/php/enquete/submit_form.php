<?php
session_start();
require_once __DIR__ . '/../config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $pdo = $db->connect();
    $reponses = $_POST['reponses']?? [];

    foreach ($reponses as $id_question => $reponse) {
        try {
            $query = $pdo->prepare("
            INSERT INTO Réponses (reponse, id_question, id_utilisateur)
            VALUES (:reponse, :id_question, :id_utilisateur)
        ");
            $query->execute([
                'reponse' => $reponse,
                'id_question' => $id_question,
                'id_utilisateur' => $_SESSION["userCurrent"]["id"] //$userId
            ]);
        } catch (PDOException $e) {
            echo "<pre>";
            echo "Error saving response for question : " . $e->getMessage();
            echo "</pre>";
        }
    }
    $update = $pdo->prepare("UPDATE utilisateurs SET has_participated = TRUE WHERE id_utilisateur = :id");
    $update->execute(['id' => $_SESSION["userCurrent"]["id"]]);
    header("Location: ./mainEnd.php");
}