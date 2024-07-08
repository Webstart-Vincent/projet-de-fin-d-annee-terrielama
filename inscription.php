<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./assets/css/style.css"/>

</head>
<body>

<?php 
          include("./header.php"); 
          include("./nav.php"); 
        ?>
<div class="inscription_container">
        <button class="close-btn" onclick="closeForm()">×</button>
        <h2>Inscription</h2>
        <?php if (isset($_GET['message'])): ?>
            <div class="message"><?php echo htmlspecialchars($_GET['message']); ?></div>
        <?php endif; ?>
        <form action="inscription.php" method="post" class="form">
            <label for="prenom">Prénom</label>
            <input type="text" id="first_name" name="prenom" required>
            <label for="nom">Nom</label>
            <input type="text" id="last_name" name="nom" required>
            <label for="email">Adresse Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            <label for="password_confirm">Confirmer le mot de passe</label>
            <input type="password" id="password_confirm" name="password_confirm" required>
            <button type="submit" name="inscription">S'inscrire</button>
            <button><a href="connexion.php">Tu as déjà un compte ? Connecte-toi !</a></button>
        </form>
    </div>

    <script>
        function closeForm() {
            document.querySelector('.inscription_container').style.display = 'none';
        }
    </script>
</body>
</html>

<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        $message = "Les mots de passe ne correspondent pas.";
        header("Location: inscription.php?message=" . urlencode($message));
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO Users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $prenom, $nom, $email, $hashed_password);
    
    if ($stmt->execute()) {
        $message = "Inscription réussie, veuillez vous connecter.";
        header("Location: connexion.php?message=" . urlencode($message));
    } else {
        $message = "Erreur lors de l'inscription.";
        header("Location: inscription.php?message=" . urlencode($message));
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

</body>
</html>

   <style>
.inscription_container,
.connexion_container {
width: 90%; /* Largeur du conteneur */
max-width: 400px; /* Largeur maximale du conteneur */
background-color: #fff;
padding: 20px;
margin: 50px auto;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.inscription_container h2,
.connexion_container h2 {
text-align: center; /* Centrage du titre */
margin-bottom: 20px;
color: #333;
}

.inscription_container form,
.connexion_container form {
display: flex;
flex-direction: column;
}

.inscription_container label,
.connexion_container label {
margin-bottom: 8px;
}


.inscription_container input[type="text"],
.inscription_container input[type="email"],
.inscription_container input[type="password"],
.inscription_container button {
padding: 10px;
margin-bottom: 15px;
border: 1px solid #ccc;
border-radius: 4px;
font-size: 16px;
}
.connexion_container input[type="text"],
.connexion_container input[type="email"],
.connexion_container input[type="password"],
.connexion_container button {
padding: 10px;
margin-bottom: 15px;
border: 1px solid #ccc;
border-radius: 4px;
font-size: 16px;
}

.inscription_container button,
.connexion_container button {
background-color: #a399cb;
color: white;
border: none;
cursor: pointer;
}
.inscription_container button:hover,
.connexion_container button:hover {
background-color: #a390cb;
}

/* Media queries pour tablettes et mobiles */
@media screen and (max-width: 768px) {
.inscription_container,
.connexion_container {
    width: 90%;
    max-width: 90%; /* Ajustement pour les écrans plus petits */
}
}
   </style>

<!-- --------------FOOTER--------------- -->

<?php 
          include("./footer.php"); 
        ?>
