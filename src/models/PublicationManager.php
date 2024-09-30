<?php

class PublicationManager {
    private PDO $connexion;

    public function __construct(PDO $connex)  {
        $this->connexion = $connex;
    }

    public function add(Publication $publication) {
        $query_add_publication = "INSERT INTO publication (id_compte, contenu) 
                            VALUES ( :id_compte, :contenu)";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_add_publication);

        // Binding the parameters
        $statement->bindParam(":id_compte", $publication->getIdCompte());
        $statement->bindParam(":contenu", $publication->getContenu());    

        // 
        $statement->execute();
    }

    public function search(int $id_publication, int $id_compte) {
        $query_search_publication = "SELECT * FROM compte WHERE id_compte = :id_compte AND id_publication = :id_publication";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_search_publication);

        $statement->bindParam(":id_compte", $id_compte);
        $statement->bindParam(":id_publication", $id_publication);

        $statement->execute();
        $data_publication = $statement->fetch(PDO::FETCH_ASSOC);

        return $data_publication;
    }

    public function update(int $id, Publication $publication) {
        $query_update_publication = " UPDATE FROM publication 
                            SET contenu = :contenu
                            WHERE id = :id ";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_update_publication);

        // Binding the parameters
        $statement->bindParam(":id", $id);
        $statement->bindParam(":contenu", $contenu);
        
        // 
        $statement->execute();
    }

    public function delete(int $id) {
        $query_delete_publication = "DELETE INTO publication WHERE id = :id";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_delete_publication);

        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function get(int $id) : Publication {
        $query_get_publication = "SELECT * FROM publication WHERE id_publication = :id";
        require_once "src/models/Compte.php";
        require_once "src/models/CompteManager.php";
        // Preparing the query request
        $statement = $thdata_compteis->connexion->prepare($query_get_publication);

        $statement->bindParam(":id", $id);
        $statement->execute();

        $data_publication = $statement->fetch(PDO::FETCH_ASSOC);
        $compte = new publication();

        $publication->setName( $data_publication['nom'] );
        $publication->setFirstName( $data_publication['prenom'] );
        $publication->setEmail( $data_publication['email'] );
        $publication->setPassword( $data_publication['password'] );

        return $publication;
    }

    public function getAll() {
        $query_getAll_publication = "SELECT * FROM publication ORDER BY date_creation DESC";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_getAll_publication);

        $statement->execute();

        $all_data_publication = $statement->fetchAll();
        
        return $all_data_publication;
    }
}