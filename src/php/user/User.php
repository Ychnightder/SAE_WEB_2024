<?php

namespace user;


class User {

    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;

    public function __construct($id, $nom, $prenom, $email) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
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
}