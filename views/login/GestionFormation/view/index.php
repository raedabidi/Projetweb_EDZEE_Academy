<?php
include "../controller/FormationC.php"; // Modification du nom du contrôleur

$c = new formationC(); // Modification de la création d'une instance du contrôleur
$tab = $c->ListeFormations(); // Modification de la méthode pour obtenir la liste des formations

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Formations</title> <!-- Modification du titre -->
    <link rel="stylesheet" href="style.css"> <!-- Modification du nom du fichier CSS -->
    <style>
        body {
            background-image: url('votre_image_de_fond.jpg'); /* Ajout de l'image de fond */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="ajouter.php" class="Btn_add"> <img src="plus.png"> Ajouter</a>
        
        <table>
            <tr id="items">
                <th>ID Formation</th> <!-- Modification des en-têtes des colonnes -->
                <th>Titre</th>
                <th>Description</th>
                <th>Ressource</th>
                <th>Status</th>
                <th>Prix</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach($tab as $formation): ?>
           
                        <tr>
                            <td><?= $formation['IDF'] ?></td> <!-- Modification des attributs à afficher -->
                            <td><?= $formation['Titre'] ?></td>
                            <td><?= $formation['Description'] ?></td>
                            <td><?= $formation['Ressource'] ?></td>
                            <td><?= $formation['Status'] ?></td>
                            <td><?= $formation['Prix'] ?></td>
                            
                            <td><a href="modifier.php?id=<?= $formation['IDF'] ?>"><img src="pen.png"></a></td>
                            <td><a href="supprimer.php?id=<?= $formation['IDF'] ?>"><img src="trash.png"></a></td>
                       
                        </tr>
                        <?php endforeach; ?>     
        </table>
    </div>
</body>
</html>