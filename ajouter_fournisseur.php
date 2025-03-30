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


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$tel = $_POST['tel'];
$fax = $_POST['fax'];
$siege= $_POST['siege'];



$sql = "INSERT INTO client (nom, prenom, tel,fax,siege) VALUES ('$nom',
 '$prenom', '$tel','$fax', '$siege')";

if ($conn->query($sql) === TRUE) {
    echo "client  ajouter ";
} else {
    echo " error: " . $conn->error;
}

$conn->close();
?>
