<?php

include('../../../controlleur/locationC.php');
include('../../../modele/location.php');

// Créer une instance du contrôleur
$locationC = new LocationC();
$erreur_msg = "";

if (
    !empty($_POST["emplacement"]) &&
    !empty($_POST["capacite"]) &&
    !empty($_POST["categorie"])
) {
    // Création de l'objet Location
    $location = new Location();
    $location->setValues(
        $_POST["emplacement"],
        $_POST["capacite"],
        $_POST["categorie"]
    );

    // Ajout de l'emplacement à la base de données
    $locationC->addLocation($location);

    header('Location: index.php');
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
    <title>Formulaire d'Emplacement</title>
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
                            <i class="fas fa-map-marker-alt"></i> Formulaire d'Emplacement
                        </div>
                        <div class="card-body">
                            <form action="add_location.php" method="POST" id="locationForm">
                                <div class="form-group">
                                    <label for="emplacement"><i class="fas fa-map-marker-alt"></i> Emplacement</label>
                                    <input type="text" class="form-control" id="emplacement" name="emplacement"
                                        placeholder="Emplacement">
                                </div>
                                <div class="form-group">
                                    <label for="capacite"><i class="fas fa-users"></i> Capacité de l'emplacement</label>
                                    <input type="number" class="form-control" id="capacite" name="capacite"
                                        placeholder="Capacité de l'emplacement">
                                </div>
                                <div class="form-group">
                                    <label for="categorie"><i class="fas fa-clipboard-list"></i> Catégorie</label>
                                    <select class="form-control" id="categorie" name="categorie">
                                        <option value="musée">Musée</option>
                                        <option value="parc">Parc</option>
                                        <option value="restaurant">Restaurant</option>
                                        <option value="maison_hote">Maison d'hôte</option>
                                        <option value="hotel">Hôtel</option>
                                    </select>
                                </div>
                                <div class="form-group btn-center">
                                    <button type="submit" class="btn btn-primary">Ajouter Emplacement</button>
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

                // Afficher le message d'alerte s'il y a des erreurs
                if (!isValid) {
                    alert(errorMessage);
                }

                return isValid;
            }

            // Gestionnaire d'événements pour la soumission du formulaire
            document.getElementById("locationForm").addEventListener("submit", function (event) {
                // Validation du formulaire
                if (!validateForm()) {
                    event.preventDefault(); // Empêcher la soumission du formulaire si la validation échoue
                }
            });

        });
    </script>
</body>

</html>