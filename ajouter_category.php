<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "stock_db";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("  error de conn: " . $conn->connect_error);
}


$name_c = $_POST['name_c'];



$sql = "INSERT INTO category (name_c) VALUES ('$name_c')";

if ($conn->query($sql) === TRUE) {
    echo "category  ajouter ";
} else {
    echo " error: " . $conn->error;
}

$conn->close();
?>
