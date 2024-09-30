<?php
    session_start();

    require_once "verify_session.php";
    require_once "config.php";
    require_once "src/components/Navbar.php";
    require_once "src/components/Head.php";
    require_once "src/components/Reaction.php";
    require_once "src/components/Commentaire.php";
    require_once "src/models/Publication.php";
    require_once "src/models/PublicationManager.php";
    require_once "src/models/Compte.php";
    require_once "src/models/CompteManager.php";
    require_once "src/models/Comment.php";
    require_once "src/models/CommentManager.php";

    Head("Accueil - Votre site");

    // Vérifier que la connexion à la base de données est initialisée
    if (isset($db_connexion)) {
        $publication_manager = new PublicationManager($db_connexion);
        $compte_manager = new CompteManager($db_connexion);
        $comment_manager = new CommentManager($db_connexion);
    }
    else {
        echo "Erreur : connexion à la base de données non établie.";
        exit();
    }
?>
<body class="h-full w-full overflow-x-hidden bg-slate-800 text-white">
    <?php Navbar(); ?>
    
    <div class="flex flex-col md:flex-row gap-8">
        <div class="sidebar bg-slate-800">
            <h3 class="text-3xl m-4 text-blue-500">Amis</h3>
            <ul class="flex flex-col gap-4">
                <li class="w-full p-4">
                    <div class="flex w-[90vw] md:w-[200px] gap-4 items-center border border-slate-500 p-4">
                        <div class="w-10 h-10">
                            <img src="img/face-laugh-solid.svg" class="w-10 h-10" alt="Avatar">
                        </div>
                        <h2 class="name">RAKOTO</h2>
                    </div>
                </li>
                <li>Ami 2</li>
                <li>Ami 3</li>
            </ul>
        </div>
        <div class="flex-grow lg:w-[70vw] lg:max-h-[100vh] overflow-x-hidden overflow-y-scroll">
            <h2 class="text-3xl m-4 text-blue-500 md:ml-0">Fil d'actualité</h2>
            <form class="flex flex-col md:flex-row gap-8 bg-yellow m-4 md:ml-0" action="add_publication.php" method="post">
                <textarea class="resize-none p-4 border rounded-md border-none w-[calc(100vw - 8px) ] bg-slate-500 text-white md:w-[70%] border-blue-500" placeholder="Quoi de neuf ?" name="publication"></textarea>
                <button class="hover:bg-blue-500 py-4 px-[50px] text-white rounded-xl bg-blue-800" type="submit" >Publier</button>
            </form>

            <div class="m-4 md:ml-0 flex flex-col gap-4">
            <?php
                
                // Vérifier s'il y a des publications 
                $publicationList = $publication_manager->getAll();

                if (!empty($publicationList))  {                
                    // Parcourir les publications et les afficher
                    echo "<h3 class='text-xl text-blue-500'> Toutes les publications :</h3>"; 
                    echo "<div class='flex flex-col gap-4'>";
                    foreach ($publicationList as $publication) {
                        // die();
                        $publication_owner = $compte_manager->get($publication['id_compte']);
                        $btn = "";
                        // var_dump($_SESSION["user_id"], $publication['id_compte']);
                        if ($_SESSION['user_id'] === $publication['id_compte']) {
                            $id_publication = $publication['id_publication'];
                            $btn = "<a href='#' onClick='deletePublication($id_publication)' class='x-btn absolute right-4 top-4'><i class='fa-solid fa-trash' style='color: blue;'></i></a>";
                        }
                        // Les conteneurs de chaque pubicaton
                        echo "<div class='bg-slate-700 p-4 py-[20px] relative'> <h3 class='post-user text-3xl text-blue-500'> " . $publication_owner->getName() . "</h3>";
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
                        
                        $id_publication = $publication['id_publication'];     
                        echo "<form action='add_commentaire.php' method='get' class='flex flex-col md:flex-row items-start gap-4 md:mt-2' ><textarea type='text' class='p-4 bg-slate-600' placeholder='Ajouter un commentaire' style='resize:none; width: 280px;' name='contenu'></textarea> <button class='bg-blue-500 px-4 py-2 my-2 text-white' type='submit' value='$id_publication' name='id_publication' style='resize: none;'>Commenter</button></form>";
                        echo "</div>";
                        // echo "</div>";                                    
                    }
                } else {
                echo "<p>Aucune publication n'a été trouvée.</p>";
                }
            
            ?>

            </div>
        </div>
    </div>
    <!-- <script src="src/api/js/get_data.js"></script> -->
    <script src="src/api/js/delete_publication.js"></script>
</body>
</html>
