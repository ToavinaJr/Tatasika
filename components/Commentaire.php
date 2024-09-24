<?php
require_once "Reaction.php";

function Commentaire($contenu, $nomCommentataire, $id_publication) {
?>
    <div style='display: flex; flex-direction: column; gap: 10px; padding: 10px; border: 1px solid gray;'>
        <h4 style='color:gray;'> 
            <?php echo $nomCommentataire; ?> 
        </h4>
        <p class='contenu'> 
            <?php echo $contenu; ?> 
        </p>
        <?php Reaction("commentaire", $id_publication); ?>
    </div>
<?php
}
?>