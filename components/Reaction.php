<?php
    function Reaction($target, $idTarget) {
?>
    <div class ="reaction">
        <a href="handle_reaction.php?type=love&target=<?php echo $target; ?>&id_target=target=<?php echo $idTarget; ?>"><i class="icon-reaction fa-solid fa-heart"></i></a>
        <a href="handle_reaction.php?type=angry&target=<?php echo $target; ?>&id_target=target=<?php echo $idTarget; ?>"><i class="icon-reaction fa-solid fa-face-angry"></i></a>
        <a href="handle_reaction.php?type=haha&target=<?php echo $target; ?>&id_target=target=<?php echo $idTarget; ?>"><i class="icon-reaction fa-solid fa-face-grin-tears"></i></a>
    </div>
<?php        
    }
?> 