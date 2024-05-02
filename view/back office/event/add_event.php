<?php

include('../../../controlleur/eventC.php');
include('../../../modele/event.php');

// Créer une instance du contrôleur
$eventC = new EventC();
$erreur_msg = "";

if (
    !empty($_POST["sujet"]) &&
    !empty($_POST["date_debut"]) &&
    !empty($_POST["date_fin"]) &&
    !empty($_POST["nb_place"])
) {
    // Création de l'objet Event
    $event = new Event();
    $event->setValues(
        $_POST["sujet"],
        $_POST["date_debut"],
        $_POST["date_fin"],
        $_POST["nb_place"], // Utilisation de la valeur de la spinbox
        $_POST["detail"]
    );

    // Ajout de l'événement à la base de données
    $eventC->addEvent($event);

    header('Location: inde.php');
    exit();
} else {
    // Afficher un message d'erreur si les champs obligatoires ne sont pas tous remplis
    $erreur_msg .= 'Erreur : Veuillez remplir tous les champs obligatoires.<br>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Événement</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #193962; /* Bleu chic */
            font-family: 'Arial', sans-serif; /* Fonte stylée */
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #3864DD; /* Bleu foncé */
        }

        .form-group i {
            margin-right: 10px;
        }

        .btn-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-white">
                            <i class="fas fa-calendar-plus"></i> Formulaire d'Événement
                        </div>
                        <div class="card-body">
                            <form action="add_event.php" method="POST" id="eventForm">
                                <div class="form-group">
                                    <label for="sujet"><i class="fas fa-heading"></i> Sujet de l'événement</label>
                                    <input type="text" class="form-control" id="sujet" name="sujet"
                                        placeholder="Sujet de l'événement">
                                </div>
                                <div class="form-group">
                                    <label for="detail"><i class="fas fa-info-circle"></i> Détail de l'événement</label>
                                    <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="Détail de l'événement"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="date_debut"><i class="fas fa-calendar-day"></i> Date de début</label>
                                    <input type="datetime-local" class="form-control" id="date_debut" name="date_debut">
                                </div>
                                <div class="form-group">
                                    <label for="date_fin"><i class="fas fa-calendar-day"></i> Date de fin</label>
                                    <input type="datetime-local" class="form-control" id="date_fin" name="date_fin">
                                </div>
                                <div class="form-group">
                                    <label for="nb_place"><i class="fas fa-users"></i> Nombre de places
                                        disponibles</label>
                                    <input type="number" class="form-control" id="nb_place" name="nb_place"
                                        placeholder="Nombre de places disponibles">
                                </div>
                                <div class="form-group btn-center">
                                    <button type="submit" class="btn btn-primary">Ajouter Événement</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Fonction de validation du formulaire
        function validateForm() {
            var isValid = true;
            var errorMessage = "";

            // Récupérer les valeurs des champs
            var sujet = document.getElementById("sujet").value;
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
            if (document.getElementById("detail").value.trim() === "") {
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
        document.getElementById("eventForm").addEventListener("submit", function (event) {
            // Validation du formulaire
            if (!validateForm()) {
                event.preventDefault(); // Empêcher la soumission du formulaire si la validation échoue
            }
        });

    });
</script>
</body>

</html>