<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "stock_db";
$port = 3307;


$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);


    $stmt = $conn->prepare("DELETE FROM article WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
       
        header("Location: art.html");
        exit;
    } else {
        echo "Erreur lors de la suppression : " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de l'article non spécifié.";
}

$conn->close();
?>
