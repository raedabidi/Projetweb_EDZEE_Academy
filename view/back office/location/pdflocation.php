<?php
include "../../../controlleur/locationC.php"; // Inclure le contrôleur PDF pour les emplacements
include "../../../controlleur/pdfcontrolleurlocation.php"; // Inclure le contrôleur des emplacements

// Créer une instance du contrôleur des emplacements
$locationController = new LocationC();

// Récupérer la liste des emplacements depuis le contrôleur
$tableau_emplacement = $locationController->listLocations();

// Créer une instance du contrôleur PDF pour les emplacements
$pdfControllerLocation = new PDFControllerLocation();

// Générer le PDF des emplacements
$pdfControllerLocation->generateLocationPDF($tableau_emplacement);
?>