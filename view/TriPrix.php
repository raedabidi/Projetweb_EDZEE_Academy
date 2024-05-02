<?php
require_once "../controller/FormationC.php";
$formationC = new FormationC();

// Traitement du formulaire
$formations = array(); // Initialisation avec un tableau vide par défaut

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tri'])) {
        $tri = $_POST['tri'];
        $formations = $formationC->ListeFormations();

        // Transformation de l'objet PDOStatement en tableau associatif
        $formations = $formations->fetchAll(PDO::FETCH_ASSOC);

        // Tri par prix
        if ($tri == 'croissant') {
            usort($formations, function($a, $b) {
                return $a['Prix'] - $b['Prix'];
            });
        } elseif ($tri == 'decroissant') {
            usort($formations, function($a, $b) {
                return $b['Prix'] - $a['Prix'];
            });
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tri des formations par prix</title>
</head>
<body>
    <h1>Tri des formations par prix</h1>
    <form action="" method="POST">
    <link rel="stylesheet" href="style.css">
        <input type="radio" name="tri" value="croissant" id="croissant">
        <label for="croissant">Prix croissant</label>
        <input type="radio" name="tri" value="decroissant" id="decroissant">
        <label for="decroissant">Prix décroissant</label>
        <input type="submit" value="Trier">
       
    </form>
    <br>
    <?php if (!empty($formations)) : ?>
        <h2>Résultats du tri :</h2>
        <ul>
            <?php foreach ($formations as $formation) : ?>
                <li><?= $formation['Titre']; ?> - <?= $formation['Prix']; ?> €</li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Aucune formation trouvée.</p>
    <?php endif; ?>
</body>
</html>