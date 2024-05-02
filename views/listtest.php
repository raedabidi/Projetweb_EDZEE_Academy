<?php
include "../controller/testC.php";

$c = new testC();
$tab = $c->listtest();


if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $tab = $c->searchTest($keyword); 
}
if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'nom_prenom') {
        $tab = $c->sortByField($tab, 'nom_prenom'); 

        $message = "Le tri par nom a été effectué.";
    }elseif ($_GET['sort'] == 'type_reclamation'){
        $tab = $c->sortByField($tab, 'type_reclamation'); 
    }else {
        $message = "Erreur : Tri non valide."; 
    }
} 
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Employés</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
<div class="container">
        
        
<!-- Formulaire de recherche -->
<form action="" method="GET" class="search-form">
    <input type="text" name="search" placeholder="Rechercher par nom ou email">
    <button type="submit" class="Btn_add">Rechercher</button>
</form>

<!-- Formulaire de tri -->
<form action="" method="GET" class="sort-form"id="export-form">
    <div>
    <label for="sort"></label>
    <select name="sort" id="sort">
    <option value="defaut">selectionner un type de tri</option>
        <option value="nom_prenom"> 1. Nom & Prenom</option>
        <option value="type_reclamation"> 2. Type</option>
    </select>
    <button type="submit" class="Btn_add">Trier</button>
    <label for="export"></label>
    <select name="export" id="export">
        <option value="excel">Excel</option>
        <option value="csv">CSV</option>
    </select>
    <button type="submit" class="Btn_add">Exporter</button>
    <a href="ajouter.php" class="Btn_ajouter" >Ajouter</a>
    </div>
   
</form>




        <table id="my-table">
            <tr id="items">
                
                <th>Nom Prenom</th>
                <th>Type </th>
                <th>description</th>
                <th> date reclamation</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach($tab as $test): ?>
           
                        <tr>
                            
                            <td><?=$test['nom_prenom']?></td>
                            <td><?=$test['type_reclamation']?></td>
                            <td><?=$test['descrip']?></td>
                            <td><?=$test['date_reclamation']?></td>
                            
                            <td><a href="updatetest.php?id=<?=$test['id']?>"><img src="modifier.png"></a></td>
                            <td><a href="deletetest.php?id=<?=$test['id']?>"><img src="trash.png"></a></td>
                       
                        </tr>
                        <?php endforeach; ?>     
        </table>
    </div>
    <script>
  // Fonction pour convertir en CSV
  function downloadTableAsExcel(table, filename) {
    const downloadLink = document.createElement('a');
    const dataType = 'data:application/vnd.ms-excel';
    const tableHTML = table.outerHTML.replace(/ /g, '%20');

    downloadLink.href = dataType + ', ' + tableHTML;
    downloadLink.download = filename;

    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
  }

  // Gestionnaire d'événements pour le formulaire d'exportation
  const exportForm = document.getElementById('export-form');
  exportForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const exportSelect = document.getElementById('export');
    const exportValue = exportSelect.value;

    if (exportValue === 'excel') {
      const table = document.getElementById('my-table');
      const filename = 'table.xls';
      downloadTableAsExcel(table, filename);
    }
    // Vous pouvez ajouter des conditions supplémentaires pour gérer d'autres formats d'exportation (par exemple, CSV)
  });
</script>
<script>
  // Fonction pour convertir en CSV
  function downloadTableAsCSV(table, filename) {
    const downloadLink = document.createElement('a');
    const dataType = 'data:text/csv;charset=utf-8';

    const csvContent = Array.from(table.rows)
      .map(row => Array.from(row.cells).map(cell => cell.textContent.trim()).join(','))
      .join('\n');
    const encodedUri = encodeURI(dataType + ',' + csvContent);

    downloadLink.href = encodedUri;
    downloadLink.download = filename;

    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
  }

  // Gestionnaire d'événements pour le formulaire d'exportation
  const exportForm = document.getElementById('export-form');
  exportForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const exportSelect = document.getElementById('export');
    const exportValue = exportSelect.value;

    if (exportValue === 'csv') {
      const table = document.getElementById('my-table');
      const filename = 'table.csv';
      downloadTableAsCSV(table, filename);
    }
    // Vous pouvez ajouter des conditions supplémentaires pour gérer d'autres formats d'exportation
  });
</script>
</body>
</html>