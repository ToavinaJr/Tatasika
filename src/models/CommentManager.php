<?php

class CommentManager {
    private PDO $connexion;

    public function __construct(PDO $connex)  {
        $this->connexion = $connex;
    }

    public function add(Comment $commentaire) {
        $query_add_commentaire = "INSERT INTO commentaire (id_compte, contenu) 
                            VALUES ( :id_compte, :contenu)";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_add_commentaire);

        // Binding the parameters
        $statement->bindParam(":id_compte", $commentaire->getIdCompte());
        $statement->bindParam(":contenu", $commentaire->getContenu());    

        // 
        $statement->execute();
    }

    public function getAllComments() {
        $query_get_all_commentaire = "SELECT * FROM commentaire";
        $statement = $this->connexion->prepare($query_get_all_commentaire);
        $statement->execute();
        $response = $statement->fetchAll();

        return $response;
    }

    public function search(int $id_commentaire, int $id_compte) {
        $query_search_commentaire = "SELECT * FROM compte WHERE id_compte = :id_compte AND id_commentaire = :id_commentaire";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_search_commentaire);

        $statement->bindParam(":id_compte", $id_compte);
        $statement->bindParam(":id_commentaire", $id_commentaire);

        $statement->execute();
        $data_commentaire = $statement->fetch(PDO::FETCH_ASSOC);

        return $data_commentaire;
    }

    public function update(int $id, Comment $commentaire) {
        $query_update_commentaire = " UPDATE FROM commentaire 
                            SET contenu = :contenu
                            WHERE id = :id ";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_update_commentaire);

        // Binding the parameters
        $statement->bindParam(":id", $id);
        $statement->bindParam(":contenu", $contenu);
        
        // 
        $statement->execute();
    }

    public function delete(int $id) {
        $query_delete_commentaire = "DELETE INTO commentaire WHERE id = :id";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_delete_commentaire);

        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function get(int $id) : Comment {
        $query_get_commentaire = "SELECT * FROM commentaire WHERE id_commentaire = :id";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_get_commentaire);

        $statement->bindParam(":id", $id);
        $statement->execute();

        $data_commentaire = $statement->fetch(PDO::FETCH_ASSOC);
        $commentaire = new Comment();

        $commentaire->setId( $data_commentaire['id_commentaire'] );
        $commentaire->setIdPublication( $data_commentaire['id_publication'] );
        $commentaire->setIdCompte( $data_commentaire['id_compte'] );
        $commentaire->setContenu( $data_commentaire['contenu'] );

        return $commentaire;
    }

    public function getAll(int $idPost) {
        $query_getAll_commentaire = "SELECT * FROM commentaire WHERE id_publication = :id_publication";

        // Preparing the query request
        $statement = $this->connexion->prepare($query_getAll_commentaire);
        $statement->bindParam(":id_publication", $idPost);
        $statement->execute();

        $all_data_commentaire = $statement->fetchAll();
        
        return $all_data_commentaire;
    }
}