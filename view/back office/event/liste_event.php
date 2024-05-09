<?php
include "../../../controlleur/eventC.php";

$eventController = new EventC();
$events = $eventController->listEvents();

// Vérifier si l'identifiant de l'événement à supprimer est passé dans l'URL
if(isset($_GET['id_event'])) {
    // Supprimer l'événement avec l'identifiant passé dans l'URL
    $eventController->deleteEvent($_GET["id_event"]);
    // Rediriger vers cette même page après la suppression
    header('Location: liste_event.php');
    exit(); // Terminer le script après la redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des événements</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #193962; /* Bleu foncé */
            font-family: 'Arial', sans-serif; /* Fonte stylée */
        }

        .card-header {
            background-color: #3EA8BE; /* Bleu clair */
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
            border: 6px solid #000000; /* Bordure noire */
            border-radius: 20px; /* Bord arrondi */
            margin-bottom: 20px;
        }

        /* Style pour le titre des cards */
        .card-title {
            color: #000000; /* Texte noir */
            font-size: 1.5rem;
            text-align: center; /* Centrer le titre */
        }

        /* Style pour le contenu des cards */
        .card-text {
            color: #000000; /* Texte noir */
        }

        /* Style pour les boutons */
        .btn-group {
            text-align: center; /* Centrer les boutons */
        }

        /* Style pour les boutons Modifier et Supprimer */
        .btn-modifier {
            background-color: #FFCA2C; /* Couleur jaune */
            color: #000000; /* Texte noir */
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-modifier:hover {
            background-color: #E8B923; /* Couleur jaune plus foncée au survol */
            color: #000000; /* Texte noir */
        }

        .btn-supprimer {
            background-color: #D3394E; /* Couleur rouge */
            color: #ffffff; /* Texte blanc */
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-supprimer:hover {
            background-color: #B52A39; /* Couleur rouge plus foncée au survol */
            color: #ffffff; /* Texte blanc */
        }
    </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center text-white mb-4">Liste des événements</h1>
    <!-- Bouton "Ajouter un événement" -->
    <div class="text-center mb-3">
        <a href="add_event.php" class="btn btn-primary">Ajouter un événement</a>
    </div>
    <div class="row">
      <?php foreach ($events as $event): ?>
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <!-- Ajout de l'icône -->
            <h5 class="card-title"><i class="fas fa-calendar-alt"></i> <?php echo $event['date_debut']; ?></h5>
            <p class="card-text"><strong>Sujet:</strong> <?php echo $event['sujet']; ?></p>
            <p class="card-text"><strong>Date de début:</strong> <?php echo $event['date_debut']; ?></p>
            <p class="card-text"><strong>Date de fin:</strong> <?php echo $event['date_fin']; ?></p>
            <p class="card-text"><strong>Lieu:</strong> <?php echo $event['local']; ?></p>
            <div class="d-flex justify-content-center">
              <div class="btn-group">
                <a href="update_event.php?id_event=<?php echo $event['id_event']; ?>" class="btn btn-sm btn-modifier"><i class="fas fa-edit"></i> Modifier</a>
                <a href="#" onclick="confirmDelete(<?php echo $event['id_event']; ?>)" class="btn btn-sm btn-supprimer"><i class="fas fa-trash-alt"></i> Supprimer</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script>
    function confirmDelete(eventId) {
      if (confirm("Êtes-vous sûr de vouloir supprimer cet événement ?")) {
        window.location.href = "liste_event.php?id_event=" + eventId;
      }
    }
  </script>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>