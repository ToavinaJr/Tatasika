<?php
    function Reaction($target, $idTarget, $countLike, $countAngry, $countHaha) {
?>
    <div class ="reaction flex flex-col gap-2">
        <div>
            <a href="handle_reaction.php?type=love&target=<?php echo $target; ?>&id_target=<?php echo $idTarget; ?>">
                <i class="text-blue-500 fa-solid fa-thumbs-up"></i>
                <!-- Love -->
            </a>
            <a 
                href="handle_reaction.php?type=angry&target=<?php echo $target; ?>&id_target=<?php echo $idTarget; ?>">
                <i class="text-red-500 fa-solid fa-face-angry"></i>
            </a>
            <a 
                href="handle_reaction.php?type=haha&target=<?php echo $target; ?>&id_target=<?php echo $idTarget; ?>"
                class="w-6 h-6"
            >
                <i class="fa-solid fa-face-grin-tears text-yellow-500"></i>
                <!-- Haha -->
            </a>
        </div>
        
        <div class="m-2 ml-0 pl-0" style="background-color: gray; padding: 5px; width: fit-content;">
            <span style="width: 50px;" class="text-white rounded-md p-2 pl-0 "><?= $countLike; ?> <i class="text-blue-500 fa-solid fa-thumbs-up"></i></span>
            <span style="width: 50px;" class="text-white rounded-md p-2 pl-0 "><?= $countAngry; ?> <i class="text-red-500 fa-solid fa-face-angry"></i></span>
            <span style="width: 50px;" class="text-white rounded-md p-2 pl-0 "><?= $countHaha; ?> <i class="fa-solid fa-face-grin-tears text-yellow-500"></i></span>
        </div>
    </div>
<?php        
    }
?> 