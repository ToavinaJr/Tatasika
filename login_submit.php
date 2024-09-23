<?php

session_start();
require_once "config.php";

$email      =   trim($_POST['email']);
$password   =   trim($_POST['password']);

// Rechercher l'email dans la base de donée
$sql_searchEmail    =   "SELECT * FROM compte WHERE email = ?";
$stmt               =   $db_connexion->prepare($sql_searchEmail);
$stmt->execute([$email]);

$user   = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['nom'];
        $_SESSION['user_id'] = $user['id'];
        header('Location: home.php');
    }
    else {
        echo "Diso ny mot de passe";
    }
}
else {
    echo "l'email ". $email . "n'est pas encore assignée a aucune compte";
    echo "<a href='/'>REvenir a l'accueil</a>";
}