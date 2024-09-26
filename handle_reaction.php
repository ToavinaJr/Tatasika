<?php
session_start();
require_once "config.php";
require_once "verify_session.php";

if (isset($_GET['type']) && isset($_GET['target']) && isset($_GET['id_target'])) {
    $type = $_GET['type'];
    $target = $_GET['target'];
    $id_target = $_GET['id_target'];
    $userId = $_SESSION['user_id'];

    $sql_commentaire = "";
    var_dump($id_target);
    // Vérification du type de cible (commentaire ou publication)
    if ($target === "commentaire") {
        $sql_commentaire = "SELECT * FROM reaction_commentaire WHERE id_commentaire = ? AND id_compte = ?";
    } elseif ($target === "publication") {
        $sql_commentaire = "SELECT * FROM reaction_publication WHERE id_publication = ? AND id_compte = ?";
    }

    // S'assurer que la requête est bien définie
    if (!empty($sql_commentaire)) {
        try {
            $stmt_commentaire = $db_connexion->prepare($sql_commentaire);
            $stmt_commentaire->execute([$id_target, $userId]);
            $resp_reaction = $stmt_commentaire->fetch(PDO::FETCH_ASSOC);
            
            $sql_commentaire = "";
            if ($resp_reaction) {
                // Si la réaction existe déjà, la supprimer
                if ($target === "commentaire") {
                    echo $resp_reaction['type'];
                    $sql_commentaire = "DELETE FROM reaction_commentaire WHERE id_commentaire = ? AND id_compte = ?";
                } elseif ($target === "publication") {
                    echo $resp_reaction['type'];
                    $sql_commentaire = "DELETE FROM reaction_publication WHERE id_publication = ? AND id_compte = ?";
                }
            } else {
                // Si aucune réaction n'existe, en ajouter une
                if ($target === "commentaire") {
                    $sql_commentaire = "INSERT INTO reaction_commentaire (type, id_compte , id_commentaire) VALUES (? , ?, ?) ";
                } elseif ($target === "publication") {
                    $sql_commentaire = "INSERT INTO reaction_publication (type, id_compte , id_publication) VALUES (? , ?, ?) ";
                }
            }

            // Préparation et exécution de la requête d'insertion ou suppression
            $stmt_commentaire = $db_connexion->prepare($sql_commentaire);
            if ($resp_reaction) {
                // Suppression de la réaction
                $stmt_commentaire->execute([$id_target, $userId]);
                echo "voafafa";
            } else {
                // Insertion de la nouvelle réaction
                $stmt_commentaire->execute([$type, $userId , $id_target]);
                echo "mampiditra";
            }
        } catch (PDOException $e) {
            echo "Erreur de base de données : " . $e->getMessage();
        }
    } else {
        echo "Erreur : Type de cible non valide.";
    }
} else {
    echo "Paramètres manquants dans l'URL.";
}

// Redirection après traitement
header('Location: /home.php');
exit(); 
