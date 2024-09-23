<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Glassmorphism</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
<div class="container">
    <div class="glass-card">
        <h1>Connexion</h2>

        <form action="login_submit.php" method="POST">
            <input type="email" name="email" placeholder="Adresse" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" value="Se connecter">
        </form>
    </div>
</div>

</body>
</html>