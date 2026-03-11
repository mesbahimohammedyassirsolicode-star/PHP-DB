<?php
//  Validate the entries
try {
    $pdo = new PDO('mysql:host=localhost;dbname=blogdb', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
try {
    $pdo->query("SELECT * FROM table_inexistante");
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();
}
catch (PDOException $e) {
    file_put_contents('erreurs.log', $e->getMessage(), FILE_APPEND);
    echo "Une erreur est survenue. Contactez l'administrateur.";
}
//  Use prepared statements
$stmt = $pdo->prepare("INSERT INTO Utilisateur (nom, email) VALUES (:nom, :email)");
$stmt->execute([
    'nom' => $nom,
    'email' => $email
]);
echo "Utilisateur ajouté avec succès.";
//Manage errors without information leaks
try {
    // Code d’insertion
} catch (PDOException $e) {
    file_put_contents('logs/errors.log', $e->getMessage(), FILE_APPEND);
    echo "Une erreur est survenue. Contactez l’administrateur.";
}
