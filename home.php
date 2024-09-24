<?php
    session_start();
    include "verify_session.php";
    require_once "config.php";
    require_once "components/Commentaire.php";
    require_once "components/Reaction.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Votre Site</title>
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="navbar">
        <div class="logo">Tata Sika</div>
        <div>Bienvenu <?php echo $_SESSION['user'] ;?></div>
        <div class="nav-links">
            <a href="logout.php">Deconnexion</a>
        </div>
    </div>
    <div class="container">
        <div class="sidebar">
            <h3>Amis</h3>
            <ul>
                <li>
                    <div class="card">
                        <div class="avatar">
                            <img src="https://via.placeholder.com/150" alt="Avatar">
                        </div>
                        <h2 class="name">RAKOTO</h2>
                    </div>
                </li>
                <li>Ami 2</li>
                <li>Ami 3</li>
            </ul>
        </div>
        <div class="feed">
            <h2>Fil d'actualité</h2>
            <div class="post-form">
                <form action="add_publication.php" method="post">
                    <textarea placeholder="Quoi de neuf ?" name="publication"></textarea>
                    <button type="submit" >Publier</button>
                </form>
            </div>
            <div class="posts">
            <?php
                // Vérifier que la connexion à la base de données est initialisée
                if (isset($db_connexion)) {
                    // Préparer et exécuter la requête pour récupérer toutes les publications
                    $sql_allPost = "SELECT * FROM publication";
                    $stmtPublication = $db_connexion->prepare($sql_allPost);
                    $stmtPublication->execute();

                    // Récupérer toutes les publications
                    $publicationList = $stmtPublication->fetchAll(PDO::FETCH_ASSOC);

                    // Vérifier s'il y a des publications
                    if (!empty($publicationList)) {
                        // Parcourir les publications et les afficher
                        echo "<h3> Toutes les publications :</h3>";
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
                                $btn = "<a href='deletePublication.php?delete=$id_publication' class='x-btn'><i class='fa-solid fa-trash' style='color: blue;'></i></a>";
                            
                            echo "<div class='post'> <h3 class='post-user'> " . $user['nom'] . "</h3>" . "<div> Publié le : <span style='color: gray;'>" . htmlspecialchars($publication['date_creation']) . " </span> " . $btn ."<div style='padding: 20px 0'>" . $publication['contenu'] . "</div></div>"; 
                            Reaction("publication", $publication['id_publication']);
                            // Afficher tous les commentaires
                            echo "<div class='comments'>";
                            foreach ($commentairesList as $com) {
                                $sql_nomCommentataire = "SELECT * FROM compte WHERE id = ?";
                                $stmt_nomCommentaire = $db_connexion->prepare($sql_nomCommentataire);
                                $stmt_nomCommentaire->execute([$com['id_compte']]);
                                $user_commentataire = $stmt_nomCommentaire->fetch(PDO::FETCH_ASSOC);

                                Commentaire( htmlspecialchars($com['contenu']) , $user_commentataire['nom'], $publication['id_publication']);
                                
                            }     
                            echo "</div>";

                            echo "<form action='add_commentaire.php' method='get'><input type='text' style='padding: 10px; margin-top: 20px; min-width: 300px; margin-right: 10px; ' placeholder='Ajouter un commentaire' name='contenu'/> <button style='border-radius: 5px;' type='submit' value='$id_publication' name='id_publication'>Commenter</button></form>";
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
