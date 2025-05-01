<?php
// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=stock_db", "root", "1234");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $niveaux = $_POST['niveaux'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifie si l'email existe déjà
    $checkEmail = $pdo->prepare("SELECT id FROM user WHERE email = :email");
    $checkEmail->execute([':email' => $email]);

    if ($checkEmail->rowCount() > 0) {
        echo "Erreur : cet email est déjà utilisé.";
    } else {
        $sql = "INSERT INTO user (nom, prenom, date_naissance, niveaux, email, password)
                VALUES (:nom, :prenom, :date_naissance, :niveaux, :email, :password)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':date_naissance' => $date_naissance,
            ':niveaux' => $niveaux,
            ':email' => $email,
            ':password' => $password
        ]);

        header("Location: art_user.html");
        exit;
    }
} else {
    echo "Méthode non autorisée.";
}
?>
