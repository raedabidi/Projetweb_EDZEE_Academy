<?php
include "../controller/commsC.php";
include "../Model/comms.php";

$error = "";

// Créer une instance du contrôleur
$commsC = new CommsC();

if (
    isset($_POST["id_commentaire"]) &&
    isset($_POST["id_forum"]) &&
    isset($_POST["titre_commentaire"]) &&
    isset($_POST["commentaire"])
) {
    if (
        !empty($_POST["id_commentaire"]) &&
        !empty($_POST["id_forum"]) &&
        !empty($_POST["titre_commentaire"]) &&
        !empty($_POST["commentaire"])
    ) {
        $id_commentaire = $_POST['id_commentaire'];
        $id_forum = $_POST['id_forum'];
        $titre_commentaire = $_POST['titre_commentaire'];
        // Obtenir la date actuelle
        $date_commentaire = date("Y-m-d H:i:s"); // Format: Année-Mois-Jour Heure:Minute:Seconde
        $commentaire = $_POST['commentaire'];

        // Créer un nouvel objet comms
        $comms = new comms($id_commentaire, $id_forum, $titre_commentaire, $date_commentaire, $commentaire);

        // Mettre à jour l'enregistrement en utilisant la méthode CommsC
        $commsC->updateComment($comms, $id_commentaire);

        // Rediriger vers indexcomms.php après la mise à jour réussie
        header('Location: indexcomms.php');
        exit();
    } else {
        $error = "Informations manquantes";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Commentaire</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
        <a href="page aceuill0.php" class="back_btn"><img src="back.png"> Retour</a>
        <h2>Modifier un commentaire</h2>
        <p class="erreur_message">
            <?php 
            // Afficher le message d'erreur s'il y a une erreur
            echo $error;
            ?>
        </p>

        <form action="" method="POST" onsubmit="return validateForm()">
            <label>ID Commentaire</label>
            <input type="text" name="id_commentaire" value="<?php echo isset($_POST['id_commentaire']) ? $_POST['id_commentaire'] : ''; ?>" placeholder="ID Commentaire" required="">
            <label>ID Forum</label>
            <input type="text" name="id_forum" value="<?php echo isset($_POST['id_forum']) ? $_POST['id_forum'] : ''; ?>" placeholder="ID Forum" required="">
            <label>Titre Commentaire</label>
            <input type="text" name="titre_commentaire" value="<?php echo isset($_POST['titre_commentaire']) ? $_POST['titre_commentaire'] : ''; ?>" placeholder="Titre Commentaire" required="">
            <!-- Supprimer le champ pour la date, car elle sera ajoutée automatiquement -->
            <!-- Ajouter le champ pour le commentaire -->
            <label>Commentaire</label>
            <textarea name="commentaire" placeholder="Commentaire" required=""><?php echo isset($_POST['commentaire']) ? $_POST['commentaire'] : ''; ?></textarea>
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>

    <script>
        function validateForm() {
            var titreCommentaire = document.getElementsByName("titre_commentaire")[0].value;
            var commentaire = document.getElementsByName("commentaire")[0].value;

            // Vérifier si les champs sont vides ou ne contiennent que des espaces
            if (titreCommentaire.trim() === '' || commentaire.trim() === '') {
                alert("Veuillez remplir tous les champs.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
