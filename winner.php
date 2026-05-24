<?php
$xml = simplexml_load_file("club.xml");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Vainqueurs des Concours</title>
<style>
    body { font-family: Arial; background:#f9f9f9; }
    h2 { text-align:center; color:#004080; }
    table { width:70%; margin:20px auto; border-collapse:collapse; }
    th, td { border:1px solid #ccc; padding:8px; text-align:center; }
    th { background:#004080; color:#fff; }
    tr:nth-child(even){ background:#f2f2f2; }
</style>
</head>
<body>
<h2>Vainqueurs des Concours</h2>
<table>
<tr><th>Concours</th><th>Membre</th><th>Score</th></tr>
<?php
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
?>

</table>
</body>
</html>
