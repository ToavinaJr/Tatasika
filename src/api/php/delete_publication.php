<?php
require_once "../../models/PublicationManager.php";
require_once "../../../config.php";

// S'assurer que la requête est bien une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le corps de la requête JSON
    $json = file_get_contents('php://input');
    
    // Décoder les données JSON
    $data = json_decode($json, true);

    // Vérifier que l'identifiant de la publication a bien été reçu
    if (isset($data['publication_id'])) {
        $publication_id = $data['publication_id']; // Récupérer l'ID de la publication

        // Initialiser le gestionnaire de publication
        $publication_manager = new PublicationManager($db_connexion);

        // Supprimer la publication associée à cet ID
        $result = $publication_manager->delete($publication_id);

        echo $result;
        // Vérifier si la suppression a réussi
        if ($result) {
            // Envoyer une réponse JSON au client
            echo json_encode([
                "status" => "success",
                "message" => "Publication supprimée avec succès",
                "deleted_publication_id" => $publication_id
            ]);
        } else {
            // En cas d'échec
            echo json_encode([
                "status" => "error",
                "message" => "Échec de la suppression de la publication"
            ]);
        }
    } else {
        // En cas d'absence de l'ID de la publication
        echo json_encode([
            "status" => "error",
            "message" => "ID de la publication manquant"
        ]);
    }

    header("Location: /home.php");
}
