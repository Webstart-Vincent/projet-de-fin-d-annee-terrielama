<?php
session_start();
include 'db_connect.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Veuillez vous connecter pour ajouter des produits au panier']);
    exit;
}

// Récupérez les données envoyées par JavaScript
$product_name = isset($_POST['name']) ? $_POST['name'] : '';
$product_description = isset($_POST['description']) ? $_POST['description'] : '';
$product_image = isset($_POST['image']) ? $_POST['image'] : '';
$product_price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
$user_id = $_SESSION['user_id']; // Récupérez l'ID de l'utilisateur depuis la session

// Vérifiez si les données nécessaires sont présentes
if (empty($product_name) || $product_price <= 0 || $quantity <= 0) {
    echo json_encode(['success' => false, 'message' => 'Paramètres manquants ou invalides']);
    exit;
}

// Commencez une transaction pour assurer l'intégrité des données
$conn->begin_transaction();

try {
    // Insérez la commande dans la table Orders
    $stmt = $conn->prepare("INSERT INTO Orders (user_id, amount) VALUES (?, ?)");
    $total_amount = $product_price * $quantity;
    $stmt->bind_param("id", $user_id, $total_amount);
    $stmt->execute();
    $order_id = $stmt->insert_id; // Récupérez l'ID de la commande insérée
    $stmt->close();

    // Insérez les détails de la commande dans la table Orders_Products
    $stmt = $conn->prepare("INSERT INTO Orders_Products (order_id, price, name, product_id, quantity) VALUES (?, ?, ?, ?, ?)");
    // Remplacer product_id par une valeur par défaut ou générer un ID temporaire si nécessaire
    $product_id = 0; // ou une valeur par défaut si elle ne peut pas être nulle
    $stmt->bind_param("idssi", $order_id, $product_price, $product_name, $product_id, $quantity);
    $stmt->execute();
    $stmt->close();

    // Validez la transaction et effectuez les changements dans la base de données
    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Produit ajouté au panier avec succès']);
} catch (Exception $e) {
    // Annulez la transaction en cas d'erreur
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout au panier. Veuillez réessayer.']);
}

// Fermez la connexion à la base de données
$conn->close();
?>
