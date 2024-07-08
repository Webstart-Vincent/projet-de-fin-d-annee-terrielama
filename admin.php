<?php
include 'db_connect.php';

// Traitement pour ajouter une nouvelle catégorie
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    $stmt = $conn->prepare("INSERT INTO Categories (name, description, image_url) VALUES (:name, :description, :image_url)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image_url', $image_url);
    $stmt->execute();
}

// Traitement pour ajouter un nouveau produit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    $stmt = $conn->prepare("INSERT INTO Products (name, description, price) VALUES (:name, :description, :price)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->execute();

    $product_id = $conn->lastInsertId(); // Récupère l'ID du produit inséré

    // Associer le produit à la catégorie
    $stmt = $conn->prepare("INSERT INTO Categories_Products (category_id, product_id) VALUES (:category_id, :product_id)");
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
</head>
<body>
    <h1>Administration</h1>

    <!-- Formulaire pour ajouter une catégorie -->
    <h2>Ajouter une catégorie</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br>
        <label for="image_url">URL de l'image :</label><br>
        <input type="text" id="image_url" name="image_url"><br><br>
        <input type="submit" name="add_category" value="Ajouter Catégorie">
    </form>

    <hr>

    <!-- Formulaire pour ajouter un produit -->
    <h2>Ajouter un produit</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br>
        <label for="price">Prix :</label><br>
        <input type="number" id="price" name="price" min="0" step="0.01" required><br>
        <label for="category_id">Catégorie :</label><br>
        <select id="category_id" name="category_id" required>
            <?php
            $stmt = $conn->prepare("SELECT * FROM Categories");
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categories as $category) {
                echo "<option value=\"{$category['id']}\">{$category['name']}</option>";
            }
            ?>
        </select><br><br>
        <input type="submit" name="add_product" value="Ajouter Produit">
    </form>
</body>
</html>
