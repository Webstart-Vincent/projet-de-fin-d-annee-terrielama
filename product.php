<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Fetch product details
    $stmt = $conn->prepare("SELECT * FROM Products WHERE id = :id");
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($product) {
        // Fetch images for the product
        $stmt = $conn->prepare("SELECT url FROM Products_Images WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Produit non trouvé.";
        exit;
    }
} else {
    echo "Aucun produit sélectionné.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produit</title>
</head>
<body>
<?php 
    include("./header.php"); 
    include("./nav.php"); 
?>

<?php if (isset($product)): ?>
    <h1><?php echo htmlspecialchars($product['Infinity Cube']); ?></h1>
    <?php foreach ($images as $image): ?>
        <img src="<?php echo htmlspecialchars($image['./assets/img/categorie/objet/objet1.jpg']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
    <?php endforeach; ?>
    <p><?php echo htmlspecialchars($product['Accessoire de stimulation sensorielle fascinant qui occupera à la fois vos mains et votre esprit
']); ?></p>
    <p>Prix: <?php echo htmlspecialchars($product['11,99']); ?> €</p>
<?php endif; ?>

<?php include("./footer.php"); ?>
</body>
</html>
