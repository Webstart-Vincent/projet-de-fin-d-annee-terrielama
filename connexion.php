<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./assets/css/style.css"/>
</head>
<body>

<?php 
          include("./header.php"); 
          include("./nav.php"); 
        ?>
   <div class="connexion_container">
        <button class="close-btn" onclick="closeForm()">×</button>
        <h2>Connecte toi !</h2>
        <?php if (isset($_GET['message'])): ?>
            <div class="message"><?php echo htmlspecialchars($_GET['message']); ?></div>
        <?php endif; ?>
        <form action="connexion.php" method="post" class="form">
            <label for="email">Adresse Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="connexion">Se connecter</button>
            <button><a href="inscription.php">Nouveau membre ? Inscrit toi !</a></button>
        </form>
    </div>

    <script>
        function closeForm() {
            document.querySelector('.connexion_container').style.display = 'none';
        }
    </script>
</body>
</html>

<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: home.php");
            exit;
        } else {
            $message = "Mot de passe incorrect.";
        }
    } else {
        $message = "Aucun compte trouvé avec cet email.";
    }
    $stmt->close();
    $conn->close();

    header("Location: connexion.php?message=" . urlencode($message));
    exit;
}
?>

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
