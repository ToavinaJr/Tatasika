<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="styles/signup.css">
</head>
<body>
    <div class="container">
        <div class="glass-card">
            <h1>Inscription</h1>
            <form action="signup_submit.php" method="POST">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required>

                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Votre prénom">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required>

                <label for="password-1">Mot de passe</label>
                <input type="password" id="password" name="password-1" placeholder="Votre mot de passe" required>

                <label for="password-2">Confirmation mot de passe</label>
                <input type="password" id="password" name="password-2" placeholder="Confirmer votre mot de passe" required>
                <button type="submit" class="btn">S'inscrire</button>
            </form>

            <p>Déjà un compte ? <a href="login.php" class="link">Se connecter</a></p>
        </div>
    </div>
</body>
</html>
