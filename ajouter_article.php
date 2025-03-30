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


$designation = $_POST['designation'];
$marque = $_POST['marque'];
$grandeur = $_POST['grandeur'];
$qnt_actual = $_POST['qnt_actual'];
$qnt_seuil = $_POST['qnt_seuil'];
$reference = $_POST['reference'];


$sql = "INSERT INTO article (designation, marque, grandeur,qnt_actual,qnt_seuil,reference) VALUES ('$designation',
 '$marque', '$grandeur','$qnt_actual', '$qnt_seuil','$reference')";

if ($conn->query($sql) === TRUE) {
    echo "article  ajouter ";
} else {
    echo " error: " . $conn->error;
}

$conn->close();
?>
