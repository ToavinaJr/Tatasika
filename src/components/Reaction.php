<?php
    function Reaction($target, $idTarget, $countLike, $countAngry, $countHaha) {
?>
    <div class ="reaction flex flex-col gap-2">
        <div class="flex gap-4">
            <a href="handle_reaction.php?type=love&target=<?= htmlspecialchars($target); ?>&id_target=<?= htmlspecialchars($idTarget); ?>">
                <i class="text-blue-500 fa-solid fa-thumbs-up text-3xl hover:scale-125"></i>
                <!-- Love -->
            </a>
            <a 
                href="handle_reaction.php?type=angry&target=<?= htmlspecialchars($target); ?>&id_target=<?= htmlspecialchars($idTarget); ?>">
                <i class="text-red-500 fa-solid fa-face-angry text-3xl hover:scale-125"></i>
            </a>
            <a 
                href="handle_reaction.php?type=haha&target=<?=htmlspecialchars($target); ?>&id_target=<?= htmlspecialchars($idTarget); ?>"
                class="w-6 h-6"
            >
                <i class="fa-solid fa-face-grin-tears text-yellow-500 text-3xl hover:scale-125"></i>
                <!-- Haha -->
            </a>
        </div>
        
        <div class="m-2 ml-0 p pl-0 " style="background-color: gray; padding: 5px; width: fit-content;">
            <span style="width: 50px;" class="text-white rounded-md p-2 pl-0 "><?= htmlspecialchars($countLike); ?> <i class="text-blue-500 fa-solid fa-thumbs-up"></i></span>
            <span style="width: 50px;" class="text-white rounded-md p-2 pl-0 "><?= htmlspecialchars($countAngry); ?> <i class="text-red-500 fa-solid fa-face-angry"></i></span>
            <span style="width: 50px;" class="text-white rounded-md p-2 pl-0 "><?= htmlspecialchars($countHaha); ?> <i class="fa-solid fa-face-grin-tears text-yellow-500"></i></span>
        </div>
    </div>
<?php        
    }
?> 