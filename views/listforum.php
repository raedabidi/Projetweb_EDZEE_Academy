<?php
include "../controller/forumC.php";

$c = new ForumC();
$orderBy = isset($_GET['order']) ? $_GET['order'] : 'ASC'; 
$searchTerm = isset($_GET['search']) ? $_GET['search'] : ''; // Récupérer le terme de recherche

// Déterminer le texte des boutons en fonction de l'ordre actuel
$ascButtonLabel = $orderBy === 'ASC' ? '▲' : 'Ascendant';
$descButtonLabel = $orderBy === 'DESC' ? '▼' : 'Descendant';

// Effectuer la recherche si un terme est saisi
if (!empty($searchTerm)) {
    $tab = $c->searchForumByMatiere($searchTerm); // Utiliser la méthode de recherche par matière
} else {
    $tab = $c->listforum($orderBy);
}

// Vérifie si le bouton d'exportation PDF a été cliqué
if (isset($_POST['export_pdf'])) {
    // Inclure la bibliothèque FPDF
    require '../views/fpdf186/fpdf.php'; // Assurez-vous de fournir le chemin correct

    // Créer une nouvelle instance de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Définir la police
    $pdf->SetFont('Arial', 'B', 16);

    // Titre du document
    $pdf->Cell(0, 10, 'Liste des Forums', 0, 1, 'C');

    // Entête de tableau
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'ID Forum', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Titre Forum', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Date Forum', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Matiere Forum', 1, 0, 'C');
    $pdf->Cell(90, 10, 'Description Forum', 1, 1, 'C'); // La colonne description forum

    // Contenu du tableau
    $pdf->SetFont('Arial', '', 10);
    foreach ($tab as $forum) {
        $pdf->Cell(30, 10, $forum['id_forum'], 1, 0, 'C');
        $pdf->Cell(60, 10, $forum['titre_forum'], 1, 0, 'C');
        $pdf->Cell(40, 10, $forum['date_forum'], 1, 0, 'C');
        $pdf->Cell(50, 10, $forum['matiere_forum'], 1, 0, 'C');

        // Obtenir la largeur maximale de la colonne "Description Forum"
        $maxWidth = 90; // Largeur initiale de la colonne
        $descWidth = $pdf->GetStringWidth($forum['desc_forum']); // Largeur réelle du texte
        if ($descWidth > $maxWidth) {
            $maxWidth = $descWidth; // Mettre à jour la largeur maximale si nécessaire
        }

        // Afficher la cellule avec la largeur maximale calculée
        $pdf->MultiCell($maxWidth, 10, $forum['desc_forum'], 1, 'L');
    }

    // Nom du fichier PDF de sortie
    $file_name = 'liste_des_forums.pdf';

    // Sortie du PDF au navigateur
    $pdf->Output($file_name, 'D');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Forums</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .sort-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .sort-buttons button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sort-buttons button:hover {
            background-color: #ddd;
        }
    </style>
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
                    <h1>Liste des Forums</h1>
                    <h2><a href="ajouterforum.php">Ajouter Forum</a></h2>
                    <!-- Formulaire de recherche -->
                    <form method="GET" action="">
                        <input type="text" name="search" placeholder="Rechercher par matière...">
                        <button type="submit" name="submit" value="search">Rechercher</button>
                    </form>
                    <!-- Ajouter des boutons pour le tri -->
                    <div class="sort-buttons">
                        <form method="GET" action="">
                            <input type="hidden" name="order" value="<?= $orderBy === 'ASC' ? 'DESC' : 'ASC'; ?>">
                            <button type="submit" name="submit" value="asc"><?= $ascButtonLabel ?></button>
                        </form>
                        <form method="GET" action="">
                            <input type="hidden" name="order" value="<?= $orderBy === 'DESC' ? 'ASC' : 'DESC'; ?>">
                            <button type="submit" name="submit" value="desc"><?= $descButtonLabel ?></button>
                        </form>
                    </div>
                    <!-- Ajouter le formulaire d'exportation PDF -->
                    <form method="POST" action="">
                        <button type="submit" name="export_pdf">Exporter en PDF</button>
                    </form>
                    <table border="1" align="center" width="80%">
                        <tr>
                            <th>ID Forum</th>
                            <th>Titre Forum</th>
                            <th>Date Forum</th>
                            <th>Sujet Forum</th>
                            <th>Description Forum</th> <!-- Correction ici -->
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>

                        <?php foreach ($tab as $forum) { ?>
                            <tr>
                                <td><?= $forum['id_forum']; ?></td>
                                <td><?= $forum['titre_forum']; ?></td>
                                <td><?= $forum['date_forum']; ?></td>
                                <td><?= $forum['matiere_forum']; ?></td>
                                <td><?= $forum['desc_forum']; ?></td> <!-- Correction ici -->
                                <td align="center">
                                    <form method="POST" action="modifierforum.php">
                                        <input type="submit" name="update" value="Update">
                                        <input type="hidden" value=<?= $forum['id_forum']; ?> name="id_forum">
                                    </form>
                                </td>
                                <td>
                                    <a href="supprimerforum.php?id=<?= $forum['id_forum']; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
