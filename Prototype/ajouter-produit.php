<?php
require 'config.php';

$errors = [];

if(isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);

    // Validation
    if(empty($name)) {
        $errors[] = "Name is required";
    }

    if(empty($price) || !is_numeric($price)) {
        $errors[] = "Valid price is required";
    }

    if(empty($description)) {
        $errors[] = "Description is required";
    }

    if(empty($category)) {
        $errors[] = "Category is required";
    }

    // Insert
    if(empty($errors)) {
        $sql = "INSERT INTO product (name, price, description, category) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $price, $description, $category]);

        header("Location: catalogue.php?success=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add Product</h2>



<form method="POST">
    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="text" name="price" placeholder="Price"><br><br>
    <textarea name="description" placeholder="Description"></textarea><br><br>
    <input type="text" name="category" placeholder="Category"><br><br>
    <button type="submit" name="submit">Add</button>
</form>

<a href="catalogue.php">Back</a>

</body>
</html>