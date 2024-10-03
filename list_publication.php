<?php
require_once "config.php";
require_once "src/models/PublicationManager.php";
require_once "src/components/Modals.php";
require_once "src/components/Reaction.php";
require_once "src/components/Commentaire.php";

$publication_manager = new PublicationManager($db_connexion);
$all_publication = $publication_manager->getAll();

echo "<div class='flex flex-col gap-4'>";
foreach($all_publication as $publication) {
    // Chercher l'id de l'utilisateur qui a publié
    $publication_owner = $compte_manager->get($publication['id_compte']);
    $btn = "";
    
    $id_publication = $publication['id_publication'];

    // tester si 'id l'utilisateur actuel est le propriétaire de la publication
    if ($_SESSION['user_id'] === $publication['id_compte']) {
        $btn = "<a href='#' onClick='deletePublication($id_publication)' class='x-btn absolute right-4 top-4'><i class='fa-solid fa-trash hover:text-blue-500 ' style='color: blue;'></i></a>";
    }
    // Les conteneurs de chaque pubicaton
    echo "<div class='bg-slate-700 p-4 py-[20px] relative' id='publication-$id_publication'> <h3 class='post-user text-3xl text-blue-500'> " . $publication_owner->getName() . "</h3>";
    echo "<div> <span class='text-gray-100'>Publié le </span> : <span   class='text-gray-100'>" . htmlspecialchars($publication['date_creation']) . " </span> " . $btn ."<div class='bg-slate-800 flex justify-center items-center h-[200px] mb-4 text-gray-100 text-wrap break-words overflow-x-scrool'>" . $publication['contenu'] . "</div>";
    echo "</div>"; 
    
    $sql_count_reactions = "SELECT type, COUNT(*) as total FROM reaction_publication WHERE id_publication = ? GROUP BY type";
    $statement_countReactions = $db_connexion->prepare($sql_count_reactions);
    $statement_countReactions->execute([$publication['id_publication']]);
    $reactions = $statement_countReactions->fetchAll(PDO::FETCH_KEY_PAIR);

    $countLike = $reactions['love'] ?? 0;
    $countHaha = $reactions['haha'] ?? 0;
    $countAngry = $reactions['angry'] ?? 0;

    Reaction("publication", $publication['id_publication'], $countLike, $countAngry, $countHaha);
    
    // Afficher tous les commentaires
    echo "<div class='comments flex flex-col gap-2 my-2'>";

    $commentairesList = $comment_manager->getAll($publication['id_publication']);
    foreach ($commentairesList as $com) {                            
        $comment_owner = $compte_manager->get($com['id_compte']);
        
        Commentaire( htmlspecialchars($com['contenu']) , $comment_owner->getName(), $publication['id_publication']);     
    }     
    echo "</div>";
      
    echo "<form action='add_commentaire.php' method='get' class='flex flex-col md:flex-row items-start gap-4 md:mt-2' ><textarea type='text' class='p-4 bg-slate-600  rounded-md' placeholder='Ajouter un commentaire' style='resize:none; width: 280px;' name='contenu'></textarea> <button class='bg-blue-500 px-8 py-6 rounded-md my-2 text-white' type='submit' value='$id_publication' name='id_publication' style='resize: none;'>Commenter</button></form>";
    Modals();
    echo "</div>";
}