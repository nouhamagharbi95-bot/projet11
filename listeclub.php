<?php
$xml = simplexml_load_file("club.xml");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Club Info-Tech</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(120deg, #f4f4f4, #e8dcd9, #c9a9a2, #874f43);
        color: #333;
        margin: 20px;
    }
    h1 {
        text-align: center;
        color: #874f43;
        margin-bottom: 30px;
    }
    h2 {
        color: #b39292;
        margin-top: 40px;
        text-align: center;
    }
    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        background-color: #fff;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }
    th {
        background-color: #874f43;
        color: #fff;
    }
    tr:nth-child(even) {
        background-color: #f9e9e9;
    }
    tr:hover {
        background-color: #f1d6d6;
    }
</style>
</head>
<body>

<h1>Système du Club Info-Tech</h1>

<?php
// Membres
echo "<h2>Liste des Membres</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Nom Complet</th><th>Email</th><th>Catégorie</th></tr>";
foreach ($xml->membres->membre as $m) {
    $id = (string)$m['id'];
    $nomComplet = $m->prenom . " " . $m->nom;
    $email = (string)$m->email;
    $catId = (string)$m['categorieRef'];
    $catLibelle = "";
    foreach ($xml->categories->categorie as $c) {
        if ($c['id'] == $catId) {
            $catLibelle = (string)$c['libelle'];
        }
    }
    echo "<tr><td>$id</td><td>$nomComplet</td><td>$email</td><td>$catLibelle</td></tr>";
}
echo "</table>";

// Concours
echo "<h2>Liste des Concours</h2>";
echo "<table>";
echo "<tr><th>Titre</th><th>Date</th><th>Coefficient</th><th>Catégorie</th></tr>";
foreach ($xml->concours->concours as $c) {
    $titre = (string)$c->titre;
    $date = (string)$c['date'];
    $coef = (string)$c['coefficient'];
    $catId = (string)$c['categorieRef'];
    $catLibelle = "";
    foreach ($xml->categories->categorie as $cat) {
        if ($cat['id'] == $catId) {
            $catLibelle = (string)$cat['libelle'];
        }
    }
    echo "<tr><td>$titre</td><td>$date</td><td>$coef</td><td>$catLibelle</td></tr>";
}
echo "</table>";

// Résultats
echo "<h2>Résultats des Concours</h2>";
echo "<table>";
echo "<tr><th>Concours</th><th>Membre</th><th>Score</th></tr>";
foreach ($xml->concours->concours as $c) {
    $titre = (string)$c->titre;
    $coef = (float)$c['coefficient'];
    foreach ($c->participants->participant as $p) {
        $membre = (string)$p['membreRef'];
        $complexite = (int)$p->complexite;
        $temps = (int)$p->tempsExecution;
        $score = ($complexite + $temps) * $coef;
        echo "<tr><td>$titre</td><td>$membre</td><td>".round($score,2)."</td></tr>";
    }
}
echo "</table>";

// Vainqueurs
echo "<h2>Vainqueurs des Concours</h2>";
echo "<table>";
echo "<tr><th>Concours</th><th>Membre</th><th>Score</th></tr>";
foreach ($xml->concours->concours as $c) {
    $titre = (string)$c->titre;
    $coef = (float)$c['coefficient'];
    $maxScore = -1;
    $winner = "";
    foreach ($c->participants->participant as $p) {
        $membre = (string)$p['membreRef'];
        $complexite = (int)$p->complexite;
        $temps = (int)$p->tempsExecution;
        $score = ($complexite + $temps) * $coef;
        if ($score > $maxScore) {
            $maxScore = $score;
            $winner = $membre;
        }
    }
    echo "<tr><td>$titre</td><td>$winner</td><td>".round($maxScore,2)."</td></tr>";
}
echo "</table>";
?>

</body>
</html>
