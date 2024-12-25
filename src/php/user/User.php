<?php

namespace user;

class User {
    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;
    private string $adresse;
    private string $telephone;
    private int $idVille;
    private string $dateInscription;
    private bool $adherent;

    public function __construct(
        string $nom,
        string $prenom,
        string $email,
        string $password,
        string $adresse,
        string $telephone,
        int $idVille,
        string $dateInscription,
        bool $adherent
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->idVille = $idVille;
        $this->dateInscription = $dateInscription;
        $this->adherent = $adherent;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getAdresse(): string {
        return $this->adresse;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function getIdVille(): int {
        return $this->idVille;
    }

    public function getDateInscription(): string {
        return $this->dateInscription;
    }

    public function isAdherent(): bool {
        return $this->adherent;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->$password = $password;
    }

    public function setAdresse(string $adresse): void {
        $this->adresse = $adresse;
    }

    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }

    public function setIdVille(int $idVille): void {
        $this->idVille = $idVille;
    }

    public function setDateInscription(string $dateInscription): void {
        $this->dateInscription = $dateInscription;
    }

    public function setAdherent(bool $adherent): void {
        $this->adherent = $adherent;
    }
}