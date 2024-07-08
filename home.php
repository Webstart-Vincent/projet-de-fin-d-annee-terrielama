<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <title>Accueil</title>
</head>
<body>
<?php 
          include("./header.php"); 
          include("./nav.php"); 
          echo "Bienvenue " . $_SESSION['first_name'] . "!";
        ?>

    <!-- ----------content------------------ -->
    
        <section class="container">
            <div class="content">
                <h1>Santé mentale</h1>
                <h2>Votre bien-être commence ici</h2>
                <p>Bliss, une plateforme dédiée à votre bien-être, offrant une gamme variée de produits et de ressources sélectionnées avec soin afin de favoriser votre équilibre mental et physique optimal.</p>
                <button class="savoir"><a href="./info.php" class="btn">En savoir plus</a></button>
            </div>
        </section>
    
<!-- --------------FOOTER--------------- -->

<?php 
          include("./footer.php"); 
        ?>

  </body>
</html>