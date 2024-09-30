<?php
    session_start();
    function Navbar() {
?>
    <div class="flex bg-blue-500 text-white p-4 text-md lg:text-xl justify-between items-center">
        <div class="text-3xl">Tata Sika</div>
        <h1>
            Bienvenu <?= htmlspecialchars($_SESSION['user']) ;?>
        </h1>
        
        <div class="bg-blue-300 p-2 rounded-md">
            <a href="logout.php" class="w-ful h-full">Deconnexion</a>
        </div>
    </div>
<?php
    }
?>