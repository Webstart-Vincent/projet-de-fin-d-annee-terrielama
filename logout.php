<?php
session_start();
include 'db_connect.php';

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Déboguer : Afficher les variables de session avant la suppression
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";

    // Supprimer les données de l'utilisateur de la base de données
    $sql = "DELETE FROM Users WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    }

    // Détruire toutes les variables de session
    $_SESSION = array();

    // Si vous voulez détruire complètement la session, effacez aussi le cookie de session.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 40000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Déboguer : Afficher les variables de session après les avoir vidées
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";

    // Finalement, détruire la session.
    session_destroy();

    // Déboguer : Afficher un message de confirmation de la destruction de la session
    echo "Session détruite";

    // Rediriger vers la page d'accueil après un délai
    header("refresh:2;url=index.php");
    exit;
} else {
    echo "Aucun utilisateur connecté.";
    header("refresh:2;url=index.php");
    exit;
}
?>
