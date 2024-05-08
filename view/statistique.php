<?php
require '../controller/forumC.php';

$forumC = new ForumC();

$matieres = ["General", "Tests", "Mathematique", "Français", "Anglais", "Science", "Economie", "Infographie", "Informatique"];
$counts = array_fill(0, count($matieres), 0);

$statistics = $forumC->getMatiereStatistics();

foreach ($statistics as $stat) {
    $matiere = $stat['matiere_forum'];
    $index = array_search($matiere, $matieres);
    if ($index !== false) {
        $counts[$index] = $stat['count'];
    }
}

// Créer un tableau de données pour le graphique
$dataPoints = [];
foreach ($matieres as $key => $matiere) {
    $dataPoints[] = ["y" => $counts[$key], "label" => $matiere];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Matières</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
    <!-- Ajout de l'élément chartContainer -->
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>

    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Statistiques des Matières"
                },
                axisY: {
                    title: "Nombre de Forums"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0 Forums",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>