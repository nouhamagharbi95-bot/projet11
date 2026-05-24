<?php
$xml = simplexml_load_file("club.xml");

$categories = [];
foreach ($xml->categories->categorie as $cat) {
    $categories[(string)$cat['id']] = (string)$cat['libelle'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Concours</title>

    <style>
        body {
            font-family: Arial;
            background: #eef2f7;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #1f3b57;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #1f3b57;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f4f7fc;
        }
    </style>

</head>

<body>

<div class="container">

<h1>Liste des Concours</h1>

<table>
<tr>
    <th>Titre</th>
    <th>Date</th>
    <th>Catégorie</th>
    <th>Coefficient</th>
</tr>

<?php
foreach ($xml->concours->concours as $c) {

    $catId = (string)$c['categorieRef'];
    $libelle = isset($categories[$catId]) ? $categories[$catId] : "Inconnu";

    echo "<tr>";
    echo "<td>".$c->titre."</td>";
    echo "<td>".$c['date']."</td>";
    echo "<td>".$libelle."</td>";  
    echo "<td>".$c['coefficient']."</td>";
    echo "</tr>";
}
?>

</table>

</div>

</body>
</html>
