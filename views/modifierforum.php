<?php
include '../controller/forumC.php';
include '../Model/forum.php';

$error = "";

// Créer une instance du contrôleur
$forumC = new ForumC();

if (
    isset($_POST["id_forum"]) &&
    isset($_POST["titre_forum"]) &&
    isset($_POST["matiere_forum"]) &&
    isset($_POST["desc_forum"])
) {
    if (
        !empty($_POST['id_forum']) &&
        !empty($_POST['titre_forum']) &&
        !empty($_POST["matiere_forum"]) &&
        !empty($_POST["desc_forum"])
    ) {
        $id_forum = $_POST['id_forum'];
        $titre_forum = $_POST['titre_forum'];
        // Récupérer la date actuelle
        $date_forum = date("Y-m-d"); // Format: Année-Mois-Jour
        $matiere_forum = $_POST['matiere_forum'];
        $desc_forum = $_POST['desc_forum'];

        // Créer un nouvel objet forum
        $forum = new forum($titre_forum, $date_forum, $matiere_forum, $desc_forum);

        // Mettre à jour l'enregistrement en utilisant la méthode ForumC
        $forumC->updateForum($forum, $id_forum);

        // Rediriger vers index.php après la mise à jour réussie
        header('Location: index.php');
        exit();
    } else {
        $error = "Informations manquantes";
    }
}

// Options de matières pour la liste déroulante
$matiereOptions = array(
    "General",
    "Tests",
    "Mathematique",
    "Français",
    "Anglais",
    "Science",
    "Economie",
    "Infographie",
    "Informatique"
);
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
        <h2>Modifier un forum</h2>
        <p class="erreur_message">
            <?php 
            // Afficher le message d'erreur s'il y a une erreur
            echo $error;
            ?>
        </p>
     
        <form action="" method="POST" onsubmit="return validateForm()">
            <label>ID Forum</label>
            <input type="text" name="id_forum" value="<?php echo isset($_POST['id_forum']) ? $_POST['id_forum'] : ''; ?>" placeholder="ID Forum" required="">
            <label>Titre</label>
            <input type="text" id="titre_forum" name="titre_forum" value="<?php echo isset($_POST['titre_forum']) ? $_POST['titre_forum'] : ''; ?>" placeholder="Titre" required="">
            <!-- Supprimez le champ pour la date, car elle sera ajoutée automatiquement -->
            <label>Matière</label>
            <select id="matiere_forum" name="matiere_forum" required="">
                <option value="">Choisissez un sujet</option>
                <?php foreach ($matiereOptions as $option) { ?>
                    <option value="<?php echo $option; ?>" <?php echo isset($_POST['matiere_forum']) && $_POST['matiere_forum'] === $option ? 'selected' : ''; ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
            <!-- Ajout du champ pour la description -->
            <label>Description</label>
            <textarea name="desc_forum" placeholder="Description du forum" required=""><?php echo isset($_POST['desc_forum']) ? $_POST['desc_forum'] : ''; ?></textarea>
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>

    <script>
        function validateForm() {
            var titreForum = document.getElementById("titre_forum").value;
            var matiereForum = document.getElementById("matiere_forum").value;
            var descForum = document.getElementsByName("desc_forum")[0].value;
            
            // Vérifier si les champs sont vides ou ne contiennent que des espaces
            if (titreForum.trim() === '' || matiereForum.trim() === '' || descForum.trim() === '') {
                alert("Veuillez remplir tous les champs.");
                return false;
            }

            // Vérifier si les champs ne contiennent que des lettres et des espaces
            var letters = /^[A-Za-z\s]+$/;
            if (!titreForum.match(letters) || !matiereForum.match(letters)) {
                alert("Les champs 'Titre' et 'Matière' doivent contenir uniquement des lettres et des espaces.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
