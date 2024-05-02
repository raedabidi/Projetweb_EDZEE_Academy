<?php
include '../../controlleur/eventC.php';
include '../../modele/event.php';

// Créer une instance de l'événement
$event = null;

// Créer une instance du contrôleur
$eventC = new EventC();

// Vérifier si le formulaire a été soumis
if (isset($_POST["submit"])) {
    // Vérifier la présence des champs requis
    if (
        isset($_POST["sujet"]) &&
        isset($_POST["date_debut"]) &&
        isset($_POST["date_fin"]) &&
        isset($_POST["nb_place"]) &&
        isset($_POST["detail"])
    ) {
        // Vérifier que les champs requis ne sont pas vides
        if (
            !empty($_POST['sujet']) &&
            !empty($_POST["date_debut"]) &&
            !empty($_POST["date_fin"]) &&
            !empty($_POST["nb_place"]) &&
            !empty($_POST["detail"])
        ) {
            // Créer une instance de l'événement
            $event = new Event();
            $event->setValues(
                $_POST['sujet'],
                $_POST['date_debut'],
                $_POST['date_fin'],
                $_POST['nb_place'],
                $_POST['detail']
            );

            // Mettre à jour l'événement dans la base de données
            $eventC->updateEvent($event, $_POST['id_event']);

            // Rediriger vers la liste des événements après la mise à jour
            header('Location:liste_event.php');
        }
    }
}

// Récupérer les données de l'événement à partir de la base de données
if (isset($_GET['id_event'])) {
    $oldEvent = $eventC->showEvent($_GET['id_event']);
} else {
    // Gérer le cas où l'ID de l'événement n'est pas défini
    echo "ID de l'événement non spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #193962; /* Bleu foncé */
            color: #ffffff; /* Texte blanc */
        }
        .card {
            background-color: #2C3E50; /* Bleu marine */
            color: #ffffff; /* Texte blanc */
        }
        .btn-primary {
            background-color: #3498DB !important; /* Bleu clair */
            border-color: #3498DB !important; /* Bordure bleue clair */
        }
        .btn-primary:hover {
            background-color: #2980B9 !important; /* Bleu un peu plus foncé au survol */
            border-color: #2980B9 !important; /* Bordure bleue un peu plus foncée au survol */
        }
        .form-group label {
            font-weight: bold; /* Texte en gras */
        }
    </style>
</head>
<body>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Update Event</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="updateEventForm">
                            <input type="hidden" name="id_event" value="<?php echo $_GET['id_event']; ?>">
                            <div class="text-center mt-3">
                                <a href="liste_event.php" class="btn btn-secondary">Back to list</a>
                            </div>          
                            <div class="form-group">
                                <label for="sujet">Sujet:</label>
                                <input type="text" class="form-control" id="sujet" name="sujet" value="<?php echo isset($_POST['sujet']) ? $_POST['sujet'] : $oldEvent['sujet']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="detail">Détail:</label>
                                <textarea class="form-control" id="detail" name="detail"><?php echo isset($_POST['detail']) ? $_POST['detail'] : $oldEvent['detail']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date_debut">Date de début:</label>
                                <input type="datetime-local" class="form-control" id="date_debut" name="date_debut" value="<?php echo isset($_POST['date_debut']) ? $_POST['date_debut'] : $oldEvent['date_debut']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="date_fin">Date de fin:</label>
                                <input type="datetime-local" class="form-control" id="date_fin" name="date_fin" value="<?php echo isset($_POST['date_fin']) ? $_POST['date_fin'] : $oldEvent['date_fin']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nb_place">Nombre de places:</label>
                                <input type="number" class="form-control" id="nb_place" name="nb_place" value="<?php echo isset($_POST['nb_place']) ? $_POST['nb_place'] : $oldEvent['nb_place']; ?>">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="submit" id="updateEventButton">Save</button>
                                <a href="liste_event.php" class="btn btn-primary">Cancel</a>
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
        document.addEventListener("DOMContentLoaded", function () {
            // Fonction de validation du formulaire
            function validateForm() {
                var isValid = true;
                var errorMessage = "";

                // Récupérer les valeurs des champs
                var sujet = document.getElementById("sujet").value;
                var detail = document.getElementById("detail").value;
                var dateDebut = new Date(document.getElementById("date_debut").value.replace("T", " "));
                var dateFin = new Date(document.getElementById("date_fin").value.replace("T", " "));
                var nbPlace = document.getElementById("nb_place").value;

                // Obtenir la date actuelle
                var currentDate = new Date();

                // Validation du champ "Sujet"
                if (sujet.trim() === "") {
                    errorMessage += "Le champ 'Sujet' est obligatoire.\n";
                    isValid = false;
                }

                // Validation du champ "Détail"
                if (detail.trim() === "") {
                    errorMessage += "Le champ 'Détail' est obligatoire.\n";
                    isValid = false;
                }

                // Validation du champ "Date de début"
                if (document.getElementById("date_debut").value.trim() === "") {
                    errorMessage += "Le champ 'Date de début' est obligatoire.\n";
                    isValid = false;
                } else if (dateDebut.toString() === "Invalid Date" || dateDebut <= currentDate) {
                    errorMessage += "Veuillez saisir une date de début valide dans le futur.\n";
                    isValid = false;
                }

                // Validation du champ "Date de fin"
                if (document.getElementById("date_fin").value.trim() === "") {
                    errorMessage += "Le champ 'Date de fin' est obligatoire.\n";
                    isValid = false;
                } else if (dateFin.toString() === "Invalid Date" || dateFin <= dateDebut) {
                    errorMessage += "Veuillez saisir une date de fin valide postérieure à la date de début.\n";
                    isValid = false;
                }

                // Validation du champ "Nombre de places"
                if (nbPlace.trim() === "") {
                    errorMessage += "Le champ 'Nombre de places' est obligatoire.\n";
                    isValid = false;
                } else if (nbPlace <= 0) {
                    errorMessage += "Le champ 'Nombre de places' doit être strictement supérieur à zéro.\n";
                    isValid = false;
                }

                // Afficher le message d'alerte s'il y a des erreurs
                if (!isValid) {
                    alert(errorMessage);
                }

                return isValid;
            }

            // Gestionnaire d'événements pour la soumission du formulaire
            document.getElementById("updateEventForm").addEventListener("submit", function (event) {
                // Validation du formulaire
                if (!validateForm()) {
                    event.preventDefault(); // Empêcher la soumission du formulaire si la validation échoue
                }
            });

        });
    </script>
</body>
</html>