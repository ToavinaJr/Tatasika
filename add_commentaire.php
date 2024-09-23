<?php
require_once "verify_session.php";
require_once "config.php";

if (isset($_GET['id_publication']) && isset($_GET['contenu']) && trim($_GET['contenu']) !== "") {
    $id_publication = $_GET['id_publication'];
    $contenu = trim($_GET['contenu']);
    $id_user = $_SESSION['user_id'];

    echo $id_publication;
    $sql_addCommentaire = "INSERT INTO commentaire (id_publication, id_compte, contenu) VALUES (? , ? , ?)";
    $stmt_addCommentaire = $db_connexion->prepare($sql_addCommentaire);
    $stmt_addCommentaire->execute([$id_publication, $id_user, $contenu]);   
}

header('Location: /home.php');