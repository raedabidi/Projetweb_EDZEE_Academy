<?php
include '../controller/forumC.php';
include '../Model/forum.php';

$error = "";

// Créer une instance du contrôleur
$forumC = new ForumC();

if (isset($_POST["titre_forum"]) && isset($_POST["matiere_forum"]) && isset($_POST["desc_forum"])) {
    if (!empty($_POST["titre_forum"]) && !empty($_POST["matiere_forum"]) && !empty($_POST["desc_forum"])) {
        // Récupérer la date actuelle
        $date_forum = date("Y-m-d H:i:s"); // Format: Année-Mois-Jour Heure:Minute:Seconde

        $forum = new forum(
            $_POST['titre_forum'],
            $date_forum, // Utiliser la date actuelle
            $_POST['matiere_forum'],
            $_POST['desc_forum']
        );
        $forumC->addforum($forum);
        header('Location: listforum.php');
        exit(); // Assurez-vous de sortir du script après la redirection
    } else {
        $error = "Missing information";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Fonction pour vérifier si le titre et la matière sont des chaînes de caractères
        function validateForm() {
            var titre_forum = document.forms["forumForm"]["titre_forum"].value;
            var matiere_forum = document.forms["forumForm"]["matiere_forum"].value;
            var desc_forum = document.forms["forumForm"]["desc_forum"].value;
            var regex = /^[a-zA-Z\s]*$/; // Expression régulière pour les chaînes de caractères alphabétiques

            if (!regex.test(titre_forum)) {
                alert("Le titre du forum ne doit contenir que des lettres.");
                return false;
            }

            if (!regex.test(matiere_forum)) {
                alert("La matière du forum ne doit contenir que des lettres.");
                return false;
            }

            if (!desc_forum.trim()) {
                alert("La description du forum ne doit pas être vide.");
                return false;
            }

            return true; // Soumettre le formulaire si les champs sont valides
        }
    </script>
</head>
<body>
    <div class="form">
        <a href="page aceuill0.php" class="back_btn"><img src="back.png"> Retour</a>
        <h2>Ajouter un forum</h2>
        <form name="forumForm" action="" method="POST" onsubmit="return validateForm()">
            <!-- Supprimez le champ texte pour la matière et utilisez une liste déroulante -->
            <label>Titre forum</label>
            <input type="text" name="titre_forum" placeholder="titre_forum" required="">
            <!-- Utilisez une liste déroulante pour sélectionner la matière -->
            <label>Sujet forum</label>
            <select name="matiere_forum" required="">
                <option value="">Choisissez un sujet</option>
                <option value="General">General</option>
                <option value="Tests">Tests</option>
                <option value="Mathematique">Mathematique</option>
                <option value="Français">Français</option>
                <option value="Anglais">Anglais</option>
                <option value="Science">Science</option>
                <option value="Economie">Economie</option>
                <option value="Infographie">Infographie</option>
                <option value="Informatique">Informatique</option>
            </select>
            <!-- Ajout du champ pour la description -->
            <label>Description forum</label>
            <textarea name="desc_forum" placeholder="Description du forum" required=""></textarea>
            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>
</body>
</html>
