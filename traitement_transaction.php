<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Utilisateur non connecté");
}

$user_id = $_SESSION['user_id'];

try {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=stock_db", "root", "1234");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $article_id = $_POST['article_id'];
        $type = $_POST['type_transaction'];
        $quantite = (int)$_POST['quantite'];

        // 🔹 Récupérer les infos de l'article
        $stmt = $pdo->prepare("SELECT designation FROM article WHERE id = ?");
        $stmt->execute([$article_id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$article) {
            die("Article non trouvé");
        }

        // 🔹 Récupérer les infos de l'utilisateur
        $stmt = $pdo->prepare("SELECT nom, prenom FROM user WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            die("Utilisateur non trouvé");
        }

        // 🔹 Mise à jour du stock
        if ($type === 'entrée') {
            $stmt1 = $pdo->prepare("UPDATE article SET qnt_actual = qnt_actual + ? WHERE id = ?");
        } else {
            $stmt1 = $pdo->prepare("UPDATE article SET qnt_actual = qnt_actual - ? WHERE id = ?");
        }
        $stmt1->execute([$quantite, $article_id]);

        // 🔹 Insertion dans transactions
        $stmt = $pdo->prepare("INSERT INTO transactions (article_nom, type_transaction, quantite, user_nom, user_prenom)
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $article['designation'],
            $type,
            $quantite,
            $user['nom'],
            $user['prenom']
        ]);

        header("Location: art_transaction.html");
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
