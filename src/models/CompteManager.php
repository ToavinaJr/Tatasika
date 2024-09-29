<?php
// <->

require_once "Compte.php";

class CompteManager {
    private PDO $connexion;
    public function __construct(PDO $connex)  {
        $this->connexion = $connex;
    }
    public function add(Compte $compte) {
        $query_add_compte = "INSERT INTO compte (nom, prenom, email, password) 
                            VALUES ( :nom, :prenom, :email, :password )";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_add_compte);

        // Binding the parameters
        $statement->bindParam(":nom", $compte->getName());
        $statement->bindParam(":prenom", $compte->getFirstName());
        $statement->bindParam(":email", $compte->getEmail());
        $statement->bindParam(":password", $compte->getPassword());

        // 
        $statement->execute();
    }

    public function search(string $email) {
        $query_search_compte = "SELECT * FROM compte WHERE email = :email";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_search_compte);

        $statement->bindParam(":email", $email);
        $statement->execute();

        $data_compte = $statement->fetch(PDO::FETCH_ASSOC);

        return $data_compte;
    }

    public function update(int $id, Compte $compte) {
        $query_update_compte = " UPDATE FROM compte 
                            SET nom = :nom , prenom = :prenom, email = :email
                            WHERE id = :id ";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_update_compte);

        // Binding the parameters
        $statement->bindParam(":id", $id);
        $statement->bindParam(":nom", $compte->getName());
        $statement->bindParam(":prenom", $compte->getFirstName());
        $statement->bindParam(":email", $compte->getEmail());
        
        // 
        $statement->execute();
    }

    public function delete(int $id) {
        $query_delete_compte = "DELETE INTO compte WHERE id = :id";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_delete_compte);

        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function get(int $id) : Compte {
        $query_get_compte = "SELECT * FROM compte WHERE id = :id";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_delete_compte);

        $statement->bindParam(":id", $id);
        $statement->execute();

        $data_compte = $statement->fetch(PDO::FETCH_ASSOC);
        $compte = new Compte();

        $compte->setName( $compte['nom'] );
        $compte->setFirstName( $compte['prenom'] );
        $compte->setEmail( $compte['email'] );
        $compte->setPassword( $compte['password'] );

        return $compte;
    }

    public function verify(Compte $compte) : bool {
        $query_verify_compte = "SELECT * FROM compte WHERE email = :email AND password = :password";

        // Preparing the query request
        $statement_verify_compte = $this->connexion->prepare($query_verify_compte);

        $statement_verify_compte->bindParam(":email", $compte->getEmail());
        $statement_verify_compte->bindParam(":password", $compte->getPassword());

        $response = $statement->execute($statement_verify_compte);

        return $response;
    }
}