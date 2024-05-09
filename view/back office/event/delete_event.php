<?php
include('../../../controlleur/eventC.php');

$eventC = new EventC();
$eventC->deleteEvent($_GET["id_event"]);
header('Location: index.php');
?>