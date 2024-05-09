<?php
include "../../controlleur/locationC.php";

$locationController = new LocationC();
$locations = $locationController->listLocations();

// Vérifier si l'identifiant de l'emplacement à supprimer est passé dans l'URL
if (isset($_GET['id_location'])) {
  // Supprimer l'emplacement avec l'identifiant passé dans l'URL
  $locationController->deleteLocation($_GET["id_location"]);
  // Rediriger vers cette même page après la suppression
  header('Location: liste_location.php');
  exit(); // Terminer le script après la redirection
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des emplacements</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #193962;
      /* Bleu foncé */
      font-family: 'Arial', sans-serif;
      /* Fonte stylée */
    }

    .card-header {
      background-color: #3EA8BE;
      /* Bleu clair */
    }

    .form-group i {
      margin-right: 10px;
    }

    .btn-center {
      text-align: center;
    }

    /* Style pour les cards */
    .card {
      background-color: #FBFAFA;
      border: 6px solid #000000;
      /* Bordure noire */
      border-radius: 20px;
      /* Bord arrondi */
      margin-bottom: 20px;
    }

    /* Style pour le titre des cards */
    .card-title {
      color: #000000;
      /* Texte noir */
      font-size: 1.5rem;
      text-align: center;
      /* Centrer le titre */
    }

    /* Style pour le contenu des cards */
    .card-text {
      color: #000000;
      /* Texte noir */
    }

    /* Style pour les boutons */
    .btn-group {
      text-align: center;
      /* Centrer les boutons */
    }

    /* Style pour les boutons Modifier et Supprimer */
    .btn-modifier {
      background-color: #2e8b57;
      /* Couleur jaune */
      color: #000000;
      /* Texte noir */
      border: none;
      padding: 5px 15px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn-modifier:hover {
      background-color: #2e8b57;
      /* Couleur jaune plus foncée au survol */
      color: #000000;
      /* Texte noir */
    }

    .btn-supprimer {
      background-color: #D3394E;
      /* Couleur rouge */
      color: #ffffff;
      /* Texte blanc */
      border: none;
      padding: 5px 15px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn-supprimer:hover {
      background-color: #B52A39;
      /* Couleur rouge plus foncée au survol */
      color: #ffffff;
      /* Texte blanc */
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="text-center text-white mb-4">Liste des emplacements</h1>
    <!-- Bouton "Ajouter un emplacement" -->
    <div class="text-center mb-3">
      <a href="add_location.php" class="btn btn-success">Ajouter un emplacement</a>
    </div>
    <div class="row">
      <?php foreach ($locations as $location) : ?>
        <div class="col-md-6">
          <div class="card mb-4">
            <div class="card-body">
              <!-- Utiliser des icônes pour représenter chaque information -->
              <h5 class="card-title"><i class="fas fa-location-arrow"></i> <strong><?php echo $location['emplacement']; ?></strong></h5>
              <!-- Ajout de la capacité de l'emplacement -->
              <p class="card-text"><i class="fas fa-users"></i> <strong>Capacité:</strong> <?php echo $location['capacite']; ?></p>
              <!-- Ajout de la catégorie de l'emplacement -->
              <p class="card-text"><i class="fas fa-map-marker-alt"></i> <strong>Catégorie:</strong> <?php echo $location['categorie']; ?></p>
              <div class="d-flex justify-content-center">
                <div class="btn-group">
              
                
                  <button class="btn btn-sm btn-modifier voir-plus"><i class="fas fa-plus"></i> Voir plus</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script>
    // Sélectionner tous les boutons "Voir plus"
    var voirPlusButtons = document.querySelectorAll('.voir-plus');

    // Boucler à travers chaque bouton et ajouter un gestionnaire d'événement de clic
    voirPlusButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        // Trouver la section de détail correspondante
        var detail = this.parentNode.parentNode.parentNode.querySelector('.card-text:nth-child(2)');
        // Basculer la visibilité de la section de détail
        detail.hidden = !detail.hidden;
      });
    });

    function confirmDelete(locationId) {
      if (confirm("Êtes-vous sûr de vouloir supprimer cet emplacement ?")) {
        window.location.href = "liste_location.php?id_location=" + locationId;
      }
    }
  </script>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>