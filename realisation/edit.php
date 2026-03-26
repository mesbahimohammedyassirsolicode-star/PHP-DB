<?php
require 'config.php';

$id = $_GET['id'] ?? null;

$stmt = $pdo->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$product) die("Product not found");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE product SET name=?, price=?, description=?, category=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['name'],
        $_POST['price'],
        $_POST['description'],
        $_POST['category'],
        $id
    ]);

    header("Location: catalogue.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
        <link rel="stylesheet" href="style.css">

</head>
<body>
    <form method="POST">
    <input name="name" value="<?= $product['name'] ?>"><br>
    <input name="price" value="<?= $product['price'] ?>"><br>
    <textarea name="description"><?= $product['description'] ?></textarea><br>
    <input name="category" value="<?= $product['category'] ?>"><br>
    <button>Update</button>
</form>
</body>
</html>

