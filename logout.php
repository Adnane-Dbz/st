<?php
session_start();        // Démarrer la session
session_unset();        // Supprimer toutes les variables de session
session_destroy();      // Détruire la session

// Rediriger vers la page de connexion
header("Location: login.html");
exit;
?>
