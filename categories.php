<?php
include 'db_connect.php';

// Fetch categories
$stmt = $conn->prepare("SELECT * FROM Categories");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catégories</title>
    <link rel="stylesheet" href="./assets/css/style.css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    
    <style>
        .category, .product {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .product img {
            max-width: 100px;
        }
    </style>
</head>
<body>
<?php 
    include("./header.php"); 
    include("./nav.php"); 
?>

<h1>Catégories</h1>
<?php foreach ($categories as $category): ?>
    <div class="category">
        <h2><?php echo htmlspecialchars($category['name']); ?></h2>
        <p><?php echo htmlspecialchars($category['description']); ?></p>
        <img src="<?php echo htmlspecialchars($category['image_url']); ?>" alt="<?php echo htmlspecialchars($category['name']); ?>">
        
        <!-- Fetch products for each category -->
        <?php
        $stmt = $conn->prepare("SELECT p.*, pi.url as image_url FROM Products p 
                                JOIN Categories_Products cp ON p.id = cp.product_id 
                                LEFT JOIN Products_Images pi ON p.id = pi.product_id
                                WHERE cp.category_id = :category_id");
        $stmt->bindParam(':category_id', $category['id']);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <ul>
            <?php foreach ($products as $product): ?>
                <li class="product">
                    <a href="product.php?id=<?php echo $product['id']; ?>">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <p><?php echo htmlspecialchars($product['name']); ?></p>
                        <p>Prix: <?php echo htmlspecialchars($product['price']); ?> €</p>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>
<?php include("./footer.php"); ?>
</body>
</html>
