<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "stock_db";
$port = 3307; // Ou 3307 selon ta config XAMPP/MySQL Workbench

// Connexion avec MySQLi orienté objet
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Si la requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $categorie_id = $_POST['categorie_id'];
    $designation = $_POST['designation'];
    $marque = $_POST['marque'];
    $qnt = $_POST['qnt_actual'];
    $qnts = $_POST['qnt_seuil'];  // Vérifie que c'est bien un entier
    $ref = $_POST['reference'];
    $gr = $_POST['grandeur'];  // Nouvelle variable grandeur

    // Préparation de la requête
    $stmt = $conn->prepare("INSERT INTO article (category_id, designation, grandeur , qnt_seuil, marque, qnt_actual, reference) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Vérifie si la requête a été bien préparée
    if (!$stmt) {
        die("Erreur dans prepare(): " . $conn->error);
    }

    // Liaison des paramètres
    // "issssss" : 1 entier, 5 chaînes de caractères, 1 entier pour qnt_seuil
    $stmt->bind_param("issssss", $categorie_id, $designation, $gr, $qnts, $marque, $qnt, $ref);

    // Exécution de la requête
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
