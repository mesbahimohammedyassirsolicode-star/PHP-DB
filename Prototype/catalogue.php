<?php
require 'config.php';

$message = '';
if(isset($_GET['success'])) {
    $message = "Product added successfully";
}

$sql = "SELECT * FROM product";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Catalogue</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Catalogue</h2>

<p>
    <?php echo $message; ?>
</p>
<a href="ajouter-produit.php">Add Product</a>

<hr>

<div class="container">
<?php foreach($products as $product): ?>
    <div class="card">
        <h3><?php echo $product['name']; ?></h3>
        <p><?php echo $product['price']; ?> DH</p>
        <a class="btn" href="details.php?id=<?php echo $product['id']; ?>">Details</a>
    </div>
<?php endforeach; ?>
</div>
</body>
</html>