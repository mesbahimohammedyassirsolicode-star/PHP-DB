<?php 
require 'config.php';
$errors = '';
if(isset($_POST['add']))
{

$name=trim($_POST['name']);
$price=trim($_POST['price']);
$catagorie=trim($_POST['catagorie']);
$descrption=trim($_POST['description']);
//validation
if(
    empty($name) && empty($price) && empty($catagorie) && empty($description)
){
    $errors="all the fileds required";
}
 if(empty($errors)) {
        $sql = "INSERT INTO product (name, price, description, category) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $price, $description, $catagorie]);
                header("Location: catalogue.php?success=1");

        
        exit;


 }


}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
    <label>name</label>
    <input type="text" name="name">
    <label >price</label>
    <input type="number" name="price">
    <label >catagorie</label>
    <input type="text" name="catagorie">
    <label>description</label>
    <input type="text" name="description">
    <button type="submit" name="add">add</button>
    </form>
    <p> <?= $errors ?></p>
</body>
</html>