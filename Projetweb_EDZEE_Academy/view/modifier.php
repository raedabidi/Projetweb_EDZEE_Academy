<?php
include '../Controller/FormationC.php';
$error = "";

// Créer une instance du contrôleur
$FormationC = new FormationC();

if (
    isset($_POST["IDF"]) &&
    isset($_POST["Titre"]) &&
    isset($_POST["Description"]) &&
    isset($_POST["Ressource"]) &&
    isset($_POST["Status"]) &&
    isset($_POST["Prix"])
) {
    if (
        !empty($_POST['IDF']) &&
        !empty($_POST['Titre']) &&
        !empty($_POST["Description"]) &&
        !empty($_POST["Ressource"]) &&
        !empty($_POST["Status"]) &&
        !empty($_POST["Prix"])
    ) {
        $IDF = $_POST['IDF'];
        $Titre = $_POST['Titre'];
        $Description = $_POST['Description'];
        $Ressource = $_POST['Ressource'];
        $Status = $_POST['Status'];
        $Prix = $_POST['Prix'];

        // Créer un nouvel objet formation
        $formation = new formation($IDF, $Titre, $Description, $Ressource, $Status, $Prix);

        // Mettre à jour l'enregistrement en utilisant la méthode formationC
        $FormationC->ModifierFormation($formation, $IDF);

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
        <h2>Modifier une formation</h2>
        <p class="erreur_message">
            <?php 
            // Afficher le message d'erreur s'il y a une erreur
            echo $error;
            ?>
        </p>
     
        <form action="" method="POST">
            <label>ID Formation</label>
            <input type="text" name="IDF" value="<?php echo isset($_POST['IDF']) ? $_POST['IDF'] : ''; ?>" placeholder="ID Formation" required="">
            <label>Titre</label>
            <input type="text" name="Titre" value="<?php echo isset($_POST['Titre']) ? $_POST['Titre'] : ''; ?>" placeholder="Titre" required="">
            <label>Description</label>
            <input type="text" name="Description" value="<?php echo isset($_POST['Description']) ? $_POST['Description'] : ''; ?>" placeholder="Description" required="">
            <label>Ressource</label>
            <input type="text" name="Ressource" value="<?php echo isset($_POST['Ressource']) ? $_POST['Ressource'] : ''; ?>" placeholder="Ressource" required="">
            <label>Status</label>
            <input type="text" name="Status" value="<?php echo isset($_POST['Status']) ? $_POST['Status'] : ''; ?>" placeholder="Status" required="">
            <label>Prix</label>
            <input type="number" name="Prix" value="<?php echo isset($_POST['Prix']) ? $_POST['Prix'] : ''; ?>" placeholder="Prix" required="">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>
</html>