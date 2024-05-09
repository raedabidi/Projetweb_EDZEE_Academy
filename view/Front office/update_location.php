<?php
include '../../controlleur/locationC.php';
include '../../modele/location.php';

// Créer une instance de l'emplacement
$location = null;

// Créer une instance du contrôleur
$locationC = new LocationC();

// Vérifier si le formulaire a été soumis
if (isset($_POST["submit"])) {
  // Vérifier la présence des champs requis
  if (
    isset($_POST["emplacement"]) &&
    isset($_POST["capacite"]) &&
    isset($_POST["categorie"])
  ) {
    // Vérifier que les champs requis ne sont pas vides
    if (
      !empty($_POST['emplacement']) &&
      !empty($_POST["capacite"]) &&
      !empty($_POST["categorie"])
    ) {
      // Créer une instance de l'emplacement
      $location = new Location();
      $location->setValues(
        $_POST['emplacement'],
        $_POST['capacite'],
        $_POST['categorie']
      );

      // Mettre à jour l'emplacement dans la base de données
      $locationC->updateLocation($location, $_POST['id_location']);

      // Rediriger vers la liste des emplacements après la mise à jour
      header('Location:liste_location.php');
    }
  }
}

// Récupérer les données de l'emplacement à partir de la base de données
if (isset($_GET['id_location'])) {
  $oldLocation = $locationC->showLocation($_GET['id_location']);
} else {
  // Gérer le cas où l'ID de l'emplacement n'est pas défini
  echo "ID de l'emplacement non spécifié.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Location</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #193962;
      /* Bleu foncé */
      color: #ffffff;
      /* Texte blanc */
    }

    .card {
      background-color: #2C3E50;
      /* Bleu marine */
      color: #ffffff;
      /* Texte blanc */
    }

    .btn-primary {
      background-color: #3498DB !important;
      /* Bleu clair */
      border-color: #3498DB !important;
      /* Bordure bleue clair */
    }

    .btn-primary:hover {
      background-color: #2980B9 !important;
      /* Bleu un peu plus foncé au survol */
      border-color: #2980B9 !important;
      /* Bordure bleue un peu plus foncée au survol */
    }

    .form-group label {
      font-weight: bold;
      /* Texte en gras */
    }
  </style>
</head>

<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Update Location</h3>
          </div>
          <div class="card-body">
            <form action="" method="POST" id="updateLocationForm">
              <input type="hidden" name="id_location" value="<?php echo $_GET['id_location']; ?>">
              <div class="text-center mt-3">
                <a href="liste_location.php" class="btn btn-secondary">Back to list</a>
              </div>
              <div class="form-group">
                <label for="emplacement">Emplacement:</label>
                <input type="text" class="form-control" id="emplacement" name="emplacement" value="<?php echo isset($_POST['emplacement']) ? $_POST['emplacement'] : $oldLocation['emplacement']; ?>">
              </div>
              <div class="form-group">
                <label for="capacite">Capacité:</label>
                <input type="number" class="form-control" id="capacite" name="capacite" value="<?php echo isset($_POST['capacite']) ? $_POST['capacite'] : $oldLocation['capacite']; ?>">
              </div>
              <div class="form-group">
                <label for="categorie">Catégorie:</label>
                <select class="form-control" id="categorie" name="categorie">
                  <option value="musée" <?php if (isset($_POST['categorie']) && $_POST['categorie'] === 'musée') echo 'selected'; ?>>Musée</option>
                  <option value="parc" <?php if (isset($_POST['categorie']) && $_POST['categorie'] === 'parc') echo 'selected'; ?>>Parc</option>
                  <option value="restaurant" <?php if (isset($_POST['categorie']) && $_POST['categorie'] === 'restaurant') echo 'selected'; ?>>Restaurant</option>
                  <option value="maison_hote" <?php if (isset($_POST['categorie']) && $_POST['categorie'] === 'maison_hote') echo 'selected'; ?>>Maison d'hôte</option>
                  <option value="hotel" <?php if (isset($_POST['categorie']) && $_POST['categorie'] === 'hotel') echo 'selected'; ?>>Hôtel</option>
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary" name="submit" id="updateLocationButton">Save</button>
                <a href="liste_location.php" class="btn btn-primary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Fonction de validation du formulaire
      function validateForm() {
        var isValid = true;
        var errorMessage = "";

        // Récupérer les valeurs des champs
        var emplacement = document.getElementById("emplacement").value;
        var capacite = document.getElementById("capacite").value;
        var categorie = document.getElementById("categorie").value;

        // Validation du champ "Emplacement"
        if (emplacement.trim() === "") {
          errorMessage += "Le champ 'Emplacement' est obligatoire.\n";
          isValid = false;
        }

        // Validation du champ "Capacité"
        if (capacite.trim() === "") {
          errorMessage += "Le champ 'Capacité' est obligatoire.\n";
          isValid = false;
        } else if (capacite <= 0) {
          errorMessage += "Le champ 'Capacité' doit être strictement supérieur à zéro.\n";
          isValid = false;
        }

        // Validation du champ "Catégorie"
        if (categorie.trim() === "") {
          errorMessage += "Le champ 'Catégorie' est obligatoire.\n";
          isValid = false;
        }

        // Afficher le message d'alerte s'il y a des erreurs
        if (!isValid) {
          alert(errorMessage);
        }

        return isValid;
      }

      // Gestionnaire d'événements pour la soumission du formulaire
      document.getElementById("updateLocationForm").addEventListener("submit", function(event) {
        // Validation du formulaire
        if (!validateForm()) {
          event.preventDefault(); // Empêcher la soumission du formulaire si la validation échoue
        }
      });

    });
  </script>
</body>

</html>