<?php
require_once "Reaction.php";

function Commentaire($contenu, $nomCommentataire, $id_publication) {
?>
    <div class="flex flex-col gap-4 border border-slate-400 p-4">
        <div class="flex gap-2 w-full bg-blue-300 p-2 rounded-md" style="width: fit-content;">
            <div class="flex gap-4">                                
                <img 
                    src="../img/face-laugh-solid.svg" 
                    class="w- h-4 rounded-full" 
                    alt=""
                    width="50px"
                    height="50px"
                />
            </div>
            <div class="flex flex-col gap-2  p-2 rounded-md" style="width: 400px;">
                <span class="text-xl">
                    <?php echo $nomCommentataire; ?>
                </span>
                
                <p class='contenu text-gray-500 '> 
                    <?php echo $contenu; ?> 
                </p>
            </div>
        </div>
            
        <?php 
            Reaction("commentaire", $id_publication, 1, 2, 3); 
        ?>
    </div>
<?php
}
?>