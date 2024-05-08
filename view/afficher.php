<?php
include "../controller/FormationC.php";

$c = new FormationC();
$tab = $c->ListeFormations();

// Récupérer le terme de recherche saisi par l'utilisateur
$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : '';

// Récupérer le type de tri choisi par l'utilisateur
$tri = isset($_GET['tri']) ? $_GET['tri'] : '';

// Si un terme de recherche est spécifié, filtrer les résultats
if (!empty($recherche)) {
    // Filtrer les formations pour ne garder que celles qui correspondent à la recherche
    $tab = array_filter($tab, function($formation) use ($recherche) {
        // Comparez le terme de recherche avec le titre de la formation
        return strpos(strtolower($formation['Titre']), strtolower($recherche)) !== false;
    });
    
}

// Vérifier si aucun résultat n'a été trouvé
if (empty($tab) && !empty($recherche)) {
    echo "<p>Aucun titre ne correspond à votre recherche.</p>";
}

if ($tri == 'prix_croissant') {
    // Trier par prix croissant
    usort($tab, function($a, $b) {
        return $a['Prix'] - $b['Prix'];
    });
} elseif ($tri == 'prix_decroissant') {
    // Trier par prix décroissant
    usort($tab, function($a, $b) {
        return $b['Prix'] - $a['Prix'];
    });
} elseif ($tri == 'date_croissante') {
    // Trier par date croissante
    usort($tab, function($a, $b) {
        return strtotime($a['Date']) - strtotime($b['Date']);
    });
} elseif ($tri == 'date_decroissante') {
    // Trier par date décroissante
    usort($tab, function($a, $b) {
        return strtotime($b['Date']) - strtotime($a['Date']);
    });
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Liste des Formations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container py-5">
        <img src="BackGformation.jpg" alt="logo">
        <div class="text-center mb-5">
            <hr>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                  

                    <?php if (empty($tab) && !empty($recherche)) : ?>
                        <p>Aucun titre ne correspond à votre recherche.</p>
                    <?php endif; ?>

                    <h1>Liste des Formations</h1>
                    <h2><a href="ajouter.php">Ajouter Formation</a></h2>
                 <!-- Formulaire de recherche -->
                  <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="recherche">Recherche :</label>
                        <input type="text" name="recherche" id="recherche" value="<?php echo htmlentities($recherche); ?>">
                        <input type="submit" value="Rechercher">
                    </form>
                    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="tri">Trier par :</label>
                        <select name="tri" id="tri">
                            <option value="">Choisir un tri</option>
                            <option value="prix_croissant">Prix Croissant</option>
                            <option value="prix_decroissant">Prix Décroissant</option>
                            <option value="date_croissante">Date Croissante</option>
                            <option value="date_decroissante">Date Décroissante</option>
                        </select>
                        <input type="submit" value="Trier">
                    </form>

                    <table class="table table-striped" border="1" align="center" width="80%">
                        <tr>
                            <th>IDF</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Ressource</th>
                            <th>Prix</th>
                            <th>Date</th>
                            <th>Lieu</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                      
                        <?php foreach ($tab as $formation) { ?>
                            <tr>
                                <td><?= $formation['IDF']; ?></td>
                                <td><?= $formation['Titre']; ?></td>
                             
                                <td><a href="#" class="voir-plus" data-description="<?= $formation['Description']; ?>">Consulter</a></td>

                             
                               
                                <td><?= $formation['Status']; ?></td>
                                <td><?= $formation['Ressource']; ?></td>
                                <td><?= $formation['Prix']; ?></td>
                                <td><?= $formation['Date']; ?></td>
                                <td><?= $formation['Lieu']; ?></td>
                                <td align="center">
                                    <form method="POST" action="modifier.php">
                                        <input type="submit" name="update" value="Update">
                                        <input type="hidden" value="<?= $formation['IDF']; ?>" name="IDF">
                                    </form>
                                </td>
                                <td>
                                    <a href="supprimer.php?id=<?= $formation['IDF']; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">Description :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="descriptionBody">
                <p id="descriptionText"></p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('.voir-plus').click(function(){
        // Récupérer la description à partir de l'attribut data-description
        var description = $(this).data('description');
        // Afficher la description dans la boîte modale
        $('#descriptionText').text(description);
        $('#descriptionModal').modal('show');
    });
});
</script>
</body>
</html>