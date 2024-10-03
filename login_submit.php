<?php

session_start();

require_once "config.php";
require_once "src/models/CompteManager.php";

$email = $_POST['email'];
$password = $_POST['password'];

$compte_administrator = new CompteManager($db_connexion);
$compte = $compte_administrator->search($email);
var_dump( $compte);

if ($compte){
    if ( password_verify($password, $compte['password']) ) {
        // Creating the session for the actual compte
        $_SESSION['user'] = $compte['nom'];
        $_SESSION['user_id'] = $compte['id'];
        var_dump($_SESSION) ;
        header("Location: home.php");
    }
    else {
        echo "Mot de passe incorecte";
        echo "<auser href='/'>Revenir a l'accueil</auser>";
    }
}

else {
    echo "l'email ". $email . "n'est pas encore assignée a aucune compte";
    echo "<a href='/'>REvenir a l'accueil</a>";
}
