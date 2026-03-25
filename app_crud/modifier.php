<?php
require "config.php";

$user = null;
$errors = [];

if (isset($_GET['id'])) {
  $id =  $_GET['id'];

  if ($id <= 0) {
    die("Invalid ID.");
  }

  $sql = "SELECT * FROM utilisateur WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(["id" => $id]);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$user) {
    die("User not found.");
  }
}

if (isset($_POST['modifier'])) {
  $id =  ($_POST['id'] ?? 0);
  $name = trim($_POST['name'] ?? "");
  $email = trim($_POST['email'] ?? "");
  $telephone = trim($_POST['telephone'] ?? "");
  $age =  ($_POST['age'] ?? 0);

  if (empty($name) || empty($email) || empty($telephone) || empty($age)) {
    $errors[] = "All fields are required.";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address.";
  }

  if ($age < 18) {
    $errors[] = "You must be at least 18 years old.";
  }

  if (empty($errors)) {
    $sql = "UPDATE utilisateur 
                SET nom = :name,
                    email = :email,
                    age = :age,
                    telephone = :telephone
                WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      "id" => $id,
      "name" => $name,
      "email" => $email,
      "telephone" => $telephone,
      "age" => $age
    ]);

    header("Location: Affichage.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
</head>

<body>

  <h2>Edit User</h2>

  <?php foreach ($errors as $error): ?>
    <p style="color:red;"><?= $error ?></p>
  <?php endforeach; ?>

  <?php if ($user): ?>
    <form method="POST">
      <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

      <label>Name</label>
      <input type="text" name="name" value="<?= htmlspecialchars($user['nom']) ?>">

      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">

      <label>Telephone</label>
      <input type="tel" name="telephone" value="<?= htmlspecialchars($user['telephone']) ?>">

      <label>Age</label>
      <input type="number" name="age" value="<?= htmlspecialchars($user['age']) ?>">

      <button type="submit" name="modifier">Update</button>
    </form>
  <?php endif; ?>

</body>

</html>