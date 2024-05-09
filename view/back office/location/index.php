<?php
// Inclure le contrôleur ou le modèle pour gérer les emplacements
include "../../../controlleur/locationC.php";

// Créer une instance du contrôleur des emplacements
$locationController = new LocationC();

// Récupérer la liste des emplacements depuis le contrôleur
$tableau_emplacement = $locationController->listLocations();
if (isset($_POST["btn-search"])) {
    $search_value = $_POST["recherche"];
    $tableau_emplacement = $locationController->searchLocation($search_value);
}
$selectedFilter = "no filter";
if (isset($_POST['applyFilter'])) {
    $selectedFilter = isset($_POST['filtre']) ? $_POST['filtre'] : 'no filter';
    if ($selectedFilter === 'nom A to Z') {
        $tableau_emplacement = $locationController->filterLocationNomAZ();
    } else if ($selectedFilter === 'nom Z to A') {
        $tableau_emplacement = $locationController->filterLocationNomZA();
    } else if ($selectedFilter == "no filter") {
        $tableau_emplacement = $locationController->listLocations();
    }
}
// Vérifier si $tableau_emplacement est défini et n'est pas vide avant de l'afficher dans le HTML
if (!empty($tableau_emplacement)) {
} else {
    echo "Aucun emplacement trouvé.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Template</title>
    <style>
        /* Vos styles CSS existants */
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

        /* Style pour le bouton "Ajouter emplacement" */
        #ajouter_emplacement {
            cursor: pointer;
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
        }

        /* Style pour le formulaire d'ajout d'emplacement */
        #formulaire_ajouter_location {
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

        /* Style pour les boutons "Modifier" et "Supprimer" */
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
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>EDZEE</span>website</div>
        </a>
        <ul class="side-menu">
            <li><a href="../index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="../event/index.php"><i class='bx bx-calendar'></i>Event</a></li>
            <li class="active"><a href="index.php"><i class='bx bx-map'></i>Local</a></li>
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
            <form action="" method="POST">
                <div class="form-input">
                    <input type="search" placeholder="Search..." name="recherche">
                    <button class="search-btn" type="submit" name="btn-search"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

        </nav>
        <!-- End of Navbar -->

        <!-- Main Content Area -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Emplacements</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Emplacements</a></li>
                        /
                        <li><a href="#" class="active">Table</a></li>
                    </ul>   
                    <a href="pdflocation.php" class="report">
                                <i class='bx bx-cloud-download'></i>
                                <span>Download PDF</span>
                    </a> 
                </div>
            </div>
            <!-- Ajouter un emplacement -->
            <div class="insights" id="ajouter_emplacement" onclick="afficherFormulaire()">
                <div>
                    <i class='bx bx-plus'></i>
                    <span class="info" id="button_ajouter_emplacement">
                        <h3>Ajouter</h3>
                        <p>un emplacement</p>
                    </span>
                </div>
            </div>
            <!-- End Ajouter un emplacement -->

            <!-- Liste des emplacements -->
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bxs-map'></i>
                        <h3>Emplacements</h3>
                        <div class="container">
                            <div class="row justify-content-center mt-5">
                                <div class="col-md-6">
                                    <form action="" method="POST" class="d-flex align-items-center">
                                        <select class="form-select" name="filtre">
                                            <option selected disabled>Choisir un filtre</option>
                                            <option value="no filter">Aucun filtre</option>
                                            <option value="nom A to Z">Nom de A à Z</option>
                                            <option value="nom Z to A">Nom de Z à A</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary ms-2" name="applyFilter">Appliquer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Emplacement</th>
                                <th>Capacité</th>
                                <th>Catégorie</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PHP loop for locations -->
                            <?php foreach ($tableau_emplacement as $emplacement) : ?>
                                <tr>
                                    <td><?php echo $emplacement['id_location']; ?></td>
                                    <td><?php echo $emplacement['emplacement']; ?></td>
                                    <td><?php echo $emplacement['capacite']; ?></td>
                                    <td><?php echo $emplacement['categorie']; ?></td>
                                    <td>
                                        <a href="update_location.php?id_location=<?php echo $emplacement['id_location']; ?>" class="btn-modifier">Modifier</a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="confirmDelete(<?php echo $emplacement['id_location']; ?>)" class="btn-supprimer">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End of Liste des emplacements -->

            <!-- Formulaire pour ajouter un emplacement -->
            <div class="data" id="formulaire_ajouter_location">
                <form action="add_location.php" method="POST" onsubmit="return validateForm()">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="emplacement">Emplacement :</label>
                            <input type="text" id="emplacement" name="emplacement" class="form-control">
                            <span class="error-message" id="emplacement-error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="capacite">Capacité :</label>
                            <input type="number" id="capacite" name="capacite" class="form-control">
                            <span class="error-message" id="capacite-error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="categorie">Catégorie :</label>
                            <select id="categorie" name="categorie" class="form-control">
                                <option value="musée">Musée</option>
                                <option value="parc">Parc</option>
                                <option value="restaurant">Restaurant</option>
                                <option value="maison_hote">Maison d'hôte</option>
                                <option value="hotel">Hôtel</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="button" class="btn btn-danger" onclick="annulerFormulaire()">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End Formulaire pour ajouter un emplacement -->

        </main>
        <!-- End of Main Content Area -->
    </div>
    <!-- End of Main Content -->

    <!-- Script Section -->
    <script src="../index.js"></script>
    <script>
        function confirmDelete(id) {
            var result = confirm("Are you sure you want to delete this location?");
            if (result) {
                window.location.href = "delete_location.php?id_location=" + id;
            }
        }

        function afficherFormulaire() {
            var formulaire = document.getElementById("formulaire_ajouter_location");
            formulaire.style.display = "block"; // Affiche le formulaire
        }

        function annulerFormulaire() {
            var formulaire = document.getElementById("formulaire_ajouter_location");
            formulaire.style.display = "none"; // Masque le formulaire
        }

        function validateForm() {
            var isValid = true;

            // Récupérer les valeurs des champs
            var emplacement = document.getElementById("emplacement").value.trim();
            var capacite = document.getElementById("capacite").value.trim();

            // Validation du champ "Emplacement"
            if (emplacement === "") {
                document.getElementById("emplacement-error").innerText = "Le champ 'Emplacement' est obligatoire.";
                isValid = false;
            } else {
                document.getElementById("emplacement-error").innerText = "";
            }

            // Validation du champ "Capacité"
            if (capacite === "") {
                document.getElementById("capacite-error").innerText = "Le champ 'Capacité' est obligatoire.";
                isValid = false;
            } else if (capacite <= 0) {
                document.getElementById("capacite-error").innerText = "Le champ 'Capacité' doit être strictement supérieur à zéro.";
                isValid = false;
            } else {
                document.getElementById("capacite-error").innerText = "";
            }

            return isValid;
        }
    </script>
    <!-- End of Script Section -->
</body>

</html>