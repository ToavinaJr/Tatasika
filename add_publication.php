<?php
session_start();
require_once "config.php";

if (isset($_POST['publication']) && trim($_POST['publication']) !== "") {
    $publication = $_POST['publication'];

    if (isset($_SESSION['user_id'])) {
        // Vérifier si l'utilisateur existe dans la table `compte`
        $userId = $_SESSION['user_id'];

        $sql_addPublication = "INSERT INTO publication (id_compte, contenu) VALUES (? , ?) ";
        $stmt = $db_connexion->prepare($sql_addPublication);
        $stmt->execute([ $_SESSION['user_id'], $publication]);
        header('Location: /home.php');
    } 

} else {
    echo "Erreur : Aucune publication soumise.";
}
