<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirige si non connecté
    exit;
}

// Récupérez les informations de l'utilisateur depuis la base de données par exemple
$user_id = $_SESSION['user_id'];
// Effectuez une requête SQL pour obtenir les détails de l'utilisateur
// Exemple : SELECT * FROM users WHERE id = $user_id
// Assurez-vous de sécuriser vos requêtes SQL contre les injections SQL si elles incluent des variables utilisateur

// Affichez les détails de l'utilisateur ici
// Exemple : echo "Bienvenue, utilisateur_id";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>site connecté</title>
    <link rel="stylesheet" href="./assets/css/style.css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>
<body>

<?php
include("./nav.php"); 
?>