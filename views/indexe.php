<?php
include "../controller/testC.php";

$c = new testC();
$tab = $c->listtest();

// Vérifier si une recherche est effectuée
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $tab = $c->searchTest($keyword); // Remplacer 'searchTest' par la méthode appropriée dans votre contrôleur pour effectuer la recherche
}
if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'nom') {
        $tab = $c->sortByField($tab, 'nom'); 
        $message = "Le tri par nom a été effectué.";
    } elseif ($_GET['sort'] == 'prenom') {
        $tab = $c->sortByField($tab, 'prenom'); 
        $message = "Le tri par prénom a été effectué.";
    }elseif ($_GET['sort'] == 'role') {
        $tab = $c->sortByField($tab, 'role'); 
        $message = "Le tri par role a été effectué.";
    } else {
        $message = "Erreur : Tri non valide."; 
    }
} 
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convert | Export html Table to CSV & EXCEL File</title>
    <link rel="stylesheet" type="text/css" href="stylee.css">
</head>

<body>
    <style>
        body {
    min-height: 100vh;
    background: url(images/html_table.jpg) center / cover;
    display: flex;
    justify-content: center;
    align-items: center;
}
    </style>
    <main class="table" >
        <section class="table__header">
            <h1>Affichage</h1>
            
            <div class="input-group">
                <input type="search" placeholder="Search Data...">
                <img src="images/search.png" alt="">
                
            </div>
            <a class="button" href="sign up.php">Ajouter</a>
            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <label for="export-file" id="toPDF">PDF <img src="images/pdf.png" alt=""></label>
                    <label for="export-file" id="toJSON">JSON <img src="images/json.png" alt=""></label>
                    <label for="export-file" id="toCSV">CSV <img src="images/csv.png" alt=""></label>
                    <label for="export-file" id="toEXCEL">EXCEL <img src="images/excel.png" alt=""></label>
                </div>
            </div>
        </section>
        <section class="table__body" id="customers_table">
            <table>
                <thead>
                    <tr>
                        <th>Supprimer</th>
                        <th>Modifier </th>
                        <th>Nom <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Prénom <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Role <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Numéro Téléphone <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Email <span class="icon-arrow">&UpArrow;</span></th> 
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tab as $test): ?>
                <tr>
                <td><a href="deletetest.php?id=<?=$test['id']?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?');"><img src="trash.png"> </a></td>
                    <td><a href="modifier.php?id=<?=$test['id']?>"><img src="pen.png"></a></td>
               
                    <td><?=$test['nom']?></td>
                    <td><?=$test['prenom']?></td>
                    <td><?=$test['role']?></td>
                    <td><?=$test['numero']?></td>
                    <td><?=$test['email']?></td>
                    </tr>
            <?php endforeach; ?>  
                </tbody>
            </table>
        </section>
    </main>
    <script src="source/script.js"></script>

</body>

</html>
