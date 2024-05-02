<?php
include "../controller/RessourcesC.php";

$c = new RessourcesC();
$tab = $c->ListeRessources();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Ressources</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container py-5">
        <img src="BackGformation.jpg" alt="log">
        <div class="text-center mb-5">          
            <hr>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Lien</th>
                                <th>IMG</th>
                                <th>Type</th>
                                <th>Date Ajout</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tab as $ressources) { ?>
                                <tr>
                                    <td><?= $ressources['Lien']; ?></td>
                                    <td><img src="<?= $ressources['IMG']; ?>" alt="image"></td>
                                    <td><?= $ressources['Type']; ?></td>
                                    <td><?= $ressources['DateAjout']; ?></td>
                                    <td align="center">
                                        <form method="POST" action="modifierRessource.php">
                                            <input type="submit" name="update" value="Update">
                                            <input type="hidden" value="<?= $ressources['IDR']; ?>" name="IDR">
                                        </form>
                                    </td>
                                    <td>
                                        <a href="supprimerRessource.php?id=<?= $ressources['IDR']; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>