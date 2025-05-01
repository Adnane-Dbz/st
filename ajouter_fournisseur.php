<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "stock_db";
$port = 3307;


$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Vérifie la connexion
if ($conn->connect_error) {

    die("Échec de la connexion : " . $conn->connect_error);


}

// Si la requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $fax = $_POST['fax'];
    $siege = $_POST['siege'];  // Vérifie que c'est bien un entier
    
    // Préparation de la requête
    $stmt = $conn->prepare("INSERT INTO fournisseur (nom, prenom, tel , fax, siege) VALUES ( ?, ?, ?, ?, ?)");

    // Vérifie si la requête a été bien préparée
    if (!$stmt) {
        die("Erreur dans prepare(): " . $conn->error);
    }

    // Liaison des paramètres
    // "issssss" : 1 entier, 5 chaînes de caractères, 1 entier pour qnt_seuil
    $stmt->bind_param("ssiis", $nom, $prenom, $tel, $fax, $siege);

    // Exécution de la requête
    if ($stmt->execute()) {
        header("Location: art_fournisseur.html");
        exit;
    } else {
        echo "Erreur lors de l'exécution : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
