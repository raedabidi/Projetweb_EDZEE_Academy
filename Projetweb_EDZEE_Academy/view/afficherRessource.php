<?php
include '../Controller/RessourcesC.php';

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
                                
                                <th>VID</th>
                                <th>IMG</th>
                                <th>Type</th>
                                <th>Date Ajout</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tab as $fressource) { ?>
                                <tr>
                                <?php
                                $img_path = "img/";
                                // Chemin complet de l'image
                                $image_path = $img_path .$fressource['IMG'];
                                $vid_path = "Vid/";
                                $video_path = $vid_path . $fressource['VID'];
                                ?>
                                <td>
                                <video controls class="w-[50%] ">
                                <source src="<?= $video_path; ?>" type="video/mp4">
                                </video></td>
                                <td><img src="<?= $image_path; ?>" alt="" class="w-[100%] h-[100%] object-cover group-hover:brightness-75 group-hover:scale-[1.2] absolute transition-all duration-1000"></td>
                                <td><?= $fressource['Type']; ?></td>
                                    <td><?= $fressource['DateAjout']; ?></td>
                                    <td align="center">
                                        <form method="POST" action="modifierRessource.php">
                                            <input type="submit" name="update" value="Update">
                                            <input type="hidden" value="<?= $fressource['IDR']; ?>" name="IDR">
                                        </form>
                                    </td>
                                    <td>
                                        <a href="supprimerRessource.php?id=<?= $fressource['IDR']; ?>">Delete</a>
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