<?php 
require 'config.php';

if(isset($_GET["id"])){

    $id = $_GET['id'];

    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: admin.php");
}
?>