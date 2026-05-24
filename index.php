<!DOCTYPE html>
<html>
<head>
    <title>Club Info Tech</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body{
            height: 100vh;
            background: linear-gradient(135deg, #0f172a, #1e293b, #334155);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container{
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            width: 400px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        h1{
            color: #0f172a;
            margin-bottom: 30px;
            font-size: 28px;
        }

        ul{
            list-style: none;
        }

        ul li{
            margin: 15px 0;
        }

        ul li a{
            display: block;
            text-decoration: none;
            background-color: #2563eb;
            color: white;
            padding: 15px;
            border-radius: 10px;
            font-size: 18px;
            transition: 0.3s;
        }

        ul li a:hover{
            background-color: #1d4ed8;
            transform: scale(1.05);
        }

    </style>

</head>

<body>

    <div class="container">

        <h1>Bienvenue dans le système du club</h1>

        <ul>
            <li><a href="members.php">Membres</a></li>
            <li><a href="concours.php">Concours</a></li>
            <li><a href="results.php">Résultats</a></li>
            <li><a href="winners.php">Vainqueurs</a></li>
        </ul>

    </div>

</body>
</html>
