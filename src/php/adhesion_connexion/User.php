<?php

namespace adhesion_connexion;
class ser
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $motDePasse;

    public function __construct(array $data)
    {
        $this->id = $data['id_utilisateur'];
        $this->nom = $data['nom'];
        $this->prenom = $data['prenom'];
        $this->email = $data['email'];
        $this->motDePasse = $data['mot_de_passe'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

}