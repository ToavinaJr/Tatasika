<?php
header('Content-Type: application/json');

require_once "../../../config.php";
require_once "../../models/CompteManager.php";
require_once "../../models/PublicationManager.php";
require_once "../../models/CommentManager.php";

$compte_manager      = new CompteManager($db_connexion);
$publication_manager = new PublicationManager($db_connexion);
$commentaire_manager = new CommentManager($db_connexion);

$data_comptes = $compte_manager->getAll();
$data_publications = $publication_manager->getAll();
$data_comments = $commentaire_manager->getAllComments();

$data = [
    "data_comptes" => $data_comptes,
    "data_publications" => $data_publications,
    "data_comments" => $data_comments
];

$data = json_encode($data);
echo $data;