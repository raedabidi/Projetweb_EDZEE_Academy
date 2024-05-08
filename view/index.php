<?php
include "../Controller/FormationC.php";


$c = new FormationC();
$tab = $c->ListeFormations();

// Récupérer le terme de recherche saisi par l'Formation
$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : '';

// Récupérer le type de tri choisi par l'Formation
$tri = isset($_GET['tri']) ? $_GET['tri'] : '';

// Si un terme de recherche est spécifié, filtrer les résultats
if (!empty($recherche)) {
    // Filtrer les formations pour ne garder que celles qui correspondent à la recherche
    $tab = array_filter($tab, function($formation) use ($recherche) {
        // Comparez le terme de recherche avec le titre de la formation
        return strpos(strtolower($formation['Titre']), strtolower($recherche)) !== false;
    });
    
}

// Vérifier si aucun résultat n'a été trouvé
if (empty($tab) && !empty($recherche)) {
    echo "<p>Aucun titre ne correspond à votre recherche.</p>";
}

if ($tri == 'prix_croissant') {
    // Trier par prix croissant
    usort($tab, function($a, $b) {
        return $a['Prix'] - $b['Prix'];
    });
} elseif ($tri == 'prix_decroissant') {
    // Trier par prix décroissant
    usort($tab, function($a, $b) {
        return $b['Prix'] - $a['Prix'];
    });
} elseif ($tri == 'date_croissante') {
    // Trier par date croissante
    usort($tab, function($a, $b) {
        return strtotime($a['Date']) - strtotime($b['Date']);
    });
} elseif ($tri == 'date_decroissante') {
    // Trier par date décroissante
    usort($tab, function($a, $b) {
        return strtotime($b['Date']) - strtotime($a['Date']);
    });
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styleD.css">
    <style>
      
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Template</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            
            <div class="logo-name" style="margin-left: 18px;"><span>EDZEE</span>ACADEMY</div>
        </a>
        <ul class="side-menu">    
            <li class="active"><a href="#"><i class='bx bx-calendar'></i>Dashboard</a></li>
            <li class="active"><a href="index.php"><i class='bx bxs-dashboard'></i>Formation</a></li>
            <li class="active"><a href="afficherRessource.php"><i class='bx bxs-dashboard'></i>Ressource</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="../Front/login/Login.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    
    <div class="content">
        
        <nav>
        <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input"></div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="logo">
                <i class='bx bx-code-alt'></i>
            </a>
        </nav>

        

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Statistique
                            </a>
                        </li>

                        <li><a href="#" class="active"></a></li>
                    </ul>
                </div>
            </div>


            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Formation</h3>
                        <i class='bx bx-filter'></i>
                        <i ><a href="Formation/ajouter.php"><img src="Formation/source/plus.jpg"></a> </i>
                        <i class='bx bx-menu'></i>
                        
</label>
                    </div>
                     <!-- Formulaire de recherche -->
                     <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <label for="recherche">Recherche :</label>
                                            <input type="text" name="recherche" id="recherche" value="<?php echo htmlentities($recherche); ?>">
                                            <input type="submit" value="Rechercher">
                                        </form>
                    <table>
                        <thead>
                            <tr>
                                                <th>Titre</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Ressource</th>
                                                <th>Prix</th>
                                                <th>Date</th>
                                                <th>Lieu</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tab as $formation) { ?>
                            <tr>
                                                   
                                                   <td><?= $formation['Titre']; ?></td>
                                                
                                                   <td><a href="#" class="voir-plus" data-description="<?= $formation['Description']; ?>">Consulter</a></td>
                   
                                                
                                                  
                                                   <td><?= $formation['Status']; ?></td>
                                                   <td><?= $formation['Ressource']; ?></td>
                                                   <td><?= $formation['Prix']; ?></td>
                                                   <td><?= $formation['Date']; ?></td>
                                                   <td><?= $formation['Lieu']; ?></td>
                                                   <td align="center">
                                                       <form method="POST" action="modifier.php">
                                                           <input type="submit" name="update" value="Update">
                                                           <input type="hidden" value="<?= $formation['IDF']; ?>" name="IDF">
                                                       </form>
                                                   </td>
                                                   <td>
                                                       <a href="supprimer.php?id=<?= $formation['IDF']; ?>">Delete</a>
                                                   </td>
                                               </tr>
                    <?php } ?>
                </tbody>
                    </table>
                </div>
            </div>
            <div>


            </div>
        </main>

    </div>

    <script src="index.js"></script>
</body>

</html>