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


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $categorie_id = $_POST['categorie_id'];
    $designation = $_POST['designation'];
    $marque = $_POST['marque'];
    $qnt = $_POST['qnt_actual'];
    $qnts = $_POST['qnt_seuil'];
    $ref = $_POST['reference'];
    $gr = $_POST['grandeur']; 

 
    $stmt = $conn->prepare("INSERT INTO article (category_id, designation, grandeur , qnt_seuil, marque, qnt_actual, reference) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Erreur dans prepare(): " . $conn->error);
    }

    $stmt->bind_param("issssss", $categorie_id, $designation, $gr, $qnts, $marque, $qnt, $ref);

    if ($stmt->execute()) {
        header("Location: art.html");
        exit;
    } else {
        echo "Erreur lors de l'exécution : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
