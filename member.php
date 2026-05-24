<?php
$xml = simplexml_load_file("club.xml");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Membres du Club</title>
<style>
    body { font-family: Arial; background:#f9f9f9; }
    h2 { text-align:center; color:#004080; }
    table { width:80%; margin:20px auto; border-collapse:collapse; }
    th, td { border:1px solid #ccc; padding:8px; text-align:center; }
    th { background:#004080; color:#fff; }
    tr:nth-child(even){ background:#f2f2f2; }

</style>
</head>
<body>
<h2>Liste des Membres</h2>
<table>
<tr><th>ID</th><th>Nom Complet</th><th>Email</th><th>Catégorie</th></tr>
<?php
foreach ($xml->membres->membre as $m) {
    $id = (string)$m['id'];
    $nomComplet = $m->prenom . " " . $m->nom;
    $email = (string)$m->email;
    $catId = (string)$m['categorieRef'];
    $catLibelle = "";
    foreach ($xml->categories->categorie as $c) {
        if ($c['id'] == $catId) $catLibelle = (string)$c['libelle'];
    }
    echo "<tr><td>$id</td><td>$nomComplet</td><td>$email</td><td>$catLibelle</td></tr>";
}
?>
</table>

</body>
</html>
