<?php
session_start();
include 'db_connect.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Veuillez vous connecter pour effectuer un achat']);
    exit;
}

// Récupérez les données envoyées par JavaScript
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
$user_id = $_SESSION['user_id']; // Récupérez l'ID de l'utilisateur depuis la session

// Vérifiez si les données nécessaires sont présentes
if (!$product_id || $quantity <= 0) {
    echo json_encode(['success' => false, 'message' => 'Paramètres manquants ou invalides']);
    exit;
}

// Récupérez le prix et le nom du produit depuis la base de données
$stmt = $conn->prepare("SELECT name, price FROM Products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Produit non trouvé']);
    exit;
}

$product = $result->fetch_assoc();
$product_name = $product['name'];
$product_price = $product['price'];
$stmt->close();

// Calculez le montant total de l'achat
$total_amount = $product_price * $quantity;

// Commencez une transaction pour assurer l'intégrité des données
$conn->begin_transaction();

// Insérez la commande dans la table Orders
$stmt = $conn->prepare("INSERT INTO Orders (user_id, amount) VALUES (?, ?)");
$stmt->bind_param("id", $user_id, $total_amount);
$stmt->execute();
$order_id = $stmt->insert_id; // Récupérez l'ID de la commande insérée
$stmt->close();

// Insérez les détails de la commande dans la table Orders_Products
$stmt = $conn->prepare("INSERT INTO Orders_Products (order_id, price, name, product_id, quantity) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("idssi", $order_id, $product_price, $product_name, $product_id, $quantity);
$stmt->execute();
$stmt->close();

// Validez la transaction et effectuez les changements dans la base de données
$conn->commit();

// Fermez la connexion à la base de données
$conn->close();

// Répondez avec un JSON pour indiquer que l'achat a été effectué avec succès
echo json_encode(['success' => true, 'message' => 'Achat effectué avec succès']);
?>
