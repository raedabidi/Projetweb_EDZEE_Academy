<?php
include '../Controller/RessourcesC.php';
$error = "";

// Créer une instance du contrôleur
$RessourcesC = new RessourcesC();

if (
    isset($_POST["Lien"]) &&
    isset($_POST["IMG"]) &&
    isset($_POST["Type"]) &&
    isset($_POST["DateAjout"])
) {
    if (
        !empty($_POST['Lien']) &&
        !empty($_POST['IMG']) &&
        !empty($_POST["Type"]) &&
        !empty($_POST["DateAjout"])
    ) {
        $Lien = $_POST['Lien'];
        $IMG = $_POST['IMG'];
        $Type = $_POST['Type'];
        $DateAjout = $_POST['DateAjout'];

        // Créer un nouvel objet ressource
        $ressources = new ressources($Lien, $IMG, $Type, $DateAjout);

        // Mettre à jour l'enregistrement en utilisant la méthode RessourcesC
        $RessourcesC->ModifierRessource($ressources, $Lien);

        // Rediriger vers index.php après la mise à jour réussie
        header('Location: index.php');
        exit();
    } else {
        $error = "Informations manquantes";
    }
}

// S'il y a une erreur, il est préférable de la gérer et éventuellement de l'afficher à l'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
        <a href="page aceuill0.php" class="back_btn"><img src="back.png"> Retour</a>
        <h2>Modifier une ressource</h2>
        <p class="erreur_message">
            <?php 
            // Afficher le message d'erreur s'il y a une erreur
            echo $error;
            ?>
        </p>
     
        <form action="" method="POST">
            <label>Lien</label>
            <input type="text" name="Lien" value="<?php echo isset($_POST['Lien']) ? $_POST['Lien'] : ''; ?>" placeholder="Lien" required="">
            <label>IMG</label>
            <input type="text" name="IMG" value="<?php echo isset($_POST['IMG']) ? $_POST['IMG'] : ''; ?>" placeholder="IMG" required="">
            <label>Type</label>
            <input type="text" name="Type" value="<?php echo isset($_POST['Type']) ? $_POST['Type'] : ''; ?>" placeholder="Type" required="">
            <label>Date Ajout</label>
            <input type="date" name="DateAjout" value="<?php echo isset($_POST['DateAjout']) ? $_POST['DateAjout'] : ''; ?>" placeholder="Date Ajout" required="">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>
</html>