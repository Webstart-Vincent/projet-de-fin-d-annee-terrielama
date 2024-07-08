<?php
include 'db_connect.php';

// Exemple de vérification de connexion
session_start();
$userLoggedIn = isset($_SESSION['user_id']);

// Determine which form to open
$openForm = isset($_GET['form']) ? $_GET['form'] : '';
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
?>

<header class="header"> 
    <img class="logo" src="./assets/img/logo.svg" alt="BLISS Logo">
    <div class="user-actions">
        <button style="background-color: transparent; border: none;"><a href="#"><img src="./assets/img/recherche.svg" alt="cherche"></a></button>
        <button style="background-color: transparent; border: none;"><a href="#"><img src="./assets/img/panier.svg" alt="panier"></a></button>
        <?php if ($userLoggedIn): ?>
            <button style="background-color: transparent; border: none;"><a href="compte.php">Mon compte</a></button>
            <button style="background-color: transparent; border: none;"><a href="logout.php">Déconnexion</a></button>
        <?php else: ?>
            <button style="background-color: transparent; border: none;"><a href="connexion.php"><img src="./assets/img/perso.svg" alt="perso"></a></button>
        <?php endif; ?>
    </div>
</header>