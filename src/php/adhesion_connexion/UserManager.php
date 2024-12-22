<?php
namespace adhesion_connexion;

use Database;

require_once __DIR__ . '/../config/database.php';

class UserManager
{
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->connect(); // Assure-toi d'utiliser le bon nom de classe ici
    }

    /**
     * Vérifie les identifiants de l'utilisateur et retourne les données utilisateur si elles sont valides.
     *
     * @param string $email
     * @param string $password
     * @return array|null
     */
    public function authenticate(string $email, string $password): ?array
    {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email LIMIT 1";

        // Utilisation correcte de $this->pdo
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);

        $stmt->execute();

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            return $user;
        }

        return null;
    }

    /**
     * Enregistre une connexion réussie dans la base de données.
     *
     * @param int $userId
     * @return void
     */
    public function logConnection(int $userId): void
    {
        $sql = "INSERT INTO connexions (date_connexion_, id_utilisateur) 
                VALUES (NOW(), :id_utilisateur)";

        // Utilisation correcte de $this->pdo
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_utilisateur', $userId, \PDO::PARAM_INT);
        $stmt->execute();
    }


    private function isEmailValid(string $email): bool
    {
        $sql = "SELECT email FROM utilisateurs WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        return $stmt->execute();
    }

    private function getCityId(string $ville): ?int
    {
        $stmt = $this->pdo->prepare("SELECT idVille FROM ville WHERE nomVille = :ville");
        $stmt->bindParam(':ville', $ville);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    private function getCountryId(string $pays): ?int
    {
        return 1;
    }
    /**
     * Valide les champs du formulaire d'inscription.
     *
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $password
     * @param string $voie
     * @param string $codepostale
     * @param string $ville
     * @param string $telephone
     * @return array
     */

    private function validateFields(
        string $nom, string $prenom, string $email, string $password,
        string $voie, string $codepostale, string $ville, string $telephone
    ): array {
        $errors = [];

        // Validation des champs
        if (empty($nom)) {
            $errors['nom'] = "Le nom est requis.";
        }
        if (empty($prenom)) {
            $errors['prenom'] = "Le prénom est requis.";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Une adresse e-mail valide est requise.";
        }
        if (empty($password)) {
            $errors['password'] = "Le mot de passe est requis.";
        }
        if (empty($voie)) {
            $errors['voie'] = "La voie est requise.";
        }
        if (empty($codepostale) || !is_numeric($codepostale)) {
            $errors['codepostale'] = "Le code postal est requis et doit être un nombre.";
        }
        if (empty($ville)) {
            $errors['ville'] = "La ville est requise.";
        }
        if (empty($telephone) || !is_numeric($telephone)) {
            $errors['telephone'] = "Le téléphone est requis et doit être un nombre.";
        }

        return $errors;
    }

    /**
     * Inscription d'un utilisateur
     *
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $password
     * @param string $voie
     * @param string $codepostale
     * @param string $ville
     * @param string $pays
     * @param string $telephone
     * @return bool|string
     */
    public function register(
        string $nom, string $prenom, string $email, string $password,
        string $voie, string $codepostale, string $ville, string $pays, string $telephone
    ) {
        $errors = $this->validateFields($nom, $prenom, $email, $password, $voie, $codepostale, $ville, $telephone);

        if (!empty($errors)) {
            $_SESSION['register_errors'] = $errors;
            return false;
        }
        if ($this->isEmailValid($email)) {
            $_SESSION['register_errors'] = "Cet email est déjà utilisé.";
            return false;
        }
        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $idVille = $this->getCityId($ville);
        $idPays = $this->getCountryId($pays);


        if (!$idVille || !$idPays) {
            return false;
        }

        $sql = "INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, adresse, telephone, IdPays, idVille,  date_inscription)
                VALUES (:nom, :prenom, :email, :mot_de_passe, :adresse, :telephone, :idPays, :idVille,  NOW())";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $hashedPassword);
        $stmt->bindParam(':adresse', $voie);
        $stmt->bindParam(':idVille', $idVille);
        $stmt->bindParam(':idPays', $idPays);
        $stmt->bindParam(':telephone', $telephone);

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











}
