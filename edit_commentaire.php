<?php
    session_start();
    require_once "verify_session.php";
    require_once "config.php";
    
    if (isset($GET['commentaire'], $GET['id_commentaire'], $GET['new-commentaire'])) {
        $commentaire = $GET['commentaire'];
        $id_commentaire = $GET['id_commentaire'];
        $new_commentaire = $GET['new-commentaire'];

        $sql_updateCommentaire = "UPDATE commentaire SET contenu = ? WHERE id_commentaire = ?";
        $stmt_updateCommentaire = $db_connexion->prepare($sql_updateCommentaire);
        $stmt_updateCommentaire->execute([ $new_commentaire, $id_commentaire ]);

    }
    else {
        echo "Erreur de modification du commentaire";
        exit();
    }
?>

<form action="">
    <label for="">Modifier votre commentaire</label>
    <textarea name="" id="" name="new-commentaire" value="<?php echo $commentaire ;?>"></textarea>
    <input type="submit" value="Modifier">
</form>
