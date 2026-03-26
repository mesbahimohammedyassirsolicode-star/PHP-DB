<?php
require 'config.php';

// SEARCH 
$search = $_GET['search'] ?? "";

if (!empty($search)) {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE description LIKE ?");
    $stmt->execute(["%" . $search . "%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM product");
}

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// count
$count = $pdo->query("SELECT COUNT(*) as total FROM product")->fetch()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Admin Dashboard</h2>

<!-- TOTAL -->
<div class="success">
    Total Products: <b><?php echo $count; ?></b>
</div>

<!-- SEARCH -->
<form method="GET">
    <input type="text" name="search" placeholder="Search in description..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Search</button>
</form>

<!-- ADD BUTTON -->
<p style="text-align:center;">
    <a class="btn" href="ajouter-produit.php">+ Add Product</a>
</p>

<hr>

<!-- TABLE -->
<table border="1" cellpadding="10" style="margin:auto; background:white;">
<tr style="background:#007bff; color:white;">
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Category</th>
        <th>description</th>
    <th>Actions</th>
</tr>

<?php if(count($products) > 0): ?>
    <?php foreach($products as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td><?= $p['price'] ?> DH</td>
        <td><?= htmlspecialchars($p['category']) ?></td>
        <td>
            <?= htmlspecialchars($p['description'])  ?>
        </td>
        <td>
            <a class="btn" href="details.php?id=<?= $p['id'] ?>">View</a>
            <a class="btn" href="edit.php?id=<?= $p['id'] ?>">Edit</a>
            <a class="btn" href="delete.php?id=<?= $p['id'] ?>">delete</a>

            
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5" style="text-align:center;">No products found</td>
    </tr>
<?php endif; ?>

</table>

</body>
</html>