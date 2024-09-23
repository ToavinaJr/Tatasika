<?php

require_once "config.php";

$email     =    $_POST["email"];
$nom       =    $_POST["nom"];
$prenom    =    $_POST["prenom"];
$password1 =    $_POST["password-1"];
$password2 =    $_POST["password-2"];

if ($password1 === $password2) {
    $sql = "SELECT * FROM compte WHERE email = ?";
    $stmt = $db_connexion->prepare($sql);
    $stmt->execute( [$email] );
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        echo "L'email déja assigné à un compte";
    }
    else {
        $hashedPassword =   password_hash($password1, PASSWORD_DEFAULT);
        // REQUETE SQL POUR AJOUTER UN COMPTE
        $sql_addUser    =   "INSERT INTO compte (nom, prenom, email, password) VALUES (? ,? ,? , ?)"; 
        
        $stmt           =   $db_connexion->prepare($sql_addUser);
        $stmt->execute([$nom, $prenom, $email, $hashedPassword]);
        
        echo "<a href='/'>Se connecter maintenant</a>";
    }
}
else {
    header("Location: wrongPassword.php");
}