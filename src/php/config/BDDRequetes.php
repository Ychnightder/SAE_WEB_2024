<?php

namespace config;
use BDDConnect;
use PDOException;

class BDDRequetes {

    private PDO $pdo;
    public function __construct() {
        $bddConnect = new BDDConnect(__DIR__ . '/database.db');
        $this->pdo = $bddConnect->connexion();
    }

    public function insertUser(User $user) : boolean {

        $sql = "INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, adresse, telephone, IdPays, idVille,  date_inscription)
                VALUES (:nom, :prenom, :email, :mot_de_passe, :adresse, :telephone, :idPays, :idVille,  NOW())";

        $stmt = $this->pdo->prepare($sql);
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $email = $user->getEmail();
        $motDePasse = $user->getMotDePasse();
        $adresse = $user->getAdresse();
        $telephone = $user->getTelephone();
        $idPays = $user->getIdPays();
        $idVille = $user->getIdVille();
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $motDePasse);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':idPays', $idPays);
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

    public function getUser(string $email): User {
        $sql = "SELECT id, nom, prenom, email, mot_de_passe, adresse, telephone, IdPays, idVille, date_inscription
            FROM Utilisateurs
            WHERE email = :email";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new User(
                    id: (int)$result['id'],
                    nom: $result['nom'],
                    prenom: $result['prenom'],
                    email: $result['email'],
                    motDePasse: $result['mot_de_passe'],
                    adresse: $result['adresse'],
                    telephone: $result['telephone'],
                    idPays: (int)$result['IdPays'],
                    idVille: (int)$result['idVille'],
                    dateInscription: $result['date_inscription']
                );
            } else {
                throw new Exception("Utilisateur avec l'email $email non trouvé.");
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
        }
    }



}