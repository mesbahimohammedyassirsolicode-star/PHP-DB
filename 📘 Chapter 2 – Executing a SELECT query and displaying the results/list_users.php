<?php
require 'connexion.php';

try {
    $sql = "SELECT * FROM Utilisateur";
    $stmt = $pdo->query($sql);

    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($utilisateurs as $user) {
        echo "ID : " . $user['id'] . " - Nom : " . $user['nom'] . " - Email : " . $user['email'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
