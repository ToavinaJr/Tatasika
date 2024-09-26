<?php
require_once "Compte.php";

class CompteManager {

    private PDO $database ;

    public function addCompte( Compte $compte ) : bool {
        // Hashage du mot de passe
        $hashedPassword = password_hash($compte->getPassword(), PASSWORD_DEFAULT);

        // Requete pour inserer l'utilisateur
        $query = "INSERT INTO compte (nom, prenom, email, email, password) VALUES (:nom, :prenom, :email, :password)";

        // Préparationde la requete
        $statement = $this->database->prepare($query);

        $statement->bindParam(':nom', $compte->getNom());
        $statement->bindParam(':prenom', $compte->getPrenom());
        $statement->bindParam(':email', $compte->getEmail());
        $statement->bindParam(':password', $hashedPassword);

        return $statement->execute();
    }

    public function getCompte(int $idCompte) {
        // Requete pour rechercher l'utilisateur
        $query = "SELECT * FROM compte WHERE id = :id";

        // Préparationde la requete
        $statement = $this->database->prepare($query);

        $statement->bindParam(':ID', $idCompte);
        $statement->execute();

        $compte = $statement->fetch(PDO::FETCH_ASSOC);

        return $compte;
    }

    public function updateCompte(int $idCompte, Compte $compteAjour) {
        // Hashage du mot de passe
        $hashedPassword = password_hash($compteAjour->getPassword(), PASSWORD_DEFAULT);

        // Requete pour mettre à jour l'utilisateur
        $query =    "UPDATE compte 
                    SET nom = :nom , prenom = :prenom , email = :email , password = :password
                    WHERE id = :id" ;
        
        // Préparationde la requete
        $statement = $this->database->prepare($query);

        $statement->bindParam(':nom', $compteAjour->getNom());
        $statement->bindParam(':prenom', $compteAjour->getPrenom());
        $statement->bindParam(':email', $compteAjour->getEmail());
        $statement->bindParam(':password', $hashedPassword);
        $statement->bindParam(':id', $idCompte);

        $statement->execute();
    }

    public function deleteUser(int $idCompte) {
        // Requete pour mettre à jour l'utilisateur
        $query =    "DELETE FROM compte 
                    WHERE id = :id" ;
        
        // Préparationde la requete
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $idCompte);

        $statement->execute();
    }

    public function getAllCompts(int $idCompte) {
        // Requete pour rechercher l'utilisateur
        $query = "SELECT * FROM compte";

        // Préparationde la requete
        $statement = $this->database->prepare($query);

        $statement->execute();

        $comptes = $statement->fetchAll();

        return $comptes;
    }

    public function authentifyCompte(Compte $compte) : bool {

        // Hashage du mot de passe
        $query = "SELECT * FROM compte WHERE email = :email";

        $statement = $this->database->prepare($query);
        $statement->bindParam(':email', $compte->getEmail());
        $statement->execute();

        $compteResult = $statement->fetch(PDO::FETCH_ASSOC);
        return password_verify($compte->getPassword(), $compteResult['password']);
    }
}