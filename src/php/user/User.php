<?php

namespace user;

class User {

    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;
    private string $adresse;
    private string $telephone;
    private Date $dateCreation;

    public function __construct($id, $nom, $prenom, $email, $password, $adresse, $telephone, $dateCreation) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->dateCreation = $dateCreation;
    }

    public function getId() {
        return $this->id;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getPrenom() {
        return $this->prenom;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getAdresse() {
        return $this->adresse;
    }
    public function getTelephone() {
        return $this->telephone;
    }
    public function getDateCreation() {
        return $this->dateCreation;
    }

}