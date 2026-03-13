<?php
require 'config.php';

$sql = "SELECT id, nom, email,telephone,age FROM utilisateur";
$stmt = $pdo->query($sql);
?>

<table border="1">
<tr>
<th>ID</th>
<th>Nom</th>
<th>Email</th>
<th>telephone</th>
<th>
    age
</th>
<th>Actions</th>
</tr>

<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>

<tr>
<td><?= $row["id"] ?></td>
<td><?= $row["nom"] ?></td>
<td><?= $row["email"] ?></td>
<td><?= $row["telephone"] ?></td>
<td><?= $row["age"] ?></td>

<td>
<a href="modifier.php?id=<?= $row["id"] ?>">Modifier</a>
<a href="delete.php?id=<?= $row["id"] ?>">Supprimer</a>
</td>

</tr>


<?php } ?>

</table>