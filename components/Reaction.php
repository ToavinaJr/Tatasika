<?php
    function Reaction($target, $idTarget) {
?>
    <div class ="reaction">
        <a href="handle_reaction.php?type=love&target=<?php echo $target; ?>&id_target=<?php echo $idTarget; ?>">
            <i class="text-blue-500 fa-solid fa-thumbs-up"></i>
            <!-- Love -->
        </a>
        <a href="handle_reaction.php?type=angry&target=<?php echo $target; ?>&id_target=<?php echo $idTarget; ?>">
            <i class="fa-solid fa-face-grin-tears text-yellow-500"></i>
        </a>
        <a href="handle_reaction.php?type=haha&target=<?php echo $target; ?>&id_target=<?php echo $idTarget; ?>">
            <i class="text-red-500 fa-solid fa-face-angry"></i>
            <!-- Haha -->
        </a>
    </div>
<?php        
    }
?> 