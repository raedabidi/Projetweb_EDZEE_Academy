<?php
require_once '../controller/commsC.php';
require_once '../Model/comms.php';

$error = "";

// Créer une instance du contrôleur
$commsC = new CommsC();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier si les champs requis sont définis et non vides
    if (
        isset($_POST["id_forum"]) &&
        isset($_POST["titre_commentaire"]) &&
        isset($_POST["commentaire"]) &&
        !empty(trim($_POST["id_forum"])) &&
        !empty(trim($_POST["titre_commentaire"])) &&
        !empty(trim($_POST["commentaire"]))
    ) {
        // Récupérer la date actuelle
        $date_commentaire = date("Y-m-d H:i:s"); // Format: Année-Mois-Jour Heure:Minute:Seconde

        // Récupérer l'ID du forum à partir des données du formulaire
        $id_forum = intval($_POST['id_forum']); // Convertir en entier

        // Créer un nouvel objet comms avec like_dislike initialisé à false
        $comms = new comms(
            null, // L'ID sera auto-incrémenté, donc laisser null
            $id_forum, // ID du forum
            $_POST['titre_commentaire'], // Titre du commentaire
            $date_commentaire, // Date du commentaire
            $_POST['commentaire'], // Contenu du commentaire
            false // Valeur initiale pour like_dislike, par exemple false pour "pas de like/dislike"
        );

        // Ajouter le commentaire
        if ($commsC->addComment($comms)) {
            // Redirection vers listcomms.php après l'ajout réussi
            header('Location: listcomms.php');
            exit(); // Assurez-vous de sortir du script après la redirection
        } else {
            // S'il y a une erreur dans l'ajout du commentaire
            $error = "Une erreur s'est produite lors de l'ajout du commentaire.";
        }
    } else {
        // Si tous les champs requis ne sont pas remplis
        $error = "Tous les champs doivent être remplis.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Importez les dépendances
        const Filter = require("bad-words");

        // Créez un nouveau filtre
        const filter = new Filter();

        // Ajoutez des mots supplémentaires à la liste des gros mots
        const words = require("./extra-words.json");
        filter.addWords(...words);

        // Fonction pour nettoyer les gros mots du commentaire
        function cleanComment(comment) {
            return filter.clean(comment);
        }

        // Fonction pour vérifier si le titre du commentaire est une chaîne de caractères
        function validateForm() {
            var titre_commentaire = document.forms["commsForm"]["titre_commentaire"].value;
            var commentaire = document.forms["commsForm"]["commentaire"].value;

            // Nettoyer le commentaire des gros mots
            var clean_commentaire = cleanComment(commentaire);

            // Vérifiez si le titre du commentaire est une chaîne de caractères
            var regex = /^[a-zA-Z\s]*$/; // Expression régulière pour les chaînes de caractères alphabétiques
            if (!regex.test(titre_commentaire)) {
                alert("Le titre du commentaire ne doit contenir que des lettres.");
                return false;
            }

            // Mettre à jour la valeur du champ de commentaire avec la version nettoyée
            document.forms["commsForm"]["commentaire"].value = clean_commentaire;

            return true; // Soumettre le formulaire si les champs sont valides
        }
    </script>
</head>
<body>
    <div class="form">
        <a href="page aceuill0.php" class="back_btn"><img src="back.png"> Retour</a>
        <h2>Ajouter un commentaire</h2>
        <p class="error-message"><?php echo $error; ?></p>
        <form name="commsForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validateForm()">

            <!-- Champ caché pour l'ID du forum -->
            <input type="hidden" name="id_forum" value="15">
            <!-- Remplacez '1' par la valeur de l'ID du forum que vous souhaitez -->
            <!-- Ajout du champ pour le titre du commentaire -->
            <label>Titre du commentaire</label>
            <input type="text" name="titre_commentaire" placeholder="Titre du commentaire" required="">
            <!-- Utilisez une zone de texte pour le contenu du commentaire -->
            <label>Contenu du commentaire</label>
            <textarea name="commentaire" placeholder="Contenu du commentaire" required=""></textarea>
            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>
</body>
</html>
