<?php
    session_start();

    require_once "verify_session.php";
    require_once "config.php";
    require_once "src/components/Navbar.php";
    require_once "src/components/Head.php";
    require_once "src/components/Reaction.php";
    require_once "src/components/Commentaire.php";
    require_once "src/components/Modals.php";
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
<body class="h-full w-full bg-slate-800 text-white">
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
        <div class="flex-grow lg:w-[60vw] lg:max-h-[100vh] overflow-x-hidden overflow-y-scroll">
            <h2 class="text-3xl m-4 text-blue-500 md:ml-0">Fil d'actualité</h2>
            <form class="flex flex-col md:flex-row gap-8 bg-yellow m-4 md:ml-0" action="add_publication.php" method="post">
                <textarea class="resize-none p-4 border rounded-md border-none w-[calc(100vw - 8px) ] bg-slate-500 text-white md:w-[70%] border-blue-500" placeholder="Quoi de neuf ?" name="publication"></textarea>
                <button class="hover:bg-blue-500 py-4 px-[50px] text-white rounded-xl bg-blue-800" type="submit" >Publier</button>
            </form>

            <!-- Conteneur de toute publication -->
            <div class="m-4 md:ml-0 flex flex-col gap-4" id="container-publication">
            <?php
                
                // Vérifier s'il y a des publications 
                $publicationList = $publication_manager->getAll();

                if (!empty($publicationList))  {                      
                    echo "<h3 class='text-xl text-blue-500'> Toutes les publications :</h3>";                     
                    require "list_publication.php";  
                } 
                else {
                    echo "<p>Aucune publication n'a été trouvée.</p>";
                }            
            ?>
            </div>
        </div>
        
    </div>

    <div
        class="w-[20vw] h-[100vh]"
    >
        <ul class="flex flex-col items-center gap-2 p-4">
            <li class="bg-blue-800 w-[100px]  text-center rounded-md text-bold cursor-pointer hover:bg-blue-500 text-white p-2">Story</li>
            <li class="bg-blue-800 w-[100px]  text-center rounded-md text-bold cursor-pointer hover:bg-blue-500 text-white p-2">Message</li>
        </ul>;
    </div>
    
    
    <script src="src/api/js/delete_publication.js"></script>
</body>
</html>
