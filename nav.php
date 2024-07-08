<?php
include 'db_connect.php';
session_start();
$userLoggedIn = isset($_SESSION['user_id']);

$openForm = isset($_GET['form']) ? $_GET['form'] : '';
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
?>



    <nav class="nav">
    <ul class="nav_items">
        <li class="nav_item">
            <a href="index.php" class="nav_link">Accueil</a>
            <div class="dropdown">
                <a href="#" class="nav_link" id="categorie">Catégories</a>
                <ul class="dropdown_content">
                    <li><a href="categories.php">Objets thérapeutiques</a></li>
                    <li><a href="categorie2.php">Matériel de relaxation</a></li>
                    <li><a href="categorie3.php">Infusion</a></li>
                </ul>
            </div>
            <a href="#" class="nav_link">Contact</a>
            <a href="#" class="nav_link">Newsletter</a>
          
        </li>
    </ul>
</nav>
