<?php

include "../controller/forumC.php";

$c = new ForumC(); // Instanciation du contrôleur

// Vérifiez si l'ordre est défini dans l'URL
$orderBy = isset($_GET['order']) ? $_GET['order'] : 'ASC'; // Par défaut, tri par ordre ascendant

$tab = $c->listforum($orderBy); // Appel de la méthode listforum() avec l'argument $orderBy

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion forum</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="ajouterforum.php" class="Btn_add"> <img src="plus.png"> Ajouter</a>
        
        <table>
            <tr id="items">
                <th>ID forum</th>
                <th>Titre forum</th>
                <th>Date forum</th>
                <th>Sujet forum</th>
                <th>Description forum</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach($tab as $forum): ?>
           
                        <tr>
                            <td><?= $forum['id_forum'] ?></td>
                            <td><?=$forum['titre_forum']?></td>
                            <td><?=$forum['date_forum']?></td>
                            <td><?=$forum['matiere_forum']?></td>
                            <td><?=$forum['desc_forum']?></td>
                            
                            <td><a href="modifierforum.php?id=<?=$forum['id_forum']?>"><img src="pen.png"></a></td>
                            <td><a href="supprimerforum.php?id=<?=$forum['id_forum']?>"><img src="trash.png"></a></td>
                       
                        </tr>
                        <?php endforeach; ?>     
        </table>
    </div>
</body>
</html>
