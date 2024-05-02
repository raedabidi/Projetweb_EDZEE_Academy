<?php
require_once "../controller/FormationC.php";
$formationC = new FormationC();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Titre']) && isset($_POST['search'])) {
        $Titre = $_POST['Titre'];
        $liste = $formationC->rechercherFormationParTitre($Titre);
    }
}

$formations = $formationC->ListeFormations();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de formations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Recherche de formations par titre</h1>
    <form action="" method="POST">
        <label for="titre">Entrez le titre de la formation : </label>
        <input type="text" name="Titre" id="Titre">
        <input type="submit" value="Rechercher" name="search">
    </form>
    <br>
    <?php if (isset($liste)) : ?>
        <?php if (count($liste) > 0) : ?>
            <h2>Résultats de la recherche :</h2>
            <ul>
                <?php foreach ($liste as $formation) : ?>
                    <li><?= $formation['Titre']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Aucune formation trouvée avec ce titre.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>