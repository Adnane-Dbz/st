<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "stock_management";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("  error de conn: " . $conn->connect_error);
}


$nom = $_POST['nom'];
$prix = $_POST['prix'];
$quantite = $_POST['quantite'];


$sql = "INSERT INTO products (name, price, quantity) VALUES ('$nom', '$prix', '$quantite')";

if ($conn->query($sql) === TRUE) {
    echo "prd ajouter ";
} else {
    echo " خطأ: " . $conn->error;
}

$conn->close();
?>
