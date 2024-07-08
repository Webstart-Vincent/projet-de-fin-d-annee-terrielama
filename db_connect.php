<?php

$servername = "127.0.0.1";
$username = "u220436049_dv23terrie"; // Remplacez par votre nom d'utilisateur MySQL
$password = "ckqyWJjVaqu5uejI";    // Remplacez par votre mot de passe MySQL
$dbname = "u220436049_dv23terrie";   // Nom de la base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Définir le jeu de caractères à utiliser lors de la communication avec la base de données
if (!$conn->set_charset("utf8mb4")) {
    printf("Erreur lors du chargement du jeu de caractères utf8mb4 : %s\n", $conn->error);
    exit();
}
?>