<?php
session_start();

require "config.php";
require_once "src/models/CommentManager.php";
require_once "src/models/Comment.php";

if (isset($_GET['contenu'])) {
    $comment = new Comment();

    $comment->setIdPublication($_GET['id_publication']);
    $comment->setIdCompte($_SESSION['user_id']);
    $comment->setContenu($_GET['contenu']);
    
    $comment_manager = new CommentManager($db_connexion);
    $comment_manager->add($comment);
}

header("Location: home.php");