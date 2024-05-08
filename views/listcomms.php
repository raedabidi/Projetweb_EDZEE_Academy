<?php
include "../controller/commsC.php";

$c = new CommsC();

// Récupérer l'ordre de tri depuis l'URL ou utiliser ASC par défaut
$orderBy = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Récupérer le terme de recherche
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Effectuer la recherche si un terme est saisi
if (!empty($searchTerm)) {
    $tab = $c->searchCommentByTitle($searchTerm); // Utiliser la méthode de recherche par titre de commentaire
} else {
    $tab = $c->listComments($orderBy);
}

// Vérifier si le bouton d'exportation PDF a été cliqué
if (isset($_POST['export_pdf'])) {
    // Inclure la bibliothèque FPDF
    require '../views/fpdf186/fpdf.php'; // Assurez-vous de fournir le chemin correct

    // Créer une nouvelle instance de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Définir la police
    $pdf->SetFont('Arial', 'B', 16);

    // Titre du document
    $pdf->Cell(0, 10, 'Liste des Commentaires', 0, 1, 'C');

    // Entête de tableau
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'ID Commentaire', 1, 0, 'C');
    $pdf->Cell(30, 10, 'ID Forum', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Date Commentaire', 1, 0, 'C');
    $pdf->Cell(90, 10, 'Titre Commentaire', 1, 0, 'C');
    $pdf->Cell(90, 10, 'Contenu Commentaire', 1, 1, 'C');

    // Contenu du tableau
    $pdf->SetFont('Arial', '', 10);
    foreach ($tab as $comment) {
        $pdf->Cell(30, 10, $comment['id_commentaire'], 1, 0, 'C');
        $pdf->Cell(30, 10, $comment['id_forum'], 1, 0, 'C');
        $pdf->Cell(40, 10, $comment['date_commentaire'], 1, 0, 'C');
        $pdf->Cell(90, 10, $comment['titre_commentaire'], 1, 0, 'C');

        // Obtenir la largeur maximale de la colonne "Contenu Commentaire"
        $maxWidth = 90; // Largeur initiale de la colonne
        $contentWidth = $pdf->GetStringWidth($comment['commentaire']); // Largeur réelle du texte
        if ($contentWidth > $maxWidth) {
            $maxWidth = $contentWidth; // Mettre à jour la largeur maximale si nécessaire
        }

        // Afficher la cellule avec la largeur maximale calculée
        $pdf->MultiCell($maxWidth, 10, $comment['commentaire'], 1, 'L');
    }

    // Nom du fichier PDF de sortie
    $file_name = 'liste_des_commentaires.pdf';

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
    <title>Liste des Commentaires</title>
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
        <div class="text-center mb-5">
            <hr>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <h1>Liste des Commentaires</h1>
                    <h2><a href="ajoutercomms.php">Ajouter Commentaire</a></h2>
                    <!-- Formulaire de recherche -->
                    <form method="GET" action="">
                        <input type="text" name="search" placeholder="Rechercher par titre...">
                        <button type="submit" name="submit" value="search">Rechercher</button>
                    </form>
                    <!-- Ajouter des boutons pour le tri -->
                    <div class="sort-buttons">
                        <form method="GET" action="">
                            <input type="hidden" name="order" value="<?= $orderBy === 'ASC' ? 'DESC' : 'ASC'; ?>">
                            <button type="submit" name="submit" value="asc">Tri <?= $orderBy === 'ASC' ? 'descendant' : 'ascendant'; ?></button>
                        </form>
                    </div>
                    <!-- Ajouter le formulaire d'exportation PDF -->
                    <form method="POST" action="">
                        <button type="submit" name="export_pdf">Exporter en PDF</button>
                    </form>
                    <table border="1" align="center" width="80%">
                        <tr>
                            <th>ID Commentaire</th>
                            <th>ID Forum</th>
                            <th>Date Commentaire</th>
                            <th>Titre Commentaire</th>
                            <th>Contenu Commentaire</th>
                            <th>Like</th>
                            <th>Dislike</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>

                        <?php foreach ($tab as $comment) { ?>
                            <tr>
                                <td><?= $comment['id_commentaire']; ?></td>
                                <td><?= $comment['id_forum']; ?></td>
                                <td><?= $comment['date_commentaire']; ?></td>
                                <td><?= $comment['titre_commentaire']; ?></td>
                                <td><?= $comment['commentaire']; ?></td>
                                <td>
                                    <?= $comment['like_dislike']; ?>
                                    <form method="POST" action="like.php">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id_commentaire']; ?>">
                                        <button type="submit">Like</button>
                                    </form>
                                </td>
                                <td>
                                    <?= $comment['like_dislike']; ?>
                                    <form method="POST" action="dislike.php">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id_commentaire']; ?>">
                                        <button type="submit">Dislike</button>
                                    </form>
                                </td>
                                <td align="center">
                                    <form method="POST" action="modifiercomms.php">
                                        <input type="submit" name="update" value="Modifier">
                                        <input type="hidden" value="<?= $comment['id_commentaire']; ?>" name="id_commentaire">
                                    </form>
                                </td>
                                <td>
                                    <a href="supprimercomms.php?id=<?= $comment['id_commentaire']; ?>">Supprimer</a>
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
