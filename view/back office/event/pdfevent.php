<?php
include "../../../controlleur/pdfcontrolleur.php"; // Inclure le contrôleur PDF pour les événements
include "../../../controlleur/eventC.php"; // Inclure le contrôleur des événements

// Créer une instance du contrôleur des événements
$eventController = new EventC();

// Récupérer la liste des événements depuis le contrôleur
$tableau_evenement = $eventController->listEvents();

// Créer une instance du contrôleur PDF pour les événements
$pdfControllerEvent = new PDFControllerEvent();

// Générer le PDF des événements
$pdfControllerEvent->generateEventPDF($tableau_evenement);
?>