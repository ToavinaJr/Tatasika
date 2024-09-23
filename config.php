<?php
$db_host = "localhost";
$db_name = "db_tatasika";
$db_user = "toavina-jr";
$db_password = "azertyuiop";

try {
    // Connexion avec la base de sonnée
    $db_connexion = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);

    // Configuration des erreurs 
    $db_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}