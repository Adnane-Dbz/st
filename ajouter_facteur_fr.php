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
    $fournisseur_id = $_POST['fournisseur_id'];
    $date_f = $_POST['date_f'];
    $commentaire = $_POST['commentaire'];
     // Vérifie que c'est bien un entier
    $ref = $_POST['reference'];

    // Préparation de la requête
    $stmt = $conn->prepare("INSERT INTO facteur_fournisseur (fournisseur_id, date_f,commentaire , reference) VALUES (?, ?, ?, ?)");

    // Vérifie si la requête a été bien préparée
    if (!$stmt) {
        die("Erreur dans prepare(): " . $conn->error);
    }

    // Liaison des paramètres
    // "issssss" : 1 entier, 5 chaînes de caractères, 1 entier pour qnt_seuil
    $stmt->bind_param("isss", $fournisseur_id, $date_f, $commentaire ,$ref);


    // Exécution de la requête
    if ($stmt->execute()) {
        header("Location: art_factur_fourn.html");
        exit;
    } else {
        echo "Erreur lors de l'exécution : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
