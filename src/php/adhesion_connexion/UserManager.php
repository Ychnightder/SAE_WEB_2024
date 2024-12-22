<?php

namespace adhesion_connexion;
use database;

require_once __DIR__ . '/../config/database.php';

class UserManager
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = database::connect();
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

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

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
                VALUES (NOW(),  :id_utilisateur)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_utilisateur', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

}