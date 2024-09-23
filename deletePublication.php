<?php
session_start();

require_once "verify_session.php";
require_once "config.php";

if (isset($_GET['delete'])) {
    $id_post  = $_GET['delete'];
    $sql_deletePublication = "DELETE FROM publication WHERE id_publication = ? ";
    $stmt_deletePublication = $db_connexion->prepare($sql_deletePublication);
    $stmt_deletePublication->execute([$id_post]);
}

header("Location: /home.php");