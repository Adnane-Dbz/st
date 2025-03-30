<?php
class Voiture {
    // Propriétés
    public $marque;
    public $couleur;

    // Constructeur (initialisation automatique)
    public function __construct($marque, $couleur) {
        $this->marque = $marque;
        $this->couleur = $couleur;
    }

    // Méthode pour afficher les infos
    public function afficherInfo() {
        return "Cette voiture est une " . $this->marque . " de couleur " . $this->couleur;
    }
}

// Création d'un objet à partir de la classe
$maVoiture = new Voiture("Toyota", "Rouge");
echo $maVoiture->afficherInfo(); // Affiche : "Cette voiture est une Toyota de couleur Rouge"
?>


<?php
class Employe extends Personne {
    public $poste;

    public function __construct($nom, $age, $salaire, $poste) {
        parent::__construct($nom, $age, $salaire); // Appel du constructeur parent
        $this->poste = $poste;
    }

    public function afficherPoste() {
        return $this->nom . " travaille comme " . $this->poste;
    }
}

$employe = new Employe("Omar", 35, 7000, "Développeur");
echo $employe->afficherPoste(); // Affiche : "Omar travaille comme Développeur"
?>

<?php
interface Animal {
    public function faireDuBruit();
}

class Chien implements Animal {
    public function faireDuBruit() {
        return "🐶 Wouf Wouf!";
    }
}

$monChien = new Chien();
echo $monChien->faireDuBruit(); // Affiche : "🐶 Wouf Wouf!"
?>
<?php
class Division {
    public static function diviser($a, $b) {
        if ($b == 0) {
            throw new Exception("❌ Division par zéro !");
        }
        return $a / $b;
    }
}

try {
    echo Division::diviser(10, 0);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

