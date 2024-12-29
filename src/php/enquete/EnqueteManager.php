<?php
require '../config/database.php';

class EnqueteManager
{
    private $pdo;
    public function  __construct() {
        $db = new database();
        $this->pdo = $db->connect(); // Assure-toi d'utiliser le bon nom de classe ici
    }
    public function chargerEnquete(): array
    {
        $stmt = $this->pdo->prepare("
        SELECT 
            q.id_questionnaire AS id_questionnaire,
            q.titre_ AS titre_questionnaire,
            qs.id_question AS id_question,
            qs.texte_question_ AS texte_question,
            qs.type_question AS type_question,
            o.id_option AS id_option,
            o.option_text AS texte_option
        FROM 
            questionnaires q
        LEFT JOIN 
            questions qs ON q.id_questionnaire = qs.id_questionnaire
        LEFT JOIN 
            options o ON qs.id_question = o.id_question
        ORDER BY 
            q.id_questionnaire, qs.id_question, o.id_option
    ");

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $enquetes = [];
        foreach ($result as $row) {
            $id_questionnaire = $row['id_questionnaire'];
            $id_question = $row['id_question'];
            $id_option = $row['id_option'];

            // Ajouter le questionnaire
            if (!isset($enquetes[$id_questionnaire])) {
                $enquetes[$id_questionnaire] = [
                    'titre' => $row['titre_questionnaire'],
                    'questions' => []
                ];
            }

            // Ajouter la question
            if ($id_question && !isset($enquetes[$id_questionnaire]['questions'][$id_question])) {
                $enquetes[$id_questionnaire]['questions'][$id_question] = [
                    'texte' => $row['texte_question'],
                    'type' => $row['type_question'],
                    'options' => []
                ];
            }

            // Ajouter l'option
            if ($id_option) {
                $enquetes[$id_questionnaire]['questions'][$id_question]['options'][] = $row['texte_option'];
            }
        }

        return $enquetes;
    }

}