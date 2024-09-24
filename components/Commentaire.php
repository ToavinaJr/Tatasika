<?php
require_once "Reaction.php";

function Commentaire($contenu, $nomCommentataire, $id_publication) {
?>
    <div class="flex gap-8 border border-slate-400 p-4">
        
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