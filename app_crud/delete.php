<?php 
require 'selet.php';
if(isset($_GET["id"])){
    $id=$_GET['id'];
    $sql='DELETE FROM utilisateur where id=?';
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);
echo "User deleted";
}
?>