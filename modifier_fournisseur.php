
<?php
try {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=stock_db", "root", "1234");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM fournisseur WHERE id = ?");
        $stmt->execute([$id]);
        $fournisseur = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $fax = $_POST['fax'];
    $siege = $_POST['siege'];
    $reference = $_POST['reference'];

    $stmt = $pdo->prepare("UPDATE fournisseur SET nom = ?, prenom = ?, tel = ?, fax = ?, siege = ? WHERE id = ?");
    $stmt->execute([$nom, $prenom, $tel, $fax, $siege,$id]);

    header('Location: art_fournisseur.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un client</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
         :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #f8f9fa;
            --dark: #34495e;
            --green: #2ecc71;
            --blue: #2c3e50;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f7fa;
        }

        .sidebar {
            width: 220px;
            background: var(--primary);
            color: white;
            padding: 20px 0;
        }

        .sidebar-menu a {
            display: block;
            padding: 15px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: var(--blue);
            color: white;
        }

        .content {
            flex: 1;
            padding: 30px;
            background-color: #f5f7fa;
        }

        .form-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: var(--green);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-menu">
            <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="art.html"><i class="fas fa-box"></i> Articles</a>
            <a href="art_client.html"><i class="fas fa-users"></i> Clients</a>
            <a href="art_fournisseur.html"><i class="fas fa-truck"></i> Fournisseurs</a>
            <a href="art_transaction.html"><i class="fas fa-retweet"></i> Transactions</a>
            <a href="art_factur_client.html"><i class="fas fa-tags"></i> Catégories</a>
            <a href="#"><i class="fas fa-cog"></i> Administration</a>
        </div>
    </div>

    <div class="main-content">
        <header class="header">
            <h1>Modifier un fournisseur</h1>
        </header>
        <div class="content">
            <div class="form-container">
                <h2>Formulaire de modification</h2>
                <form method="POST">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($fournisseur['nom'] ?? '') ?>" required>

                    <label for="prenom">Prenom :</label>
                    <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($fournisseur['prenom'] ?? '') ?>" required>

                    <label for="tel">Tel :</label>
                    <input type="tel" name="tel" id="tel" value="<?= htmlspecialchars($fournisseur['tel'] ?? '') ?>" required>

                    <label for="fax">fax :</label>
                    <input type="tel" name="fax" id="fax" value="<?= htmlspecialchars($fournisseur['fax'] ?? '') ?>" required>

                    <label for="siege">siege :</label>
                    <input type="text" name="siege" id="siege" value="<?= htmlspecialchars($fournisseur['siege'] ?? '') ?>" required>

                  
                    <button type="submit">Sauvegarder</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
