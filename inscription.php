<?php

$message = "";

if(isset($_POST['inscrire'])) {

    $idConcours = $_POST['concours'];
    $complexite = $_POST['complexite'];
    $temps = $_POST['temps'];

    $nouveauMembre = "M009";

    $participantXML = "<participant membreRef=\"$nouveauMembre\">
        <complexite>$complexite</complexite>
        <tempsExecution>$temps</tempsExecution>
    </participant>";

  

    $xquery = "
    insert node $participantXML
    into doc('club.xml')//concours[@id='$idConcours']/participants
    ";

   

    $url = "http://localhost:8080/rest/";

    $options = [
        "http" => [
            "method" => "POST",
            "header" =>
                "Content-Type: application/query+xml\r\n" .
                "Authorization: Basic " . base64_encode("admin:admin"),
            "content" => $xquery
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if($result !== false) {
        $message = "Inscription effectuée avec succès !";
    } else {
        $message = "Erreur BaseX / XQuery";
    }
}
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Nouvelle Inscription</title>

<style>

body {

    font-family: Arial;

    background: #eef2f7;

    padding: 20px;
}

.container {

    width: 600px;

    margin: auto;

    background: white;

    padding: 25px;

    border-radius: 10px;

    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
}

h1 {

    text-align: center;

    color: #1f3b57;
}

label {

    font-weight: bold;
}

select,
input {

    width: 100%;

    padding: 10px;

    margin-top: 8px;

    margin-bottom: 18px;

    border: 1px solid #ccc;

    border-radius: 6px;
}

button {

    width: 100%;

    padding: 12px;

    background: #1f3b57;

    color: white;

    border: none;

    border-radius: 6px;

    font-size: 16px;

    cursor: pointer;
}

button:hover {

    background: #2d5b87;
}

.msg {

    background: #d4edda;

    color: #155724;

    padding: 10px;

    margin-bottom: 15px;

    border-radius: 5px;

    text-align: center;
}

</style>

</head>

<body>

<div class="container">

<h1>Nouvelle Inscription</h1>

<?php

if($message != "") {

    echo "<div class='msg'>$message</div>";
}

?>

<form method="post">

    <!-- concours -->

    <label>

        Concours :

    </label>

    <select name="concours" required>

        <option value="">

            Sélectionnez

        </option>

<?php

foreach($xml->concours->concours as $c) {

    echo "<option value='".$c['id']."'>";

    echo $c->titre;

    echo "</option>";
}

?>

    </select>

    <!-- complexité -->

    <label>

        Complexité de l'algo (0-100)

    </label>

    <input
        type="number"
        name="complexite"
        min="0"
        max="100"
        required
    >

    <!-- temps -->

    <label>

        Temps d'exécution (ms)

    </label>

    <input
        type="number"
        name="temps"
        required
    >

    <!-- bouton -->

    <button name="inscrire">

        Inscription

    </button>

</form>

</div>

</body>

</html>
