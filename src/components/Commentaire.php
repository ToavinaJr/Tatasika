<?php
require_once "Reaction.php";

function Commentaire($contenu, $nomCommentataire, $id_publication) {
?>
    <div class="flex flex-col gap-2 border bg-slate-800  rounded-md border-slate-800 p-4">
        <div class="flex gap-2 p-2 rounded-md text-wrap  bg-slate-500">
            <div class="flex gap-4">                                
                <img 
                    src="../img/face-laugh-solid.svg" 
                    class="w-16 h-16 rounded-full" 
                    alt=""
                    width="50px"
                    height="50px"
                />
            </div>
            <div class="flex flex-col gap-2  p-2 rounded-md" style="width: 400px; ">
                <span class="text-xl">
                    <?= htmlspecialchars($nomCommentataire); ?>
                </span>
                
                <p class="flex contenu w-[100px] lg:w-[380px] text-gray-200 ">
                    <?= htmlspecialchars($contenu); ?>
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