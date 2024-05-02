<?php
// Inclure le contrôleur ou le modèle pour gérer les emplacements
include "../../../controlleur/locationC.php";

// Créer une instance du contrôleur des emplacements
$locationController = new LocationC();

// Récupérer la liste des emplacements depuis le contrôleur
$tableau_emplacement = $locationController->listLocations();

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
    <link rel="stylesheet" href="../style.css">
    <title>Template</title>
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
            <li><a href="../event/index.php"><i class='bx bx-calendar'></i>Event</a></li>
            <li class="active"><a href="index.php"><i class='bx bx-map''></i>Local</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="../../front office/logout.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
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
                    <button class="search-btn"  type="submit" name="btn-search"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Emplacements</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                            Emplacements
                            </a></li>
                        /
                        <li><a href="#" class="active">Table</a></li>
                    </ul>
                    
                </div>
            </div>

            <!-- Liste des emplacements -->
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bxs-map' ></i>
                        <h3>Emplacements</h3>
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
                            <?php foreach ($tableau_emplacement as $emplacement): ?>
                                <tr>
                                    <td><?php echo $emplacement['id_location']; ?></td>
                                    <td><?php echo $emplacement['emplacement']; ?></td>
                                    <td><?php echo $emplacement['capacite']; ?></td>
                                    <td><?php echo $emplacement['categorie']; ?></td>
                                    <td>
                                        <a href="update_location.php?id_location=<?php echo $emplacement['id_location']; ?>">Modifier</a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="confirmDelete(<?php echo $emplacement['id_location']; ?>)">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End of Liste des emplacements -->

            <!-- Formulaire pour ajouter un emplacement -->
            <div class="data" id="formulaire_ajouter_location" style="display:none;">
                <form action="add_location.php" method="POST">
                    <table>
                        <tr>
                            <td><label for="emplacement">Emplacement :</label></td>
                            <td><input type="text" id="emplacement" name="emplacement" required></td>
                        </tr>
                        <tr>
                            <td><label for="capacite">Capacité :</label></td>
                            <td><input type="number" id="capacite" name="capacite" required></td>
                        </tr>
                        <tr>
                            <td><label for="categorie">Catégorie :</label></td>
                            <td>
                                <select id="categorie" name="categorie">
                                    <option value="musée">Musée</option>
                                    <option value="parc">Parc</option>
                                    <option value="restaurant">Restaurant</option>
                                    <option value="maison_hote">Maison d'hôte</option>
                                    <option value="hotel">Hôtel</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><button type="submit">Ajouter</button></td>
                            <td><button type="reset">Reset</button></td>
                            <td><button onclick="cancel_formulaire_location()">Annuler</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>

    </div>
    <script src="../index.js"></script>
    <script>
    function confirmDelete(id) {
        var result = confirm("Are you sure you want to delete this location?");
        if (result) {
            window.location.href = "delete_location.php?id_location=" + id;
        }
    }
</script>

</body>
</html>
