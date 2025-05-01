<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "stock_db";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);



if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
$sql = "SELECT 
            article.id,
            article.designation,
            article.marque,
            article.grandeur,
            article.qnt_actual,
            article.qnt_seuil,
            article.reference,
            article.date_derniere_modification,
            category.name_c AS categorie
        FROM article
        LEFT JOIN category ON article.category_id = category.id";

$result = $conn->query($sql);

$articles = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($articles);

$conn->close();
?>