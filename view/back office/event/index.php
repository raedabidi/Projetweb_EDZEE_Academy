<?php
// Inclure le contrôleur ou le modèle pour gérer les événements
include "../../../controlleur/eventC.php";

// Créer une instance du contrôleur des événements
$eventController = new EventC();

// Récupérer la liste des événements depuis le contrôleur
$tableau_evenement = $eventController->listEvents();
if (isset($_POST["btn-search"])) {
    $search_value = $_POST["recherche"];
    $tableau_evenement = $eventController->searchEvent($search_value);
}
$selectedFilter = "no filter";
if (isset($_POST['applyFilter'])) {
    $selectedFilter = isset($_POST['filtre']) ? $_POST['filtre'] : 'no filter';
    if ($selectedFilter === 'sujet A to Z') {
        $tableau_evenement = $eventController->filterEventSujetAZ();
    } else if ($selectedFilter === 'sujet Z to A') {
        $tableau_evenement = $eventController->filterEventSujetZA();
    } else if ($selectedFilter == "no filter") {
        $tableau_evenement = $eventController->listEvents();
    }
}
// Vérifier si $tableau_evenement est défini et n'est pas vide avant de l'afficher dans le HTML
if (empty($tableau_evenement)) {
    echo "Aucun événement trouvé.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js'></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Template</title>
    <style>
        .content main .insights {
            margin-top: 20px;
        }

        .content main .insights li {
            padding: 24px;
            background: var(--light);
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 24px;
            cursor: pointer;
        }

        /* Style pour le bouton "Ajouter événement" */
        #ajouter_evenement {
            cursor: pointer;
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
        }

        /* Style pour le formulaire d'ajout d'événement */
        #formulaire_ajouter_event {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Style pour les messages d'erreur */
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 4px;
        }

        /* Style pour les boutons Modifier et Supprimer */
        .btn-modifier,
        .btn-supprimer {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
        }

        .btn-modifier {
            background-color: #007bff;
            color: white;
            margin-right: 8px;
        }

        .btn-supprimer {
            background-color: #dc3545;
            color: white;
        }

        #calendar {
            margin-top: 20px;
            display: none; /* Par défaut, le calendrier est caché */
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Art</span>web</div>
        </a>
        <ul class="side-menu">
            <li><a href="../index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="active"><a href="index.php"><i class='bx bx-calendar'></i>Event</a></li>
            <li><a href="../location/index.php"><i class='bx bx-map''></i>Local</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="../../front office/logout.php" class="logout">
                    <i class=' bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">

        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <!-- Déplacer le formulaire de filtre ici -->
            <!-- Déplacer le formulaire de filtre ici -->
            <form action="" method="POST" class="form-input">
                <select name="filtre">
                    <option value="no filter">Aucun filtre</option>
                    <option value="sujet A to Z">Sujet A à Z</option>
                    <option value="sujet Z to A">Sujet Z à A</option>
                    <!-- Ajoutez d'autres options de filtre au besoin -->
                </select>
                <button type="submit" name="applyFilter">Appliquer le filtre</button>
            </form>
            <!-- Fin du Formulaire de filtre -->

            <!-- Déplacer le formulaire de recherche ici -->
            <form action="" method="POST" class="form-input">
                <input type="search" placeholder="Search..." name="recherche">
                <button class="search-btn" type="submit" name="btn-search"><i class='bx bx-search'></i></button>
            </form>
            <!-- Fin du Formulaire de recherche -->

            <!-- Bouton Calendrier -->
            <button id="calendar-btn" onclick="afficherCalendrier()"><i class='bx bx-calendar'></i> Calendrier</button>
            <!-- Fin du Bouton Calendrier -->

            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
        </nav>
        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Événements</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Événements</a></li>
                        /
                        <li><a href="#" class="active">Table</a></li>
                    </ul>
                    <a href="pdfevent.php" class="report">
                                <i class='bx bx-cloud-download'></i>
                                <span>Download PDF</span>
                    </a> 
                </div>
            </div>

            <!-- Bouton pour ajouter un événement -->
            <div class="insights" id="ajouter_evenement" onclick="afficherFormulaire()">
                <div>
                    <i class='bx bx-plus'></i>
                    <span class="info" id="button_ajouter_evenement">
                        <h3>Ajouter</h3>
                        <p>un événement</p>
                    </span>
                </div>
            </div>
            <!-- End Bouton pour ajouter un événement -->

            <!-- Calendrier -->
            <div id='calendar'></div>
            <!-- Fin du calendrier -->

            <!-- Liste des événements -->
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bxs-calendar-check'></i>
                        <h3>Événements</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date de début</th>
                                <th>Sujet</th>
                                <th>Details</th>
                                <th>Date de fin</th>
                                <th>nombre de places</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PHP loop for events -->
                            <?php foreach ($tableau_evenement as $evenement) : ?>
                                <tr>
                                    <td><?php echo $evenement['id_event']; ?></td>
                                    <td><?php echo $evenement['date_debut']; ?></td>
                                    <td><?php echo $evenement['sujet']; ?></td>
                                    <td><?php echo $evenement['detail']; ?></td>
                                    <td><?php echo $evenement['date_fin']; ?></td>
                                    <td><?php echo $evenement['nb_place']; ?></td>
                                    <td>
                                        <a href="update_event.php?id_event=<?php echo $evenement['id_event']; ?>" class="btn-modifier">Modifier</a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="confirmDelete(<?php echo $evenement['id_event']; ?>)" class="btn-supprimer">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End of Liste des événements -->

            <!-- Formulaire pour ajouter un événement -->
            <div class="data" id="formulaire_ajouter_event" style="display:none;">
                <form action="add_event.php" method="POST" onsubmit="return validateForm()">
                    <table>
                        <tr>
                            <td><label for="date_debut">Date de début :</label></td>
                            <td><input type="datetime-local" id="date_debut" name="date_debut"></td>
                            <td><span class="error-message" id="date_debut-error"></span></td>
                        </tr>
                        <tr>
                            <td><label for="sujet">Sujet :</label></td>
                            <td><input type="text" id="sujet" name="sujet"></td>
                            <td><span class="error-message" id="sujet-error"></span></td>
                        </tr>
                        <tr>
                            <td><label for="detail">Détails :</label></td>
                            <td><textarea id="detail" name="detail"></textarea></td>
                            <td><span class="error-message" id="detail-error"></span></td>
                        </tr>
                        <tr>
                            <td><label for="date_fin">Date de fin :</label></td>
                            <td><input type="datetime-local" id="date_fin" name="date_fin"></td>
                            <td><span class="error-message" id="date_fin-error"></span></td>
                        </tr>
                        <tr>
                            <td><label for="local">Lieu :</label></td>
                            <td><input type="text" id="local" name="local"></td>
                            <td><span class="error-message" id="local-error"></span></td>
                        </tr>
                        <tr>
                            <td><label for="nb_place">Nombre de places :</label></td>
                            <td><input type="number" id="nb_place" name="nb_place"></td>
                            <td><span class="error-message" id="nb_place-error"></span></td>
                        </tr>
                        <tr>
                            <td><button type="submit">Ajouter</button></td>
                            <td><button type="reset">Reset</button></td>
                            <td><button onclick="cancel_formulaire_event()">Annuler</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>

    </div>
    <script>
        // Fonction pour obtenir la date actuelle au format YYYY-MM-DD
        function getCurrentDate() {
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Ajouter un zéro initial si nécessaire
            var day = currentDate.getDate().toString().padStart(2, '0'); // Ajouter un zéro initial si nécessaire
            return year + '-' + month + '-' + day;
        }

        // Initialiser la date minimale pour le champ de date de début
        document.getElementById("date_debut").min = getCurrentDate();

        function confirmDelete(id) {
            var result = confirm("Are you sure you want to delete this event?");
            if (result) {
                window.location.href = "delete_event.php?id_event=" + id;
            }
        }

        function afficherFormulaire() {
            var formulaire = document.getElementById("formulaire_ajouter_event");
            formulaire.style.display = "block"; // Affiche le formulaire
        }

        function cancel_formulaire_event() {
            var formulaire = document.getElementById("formulaire_ajouter_event");
            formulaire.style.display = "none"; // Masque le formulaire
        }

        function afficherCalendrier() {
            var calendarEl = document.getElementById('calendar');
            calendarEl.style.display = "block"; // Affiche le calendrier
        }

        function validateForm() {
            var isValid = true;

            // Récupérer les valeurs des champs
            var date_debut = document.getElementById("date_debut").value;
            var sujet = document.getElementById("sujet").value;
            var detail = document.getElementById("detail").value;
            var date_fin = document.getElementById("date_fin").value;
            var local = document.getElementById("local").value;
            var nb_place = document.getElementById("nb_place").value;

            // Validation du champ "Date de début"
            if (date_debut.trim() === "") {
                document.getElementById("date_debut-error").innerText = "Le champ 'Date de début' est obligatoire.";
                isValid = false;
            } else {
                document.getElementById("date_debut-error").innerText = "";
            }

            // Validation du champ "Sujet"
            if (sujet.trim() === "") {
                document.getElementById("sujet-error").innerText = "Le champ 'Sujet' est obligatoire.";
                isValid = false;
            } else {
                document.getElementById("sujet-error").innerText = "";
            }

            // Validation du champ "Détails"
            if (detail.trim() === "") {
                document.getElementById("detail-error").innerText = "Le champ 'Détails' est obligatoire.";
                isValid = false;
            } else {
                document.getElementById("detail-error").innerText = "";
            }

            // Validation du champ "Date de fin"
            if (date_fin.trim() === "") {
                document.getElementById("date_fin-error").innerText = "Le champ 'Date de fin' est obligatoire.";
                isValid = false;
            } else if (date_fin <= date_debut) {
                document.getElementById("date_fin-error").innerText = "La date de fin doit être postérieure à la date de début.";
                isValid = false;
            } else {
                document.getElementById("date_fin-error").innerText = "";
            }

            // Validation du champ "Lieu"
            if (local.trim() === "") {
                document.getElementById("local-error").innerText = "Le champ 'Lieu' est obligatoire.";
                isValid = false;
            } else {
                document.getElementById("local-error").innerText = "";
            }

            // Validation du champ "Nombre de places"
            if (nb_place.trim() === "") {
                document.getElementById("nb_place-error").innerText = "Le champ 'Nombre de places' est obligatoire.";
                isValid = false;
            } else if (parseInt(nb_place) <= 0) {
                document.getElementById("nb_place-error").innerText = "Le nombre de places doit être supérieur à zéro.";
                isValid = false;
            } else {
                document.getElementById("nb_place-error").innerText = "";
            }

            return isValid;
        }
    </script>
</body>

</html>