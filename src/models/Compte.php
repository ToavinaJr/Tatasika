<?php

class Compte {
    // Les attributs de la classe
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;

    // Le constructeur de la classe compte
    public function __construct(int $id, string $nom, string $prenom, string $email, string $password) {
        $this->id       =   $id;
        $this->nom      =   $nom;
        $this->prenom   =   $prenom;
        $this->email    =   $email;
        $this->password =   $password;
    }
    
    // Les getters de la classe
    public function getId() : int {
        return $this->id;
    }

    public function getNom() : string {
        return $this->nom;
    }

    public function getPrenom() : string {
        return $this->prenom;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getPassword() : string {
        return $this->password;
    }

    /*************************** */

    public function setNom($nom) : void {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) : void {
        $this->nom = $prenom;
    }

    public function setEmail($email) : void {
        $this->email = $email;
    }

    public function setPassword($password) : void {
        $this->password = $password;
    }

    /*************************** */

}