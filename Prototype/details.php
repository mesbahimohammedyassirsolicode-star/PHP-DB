<?php
require 'config.php';

if(!isset($_GET['id'])) {
    die("No product selected");
}

$id = ($_GET['id']);

$sql = "SELECT * FROM product WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$product) {
    exit("Product not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Product Details</h2>

<h3><?php echo $product['name']; ?></h3>
<p>Price: <?php echo $product['price']; ?> DH</p>
<p>Description: <?php echo $product['description']; ?></p>
<p>Category: <?php echo $product['category']; ?></p>

<a href="catalogue.php">Back</a>

</body>
</html>