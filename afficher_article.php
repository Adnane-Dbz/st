<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "stock_db";
$port = 3307;


$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}


$conn->set_charset("utf8");


$sql = "SELECT id, designation, marque, qnt_actual, qnt_seuil, reference, date_derniere_modification FROM article";
$result = $conn->query($sql);
$result = $conn->query($sql);

if (!$result) {
    die("Erreur dans la requête SQL : " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Articles</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des Articles</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Désignation</th><th>Marque</th><th>Quantité Actuelle</th><th>Quantité Seuil</th><th>Référence</th><th>Date de Dernière Modification</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["designation"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["marque"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["qnt_actual"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["qnt_seuil"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["reference"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["date_derniere_modification"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucun article trouvé.</p>";
    }
    $conn->close();
    ?>
</body>
</html>
