<?php
require 'connexion.php';

$stmt = $pdo->prepare("INSERT INTO Utilisateur (nom, email) VALUES (:nom, :email)");
$stmt->execute([
    'nom' => 'Alice',
    'email' => 'alice@test.com'
]);
echo "Utilisateur ajouté.";
// safe query 
$stmt = $pdo->prepare("SELECT * FROM Utilisateur WHERE email = :email");
$stmt->execute(['email' => 'alice@test.com']);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
echo "Nom : " . $user['nom'];
// anonymous 
$stmt = $pdo->prepare("SELECT * FROM Utilisateur WHERE id = ?");
$stmt->execute([1]);
