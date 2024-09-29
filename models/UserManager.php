<?php
// <->

require_once "User.php";
require_once "../config.php";

class UserManager {
    public function add(User $user) {
        $query_add_user = "INSERT INTO compte (nom, prenom, email, password) 
                            VALUES ( :nom, :prenom, :email, :password )";

        // Preparing the query request
        $statement = $db_connexion->prepare($query_add_user);

        // Binding the parameters
        $statement->bindParam(":nom", $user->getName());
        $statement->bindParam(":prenom", $user->getFirstName());
        $statement->bindParam(":email", $user->getEmail());
        $statement->bindParam(":password", $user->getPassword());

        // 
        $statement->execute();
    }

    public function search(User $user) {
        $query_search_user = "SELECT * FROM compte WHERE email = :email";

        // Preparing the query request
        $statement = $db_connexion->prepare($query_search_user);

        $statement->bindParam(":email", $email);
        $statement->execute();

        $data_user = $statement->fetch(PDO::FETCH_ASSOC);

        return $data_user;
    }

    public function update(int $id, User $user) {
        $query_update_user = " UPDATE FROM compte 
                            SET nom = :nom , prenom = :prenom, email = :email
                            WHERE id = :id ";

        // Preparing the query request
        $statement = $db_connexion->prepare($query_update_user);

        // Binding the parameters
        $statement->bindParam(":id", $id);
        $statement->bindParam(":nom", $user->getName());
        $statement->bindParam(":prenom", $user->getFirstName());
        $statement->bindParam(":email", $user->getEmail());
        
        // 
        $statement->execute();
    }

    public function delete(int $id) {
        $query_delete_user = "DELETE INTO compte WHERE id = :id";

        // Preparing the query request
        $statement = $db_connexion->prepare($query_delete_user);

        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function get(int $id) : User {
        $query_get_user = "SELECT * FROM compte WHERE id = :id";

        // Preparing the query request
        $statement = $db_connexion->prepare($query_delete_user);

        $statement->bindParam(":id", $id);
        $statement->execute();

        $data_user = $statement->fetch(PDO::FETCH_ASSOC);
        $user = new User();

        $user->setName( $user['nom'] );
        $user->setFirstName( $user['prenom'] );
        $user->setEmail( $user['email'] );
        $user->setPassword( $user['password'] );

        return $user;
    }

    public function verify(User $user) : bool {
        $query_verify_user = "SELECT * FROM compte WHERE email = :email AND password = :password";

        // Preparing the query request
        $statement_verify_user = $db_connexion->prepare($query_verify_user);

        $statement_verify_user->bindParam(":email", $user->getEmail());
        $statement_verify_user->bindParam(":password", $user->getPassword());

        $response = $statement->execute($statement_verify_user);

        return $response;
    }
}