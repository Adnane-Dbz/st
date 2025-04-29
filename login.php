<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "stock_db";
$port = 3307;

try {
    $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $password = $_POST['password'] ?? '';

    // Requête simple SANS hashage
    $stmt = $pdo->prepare("SELECT * FROM user WHERE nom = ? AND password = ?");
    $stmt->execute([$nom, $password]);
    $user = $stmt->fetch();

    if ($user) {
        session_start();
        $_SESSION['nom'] = $nom;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<p style='color:red;text-align:center;'>Nom d'utilisateur ou mot de passe incorrect.</p>";
    }
}
?>
