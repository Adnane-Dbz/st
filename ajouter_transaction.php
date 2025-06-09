<?php
try {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=stock_db", "root", "1234");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $articles = $pdo->query("SELECT * FROM article")->fetchAll(PDO::FETCH_ASSOC);
    $clients = $pdo->query("SELECT * FROM client")->fetchAll(PDO::FETCH_ASSOC);
    $fournisseurs = $pdo->query("SELECT * FROM fournisseur")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Transaction</title>
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
        body { display: flex; min-height: 100vh; background-color: #f5f7fa; }
        .sidebar { width: 220px; background: var(--primary); color: white; padding: 20px 0; }
        .sidebar-menu a { display: block; padding: 15px 20px; color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.3s; }
        .sidebar-menu a:hover { background: rgba(255,255,255,0.1); color: white; }
        .main-content { flex: 1; display: flex; flex-direction: column; }
        .header { display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; background: var(--blue); color: white; }
        .content { flex: 1; padding: 30px; background-color: #f5f7fa; }
        .form-container { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .form-container label { display: block; margin-bottom: 8px; font-weight: bold; }
        .form-container input, .form-container select { width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .form-container button { background-color: var(--green); color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        .form-container button:hover { background-color: #27ae60; }
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
            <a href="art_category.html"><i class="fas fa-tags"></i> Catégories</a>
        </div>
    </div>

    <div class="main-content">
        <header class="header">
            <h1>Gestion de Stock</h1>
        </header>
        <div class="content">
            <div class="form-container">
                <h2>Ajouter une transaction</h2>
                <form action="traitement_transaction.php" method="POST" onsubmit="return validateForm()">
                    <label>Article :</label>
                    <select name="article_id" required>
                        <option value="">-- Choisir un article --</option>
                        <?php foreach($articles as $a): ?>
                            <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['designation']) ?> (<?= $a['marque'] ?>)</option>
                        <?php endforeach; ?>
                    </select>

                    <label>Type :</label>
                    <select name="type_transaction" id="type_transaction" required onchange="toggleSelects()">
                        <option value="">-- Choisir un type --</option>
                        <option value="entrée">Entrée</option>
                        <option value="sortie">Sortie</option>
                    </select>

                    <label>Quantité :</label>
                    <input type="number" name="quantite" required min="1">

                    <!-- Fournisseur -->
                    <div id="fournisseur_section" style="display: none;">
                        <label>Fournisseur :</label>
                        <select name="fournisseur_id" id="fournisseur_id">
                            <option value="">-- Choisir un fournisseur --</option>
                            <?php foreach($fournisseurs as $f): ?>
                                <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['nom']) ?> (<?= $f['prenom'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Client -->
                    <div id="client_section" style="display: none;">
                        <label>Client :</label>
                        <select name="client_id" id="client_id">
                            <option value="">-- Choisir un client --</option>
                            <?php foreach($clients as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nom']) ?> (<?= $c['prenom'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit">Valider</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleSelects() {
            const type = document.getElementById('type_transaction').value;
            const fournisseurSection = document.getElementById('fournisseur_section');
            const clientSection = document.getElementById('client_section');

            if (type === 'entrée') {
                fournisseurSection.style.display = 'block';
                clientSection.style.display = 'none';
            } else if (type === 'sortie') {
                fournisseurSection.style.display = 'none';
                clientSection.style.display = 'block';
            } else {
                fournisseurSection.style.display = 'none';
                clientSection.style.display = 'none';
            }
        }

        function validateForm() {
            const type = document.getElementById('type_transaction').value;
            const fournisseur = document.getElementById('fournisseur_id').value;
            const client = document.getElementById('client_id').value;

            if (type === 'entrée' && fournisseur === "") {
                alert("Veuillez choisir un fournisseur.");
                return false;
            }

            if (type === 'sortie' && client === "") {
                alert("Veuillez choisir un client.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
