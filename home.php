<?php
    session_start();
    require_once "verify_session.php";
    require_once "config.php";
    require_once "src/components/Navbar.php";
    require_once "src/components/Head.php";
    require_once "src/components/Reaction.php";
    require_once "src/components/Commentaire.php";

    Head("Accueil - Votre site");
?>

<body style='height: 100vh;'>
    <?php Navbar(); ?>
    
    <div class="flex flex-col md:flex-row gap-8">
        <div class="sidebar">
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
        <div class="flex-grow lg:w-[70vw]">
            <h2 class="text-3xl m-4 text-blue-500 md:ml-0">Fil d'actualité</h2>
            <form class="flex flex-col md:flex-row gap-8 bg-yellow m-4 md:ml-0" action="add_publication.php" method="post">
                <textarea class="resize-none p-4 border w-[calc(100vw - 8px) ] md:w-[70%] border-blue-500" placeholder="Quoi de neuf ?" name="publication"></textarea>
                <button class="bg-blue-500 py-4 px-[50px] text-white rounded-sm" type="submit" >Publier</button>
            </form>

            <div class="m-4 md:ml-0 flex flex-col gap-4">
            <?php
                // Vérifier que la connexion à la base de données est initialisée
                if (isset($db_connexion)) {
                    // Préparer et exécuter la requête pour récupérer toutes les publications
                    $sql_allPost = "SELECT * FROM publication ORDER BY date_creation DESC";
                    $stmtPublication = $db_connexion->prepare($sql_allPost);
                    $stmtPublication->execute();

                    // Récupérer toutes les publications
                    $publicationList = $stmtPublication->fetchAll(PDO::FETCH_ASSOC);

                    // Vérifier s'il y a des publications
                    if (!empty($publicationList)) {
                        // Parcourir les publications et les afficher
                        // echo "<h3> Toutes les publications :</h3>";
                        foreach ($publicationList as $publication) {
                            $user_id = $publication['id_compte'];

                            // Chercher le nom de l'user qui a publié le post
                            $sql_searchName = "SELECT * FROM compte WHERE id = ? LIMIT  1";
                            
                            // Preparation de la requete
                            $stmt = $db_connexion->prepare($sql_searchName);
                            
                            $stmt->execute([$user_id]);
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                            // rEQUETE POUR AVOIR TOUS LES COMMENTAIRES
                            $sql_searchComment = "SELECT * FROM commentaire WHERE id_publication = ?";

                            // 
                            $id_publication = $publication["id_publication"];
                            $stmtCommentaire = $db_connexion->prepare($sql_searchComment);

                            $stmtCommentaire->execute([$id_publication]);
                            
                            $commentairesList = $stmtCommentaire->fetchAll(PDO::FETCH_ASSOC);
                            
                            
                            $btn = "";
                            if ($_SESSION['user_id'] === $publication['id_compte'])
                                $btn = "<a href='deletePublication.php?delete=$id_publication' class='x-btn absolute right-4 top-4'><i class='fa-solid fa-trash' style='color: blue;'></i></a>";
                            
                            // Les conteneurs de chaque pubicaton
                            echo "<div class='bg-slate-200 p-4 py-[20px] relative'> <h3 class='post-user text-3xl text-blue-500'> " . $user['nom'] . "</h3>" . "<div> <span class='text-gray-500'>Publié le </span> : <span style='color: gray;'>" . htmlspecialchars($publication['date_creation']) . " </span> " . $btn ."<div class='bg-white flex justify-center items-center h-[200px] mb-4 text-gray-500' style='height:200px;'>" . $publication['contenu'] . "</div></div>"; 

                            // Compter les nombre de réaction
                            
                            // Compter les nombres de love
                            $sql_count_reactionLike = "SELECT * FROM reaction_publication WHERE id_publication = ? AND type = ?";
                            $statement_countLike = $db_connexion->prepare($sql_count_reactionLike);
                            $statement_countLike->execute([$publication['id_publication'], "love"]);
                            $countLike = count($statement_countLike->fetchAll());

                            // Compter les nombres de likes
                            $sql_count_reactionHaha = "SELECT * FROM reaction_publication WHERE id_publication = ? AND type = ?";
                            $statement_countHaha = $db_connexion->prepare($sql_count_reactionHaha);
                            $statement_countHaha->execute([$publication['id_publication'], "haha"]);
                            $countHaha = count($statement_countHaha->fetchAll());
                            
                            // Compter les nombres de likes dans la publication
                            $sql_count_reactionAngry = "SELECT * FROM reaction_publication WHERE id_publication = ? AND type = ?";
                            $statement_countAngry = $db_connexion->prepare($sql_count_reactionAngry);
                            $statement_countAngry->execute([$publication['id_publication'], "angry"]);
                            $countAngry = count($statement_countAngry->fetchAll());

                            Reaction("publication", $publication['id_publication'], $countLike, $countAngry, $countHaha);
                            
                            // Afficher tous les commentaires
                            echo "<div class='comments flex flex-col gap-2 my-2'>";
                            foreach ($commentairesList as $com) {
                                $sql_nomCommentataire = "SELECT * FROM compte WHERE id = ?";
                                $stmt_nomCommentaire = $db_connexion->prepare($sql_nomCommentataire);
                                $stmt_nomCommentaire->execute([$com['id_compte']]);
                                $user_commentataire = $stmt_nomCommentaire->fetch(PDO::FETCH_ASSOC);

                                Commentaire( htmlspecialchars($com['contenu']) , $user_commentataire['nom'], $publication['id_publication']);                                
                            }     
                            echo "</div>";

                            echo "<form action='add_commentaire.php' method='get' class='flex flex-col md:flex-row items-start gap-4 md:mt-2' ><textarea type='text' class='p-4' placeholder='Ajouter un commentaire' style='resize:none; width: 280px;' name='contenu'></textarea> <button class='bg-blue-500 px-4 py-2 my-2 text-white' type='submit' value='$id_publication' name='id_publication' style='resize: none;'>Commenter</button></form>";
                            echo "</div>";                                    
                        }
                    } else {
                    echo "<p>Aucune publication n'a été trouvée.</p>";
                    }
                } else {
                    echo "Erreur : connexion à la base de données non établie.";
                }
            ?>

            </div>
        </div>
    </div>
</body>
</html>
