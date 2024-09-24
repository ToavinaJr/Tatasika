<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Tatasika</title>
        <!-- <link rel="stylesheet" href="styles/login.css"> -->
        <link rel="stylesheet" href="./output.css">
    </head>
    <body class="w-[100vw] h-[100vh] flex justify-center items-center">
        <div class="flex flex-col gap-4 justify-center items-center border border-sm shadow-md rounded-md p-8">
            <h1 class="text-3xl text-blue-500">Connexion</h2>
            <form action="login_submit.php" method="POST" class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label class="text-md text-slate-900" for="email">Email</label>
                    <input class="border border-gray-400 p-4 rounded-md" type="email" name="email" placeholder="Adresse" required>
                </div>
                <div class="flex flex-col gap-2">            
                    <label class="text-md text-slate-900" for="">Mot de passe</label>
                    <input class="border border-gray-400 p-4 rounded-md" type="password" name="password" placeholder="Mot de passe" required>
                </div>
                <input type="submit" class="bg-blue-500 hover:bg-blue-900 cursor-pointer text-white mt-6 rounded-md p-4" value="Se connecter">
            </form>
        </div>

    </body>
</html>