<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <!-- <link rel="stylesheet" href="styles/index.css"> -->
    <link rel="stylesheet" href="./output.css">
</head>
<body class="bg-slate-50 w-[100vw] h-[100vh] flex justify-center items-center">
    <div class="w-full h-full flex justify-center items-center p-12">
        <div class="bg-white backdrop-blur-sm rounded-md p-8 shadow-md border border-slate-200 text-center w-[500px]">
            <h1 class="text-3xl text-blue-500">Bienvenue sur Tata Sika !</h1>
            <p class="text-slate-500 my-4">Nous sommes ravis de vous accueillir. Veuillez vous connecter ou vous inscrire pour continuer.</p>
            <div class="flex flex-col justify-center items-center gap-4 pt-4" >
                <a href="signup.php" class="text-md text-white bg-blue-500 hover:bg-blue-800 rounded-md p-4 px-8 w-[200px] backdrop-blur-md" id="sign-up="signup.php" class="text-white bg-red-500 rounded-md p-4 text-xl &w-[200px] backdrop-blur-md" id="sign-up">Inscription</a>
                <a href="login.php"  class="text-md text-white bg-green-500 hover:bg-green-800 rounded-md py-4 px-6 w-[200px] backdrop-blur-sm" id="sign-in">Connexion</a>
                <a href="forgot_password.php" class="text-green-500 hover:underline" id="forgot-pwd">Mot de passe oublié</a>
            </div>
        </div>
    </div>
</body>
</html>
