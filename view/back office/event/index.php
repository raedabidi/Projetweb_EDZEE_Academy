<?php
// Inclure le contrôleur ou le modèle pour gérer les événements
include "../../../controlleur/eventC.php";

// Créer une instance du contrôleur des événements
$eventController = new EventC();

// Récupérer la liste des événements depuis le contrôleur
$tableau_evenement = $eventController->listEvents();

// Vérifier si $tableau_evenement est défini et n'est pas vide avant de l'afficher dans le HTML
if (!empty($tableau_evenement)) {

} else {
    echo "Aucun événement trouvé.";
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
            <li class="active"><a href="index.php"><i class='bx bx-calendar'></i>Event</a></li>
            <li><a href="../location/index.php"><i class='bx bx-map''></i>Local</a></li>
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
                    <h1>Événements</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                            Événements
                            </a></li>
                        /
                        <li><a href="#" class="active">Table</a></li>
                    </ul>
                    
                </div>
            </div>

            <!-- Bouton pour ajouter un événement -->
            
            
            <!-- Liste des événements -->
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bxs-calendar-check' ></i>
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
                            <?php foreach ($tableau_evenement as $evenement): ?>
                                <tr>
                                    <td><?php echo $evenement['id_event']; ?></td>
                                    <td><?php echo $evenement['date_debut']; ?></td>
                                    <td><?php echo $evenement['sujet']; ?></td>
                                    <td><?php echo $evenement['detail']; ?></td>
                                    <td><?php echo $evenement['date_fin']; ?></td>
                                    <td><?php echo $evenement['nb_place']; ?></td>
                                    <td>
                                        <a href="update_event.php?id_event=<?php echo $evenement['id_event']; ?>">Modifier</a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="confirmDelete(<?php echo $evenement['id_event']; ?>)">Supprimer</a>
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
                <form action="add_event.php" method="POST">
                    <table>
                        <tr>
                            <td><label for="date_debut">Date de début :</label></td>
                            <td><input type="date" id="date_debut" name="date_debut" required></td>
                        </tr>
                        <tr>
                            <td><label for="sujet">Sujet :</label></td>
                            <td><input type="text" id="sujet" name="sujet" required></td>
                        </tr>
                        <tr>
                            <td><label for="date_fin">Date de fin :</label></td>
                            <td><input type="date" id="date_fin" name="date_fin" required></td>
                        </tr>
                        <tr>
                            <td><label for="local">Lieu :</label></td>
                            <td><input type="text" id="local" name="local" required></td>
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
    <script src="../index.js"></script>
    <script>
    function confirmDelete(id) {
        var result = confirm("Are you sure you want to delete this event?");
        if (result) {
            window.location.href = "delete_event.php?id_event=" + id;
        }
    }
</script>

</body>
</html>
