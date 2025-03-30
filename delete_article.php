<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "stock_management";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

// Vérifier si l'ID du produit est envoyé
if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Sécurisation de l'ID
    
   
    $sql = "DELETE FROM products WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Produit supprimé avec succès!";
    } else {
        echo "❌ Erreur lors de la suppression: " . $conn->error;
    }
} else {
    echo "⚠️ Veuillez fournir un ID valide.";
}

$conn->close();

?>
