<?php
include "../controller/CommsC.php";

$c = new CommsC(); // Instanciation du contrôleur

// Vérifiez si l'ordre est défini dans l'URL
$orderBy = isset($_GET['order']) ? $_GET['order'] : 'ASC'; // Par défaut, tri par ordre ascendant

$tab = $c->listComments($orderBy); // Appel de la méthode listComms() avec l'argument $orderBy

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des commentaires</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="ajoutercomms.php" class="Btn_add"> <img src="plus.png"> Ajouter</a>
        
        <table>
            <tr id="items">
                <th>ID commentaire</th>
                <th>ID forum</th>
                <th>Titre commentaire</th>
                <th>Date commentaire</th>
                <th>Commentaire</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach($tab as $comms): ?>
           
                        <tr>
                            <td><?= $comms['id_commentaire'] ?></td>
                            <td><?=$comms['id_forum']?></td>
                            <td><?=$comms['date_commentaire']?></td>
                            <td><?=$comms['titre_commentaire']?></td>
                            <td><?=$comms['commentaire']?></td>
                            
                            <td><a href="modifiercomms.php?id=<?=$comms['id_commentaire']?>"><img src="pen.png"></a></td>
                            <td><a href="supprimercomms.php?id=<?=$comms['id_commentaire']?>"><img src="trash.png"></a></td>
                       
                        </tr>
                        <?php endforeach; ?>     
        </table>
    </div>
</body>
</html>
