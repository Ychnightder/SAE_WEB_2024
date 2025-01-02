<?php
namespace Pierr\SaeWeb\php\adhesion_connexion;

class User
{

    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $adresse;
    private $telephone;
    private $codePostal;
    private $pays;
    private $ville;

    public function getCodePostal()
    {
        return $this->codePostal;
    }


    /**
     * @param $nom
     * @param $prenom
     * @param $email
     * @param $password
     * @param $adresse
     * @param $telephone

     * @param $codePostal
     * @param $pays
     * @param $ville
     */
    public function __construct($nom, $prenom, $email, $password, $adresse, $telephone,  $codePostal, $pays, $ville)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->codePostal = $codePostal;
        $this->pays = $pays;
        $this->ville = $ville;
    }


    public function getNom()
    {
        return $this->nom;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function getTelephone()
    {
        return $this->telephone;
    }
    public function getPays()
    {
        return $this->pays;
    }
    public function getVille()
    {
        return $this->ville;
    }


}