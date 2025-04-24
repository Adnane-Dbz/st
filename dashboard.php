<?php
session_start();
if (!isset($_SESSION['nom'])) {
    header("Location: login.php");
    exit;
}
?>
<h2>Bienvenue, <?php echo $_SESSION['nom']; ?> !</h2>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - DTN Guelma</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
        }

        header {
            background-color: #1a365d;
            color: white;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        .container {
            padding: 40px;
            text-align: center;
        }

        .welcome {
            font-size: 22px;
            margin-bottom: 30px;
        }

        .cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            width: 200px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card a {
            text-decoration: none;
            color: #1a365d;
            font-weight: bold;
        }

        .logout {
            margin-top: 40px;
        }

        .logout a {
            color: white;
            background-color: #c53030;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .logout a:hover {
            background-color: #9b2c2c;
        }
    </style>
</head>
<body>
    <header>
        <h1>DTN GUELMA - Tableau de bord</h1>
    </header>

    <div class="container">
        <div class="welcome">
            Bienvenue, <strong><?php echo htmlspecialchars($_SESSION['nom']); ?></strong> !
        </div>

        <div class="cards">
            <div class="card"><a href="art.html">Produits</a></div>
            <div class="card"><a href="#">Catégories</a></div>
            <div class="card"><a href="#">Utilisateurs</a></div>
            <div class="card"><a href="#">Rapports</a></div>
        </div>

        <div class="logout">
            <a href="logout.php">Se déconnecter</a>
        </div>
    </div>
</body>
</html>
