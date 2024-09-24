<?php
session_start();
require_once "config.php";
require_once "verify_session.php";

if (isset($_GET['type']) && isset($_GET['target']) && isset($_GET['id_target'])) {
    $type       =   $_GET['type'];
    $target     =   $_GET['target'];
    $id_target  =   $_GET['id_target'];
    
    $sql_commentaire = "";

    if ($target === "commentaire") {
        $sql_commentaire = "SELECT * FROM commentaire WHERE id_commentaire = ?";
    }
    if ($target === "publication") {
        $sql_commentaire = "SELECT * FROM commentaire WHERE id_publication = ?";
    }
    $stmt_commentaire = $db_connexion->prepare($sql_commentaire);
    $stmt_commentaire->execute([$id_name]);
    $resp_reaction = $stmt_commentaire->fetch(PDO::FETCH_ASSOC);

    if ($resp_reaction) {
        if ($target === "commentaire") {
            $sql_commentaire = "DELETE FROM commentaire WHERE id_commentaire = ?";
        }
        if ($target === "publication") {
            $sql_commentaire = "DELETE FROM commentaire WHERE id_publication = ?";
        }
        $stmt_commentaire = $db_connexion->prepare($sql_commentaire);
        $stmt_commentaire->execute([$id_target]);
    }
    else {
        if ($target === "commentaire") {
            $sql_commentaire = "INSERT INTO commentaire (id_commentaire, id_compte) VALUES (?, ?)";
        }
        else if ($target === "publication") {
            $sql_commentaire = "INSERT INTO publication (id_publication, id_compte) VALUES (?, ?)";
        }
        $stmt_commentaire = $db_connexion->prepare($sql_commentaire);
        // $stmt_commentaire->execute([$id_target, $_SESSION['user_id']]);
    }

    header('Location: /home.php');
}