<?php
include('../../../controlleur/locationC.php');

$locationC = new LocationC();
$locationC->deleteLocation($_GET["id_location"]);
header('Location: index.php');
?>