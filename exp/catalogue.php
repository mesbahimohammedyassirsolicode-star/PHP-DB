<?php
require 'config.php';
$message = '';
if(isset($_GET['success'])) {
    $message = "Product added successfully";
}
$sql='SELECT * FROM product';
$stmt =$pdo->query($sql);
$products=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>