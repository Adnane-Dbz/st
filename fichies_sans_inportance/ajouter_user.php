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
$date_naissance = $_POST['date_naissance'];
$niveaux = $_POST['niveaux'];
$email= $_POST['email'];
$password=$_POST['password'];



$sql = "INSERT INTO user (nom, prenom, date_naissance,niveaux,email,password) VALUES ('$nom',
 '$prenom', '$date_naissance','$niveaux', '$email',$password)";

if ($conn->query($sql) === TRUE) {
    echo "user  ajouter ";
} else {
    echo " error: " . $conn->error;
}

$conn->close();
?>
