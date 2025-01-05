<?php

namespace config;
use config\BDDConnect;
use Exception;
use PDO;
use PDOException;
use user\User;
require_once "BDDConnect.php";
require_once "../src/php/user/User.php";

class BDDRequetes {

    public PDO $pdo;
    public function __construct() {
        $bddConnect = new BDDConnect(__DIR__ . '/database');
        $this->pdo = $bddConnect->connexion();
    }

    public function insertUser(User $user) : bool {

        $sql = "INSERT INTO Utilisateurs(email, nom, prenom, password, adresse, telephone, est_adherent, date_inscription, idVille)
            VALUES(:email, :nom, :prenom, :password, :adresse, :telephone, :est_adherent, :currentdate, :idVille)";
        $stmt = $this->pdo->prepare($sql);
        $email = $user->getEmail();
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $password = $user->getPassword();
        $adresse = $user->getAdresse();
        $telephone = $user->getTelephone();
        $est_adherent = $user->isAdherent();
        $currentdate = date('Y-m-d H:i:s');;
        $idVille = $user->getIdVille();
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':est_adherent', $est_adherent);
        $stmt->bindParam(':currentdate', $currentdate);
        $stmt->bindParam(':idVille', $idVille);

        try {
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Inscription réussie !";
                return true;

            } else {
                $_SESSION['register_errors'] = "Erreur lors de l'inscription.";
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['register_errors'] = "Erreur de base de données : " . $e->getMessage();
            return false;
        }
    }

     function getUser(string $email): User {
        $sql = "SELECT *
            FROM Utilisateurs
            WHERE email = :email
            LIMIT 1";


        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new User(
                    nom: $result['nom'],
                    prenom: $result['prenom'],
                    email: $result['email'],
                    password: $result['password'],
                    adresse: $result['adresse'],
                    telephone: $result['telephone'],
                    idVille: $result['idVille'],
                    dateInscription: $result['date_inscription'],
                    adherent: $result['est_adherent']
                );
            } else {
                throw new Exception("Utilisateur avec l'email $email non trouvé.");
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
        }
    }


    function userExist(string $email): bool {
        $sql = "SELECT COUNT(*) as total
            FROM Utilisateurs
            WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function getIdVille(string $ville): int {
        $sql = "SELECT idVille
            FROM Ville
            WHERE nomville = :nomville";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nomville', $ville, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['idVille'];
            } else {
                throw new Exception("La ville $ville n'a pas été trouvé");
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de la ville : " . $e->getMessage());
        }
    }

    public function loadQuestions(int $step): array {
        $query = $this->pdo->prepare("
            SELECT Questions.texte_question_, Questions.type_question, Questions.id_question
            FROM Questions
            INNER JOIN Questionnaires ON Questions.id_questionnaire = Questionnaires.id_questionnaire
            WHERE Questionnaires.id_questionnaire = :step
        ");
        $query->execute(['step' => $step]);
        return $query->fetchAll();
    }

    function getTotalSteps() {
        $query = $this->pdo->prepare("SELECT COUNT(*) as total FROM Questionnaires");
        $query->execute();
        return (int) $query->fetch()['total'];
    }

    public function getOptions(int $idQuestion): array {
        $query = $this->pdo->prepare("SELECT * FROM Options WHERE id_question = :id_question");
        $query->execute(['id_question' => $idQuestion]);
        return $query->fetchAll();
    }

    function getOptionIdByText($optionText): int {
        $sql = "SELECT id_option FROM Options WHERE option_text = :optionText";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':optionText', $optionText, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn(); // Retourne directement l'ID
    }

    function insertReponse($id_option, $id_question, $emailUser): bool {
        $queryCheck = $this->pdo->prepare("
        SELECT COUNT(*) 
        FROM Reponses
        WHERE id_question = :id_question AND emailUser = :emailUser
    ");
        $queryCheck->bindParam(':id_question', $id_question, PDO::PARAM_INT);
        $queryCheck->bindParam(':emailUser', $emailUser, PDO::PARAM_STR);
        $queryCheck->execute();

        if ($queryCheck->fetchColumn() > 0) {
            $queryUpdate = $this->pdo->prepare("
            UPDATE Reponses
            SET id_option = :id_option
            WHERE id_question = :id_question AND emailUser = :emailUser
        ");
            $queryUpdate->bindParam(':id_option', $id_option, PDO::PARAM_INT);
            $queryUpdate->bindParam(':id_question', $id_question, PDO::PARAM_INT);
            $queryUpdate->bindParam(':emailUser', $emailUser, PDO::PARAM_STR);
            return $queryUpdate->execute();
        } else {
            $queryInsert = $this->pdo->prepare("
            INSERT INTO Reponses (id_option, id_question, emailUser)
            VALUES (:id_option, :id_question, :emailUser)
        ");
            $queryInsert->bindParam(':id_option', $id_option, PDO::PARAM_INT);
            $queryInsert->bindParam(':id_question', $id_question, PDO::PARAM_INT);
            $queryInsert->bindParam(':emailUser', $emailUser, PDO::PARAM_STR);
            return $queryInsert->execute();
        }
    }

    //Recupère les réponses de chaque question, de chaque formulaire pour un utilisateur
    function getReponseByUser($emailUser): array {
        $query = $this->pdo->prepare("
            SELECT q.texte_question_ AS question_text, o.option_text, qn.titre_ AS questionnaire_title
            FROM Reponses r
            INNER JOIN Questions q ON r.id_question = q.id_question
            INNER JOIN Options o ON r.id_option = o.id_option
            INNER JOIN Questionnaires qn ON q.id_questionnaire = qn.id_questionnaire
            WHERE r.emailUser = :emailUser
        ");
        $query->bindParam(':emailUser', $emailUser, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

    function getAllQuestionnaires(): array {
        $sql = "SELECT * FROM Questionnaires";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getAllQuestionForQuestionnaire($idQuestionnaire): array {
        $sql = "SELECT * FROM Questions WHERE id_questionnaire = :idQuestionnaire";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idQuestionnaire', $idQuestionnaire, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getReponse(int $idQuestion): array {
        $query = $this->pdo->prepare("SELECT * FROM Reponses WHERE id_question = :id_question");
        $query->execute(['id_question' => $idQuestion]);
        return $query->fetchAll();
    }

    function adminExist(string $email): bool {
        $sql = "SELECT *
            FROM Admin
            WHERE email = :email
            LIMIT 1";


        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return true;
            } else {
                throw new Exception("Admin avec l'email $email non trouvé.");
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
        }
    }

    public function getPasswordAdmin(string $email): string {
        $sql = "SELECT password FROM Admin WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Récupérer le mot de passe
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification si un résultat est trouvé
        if (!$result) {
            throw new Exception("Aucun administrateur trouvé avec cet email.");
        }

        return $result['password'];
    }



//
//    //Récupère le texte d'une question
//    function getQuestionById($idQuestion): array {
//        $query = $this->pdo->prepare("SELECT q.texte_question_ FROM Questions q WHERE id_question = :idQuestion");
//        $query->bindParam(':idQuestion', $idQuestion, PDO::PARAM_INT);
//        $query->execute();
//        return $query->fetchAll();
//    }

//    //Récupère toutes les options d'une question
//    function getAllOptionForQuestion($idQuestion): array {
//        $query = $this->pdo->prepare("SELECT * FROM Options WHERE id_question = :idQuestion");
//        $query->bindParam(':idQuestion', $idQuestion, PDO::PARAM_INT);
//        $query->execute();
//        return $query->fetchAll();
//    }
//
//    // Récupère le nombre de réponses pour chaque option d'une question
//    function getResponseCountByOption($idQuestion): array {
//        // Requête pour récupérer les options et le nombre de réponses associées
//        $query = $this->pdo->prepare("
//        SELECT o.option_text, COUNT(r.id_reponse) as response_count
//        FROM Reponses r
//        INNER JOIN Options o ON r.id_option = o.id_option
//        WHERE r.id_question = :idQuestion
//        GROUP BY r.id_option
//    ");
//        $query->bindParam(':idQuestion', $idQuestion, PDO::PARAM_INT);
//        $query->execute();
//
//        // Retourner les résultats sous forme de tableau associatif
//        return $query->fetchAll(PDO::FETCH_ASSOC);
//    }
//
//    // Récupère le texte de la question et les options
//    function getQuestionAndOptions($idQuestion): array {
//        // Récupérer le texte de la question
//        $question = $this->getQuestionById($idQuestion);
//
//        // Récupérer les options disponibles pour cette question
//        $options = $this->getAllOptionForQuestion($idQuestion);
//
//        return ['question' => $question, 'options' => $options];
//    }



}