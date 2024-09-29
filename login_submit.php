<?php

session_start();

require_once "config.php";
require_once "src/models/CompteManager.php";

$email = $_POST['email'];
$password = $_POST['password'];

$compte_administrator = new CompteManager($db_connexion);
$compte = $compte_administrator->search($email);

if ($compte){
    if ( password_verify($password, $compte['password']) ) {
        // Creating the session for the actual compte
        $_SESSION['compte'] = $compte['nom'];
        $_SESSION['compte_id'] = $compte['id'];

        header("Location: home.php");
    }
    else {
        echo "Mot de passe incorecte";
        echo "<a href='/'>Revenir a l'accueil</a>";
    }
}

else {
    echo "l'email ". $email . "n'est pas encore assignée a aucune compte";
    echo "<a href='/'>REvenir a l'accueil</a>";
}