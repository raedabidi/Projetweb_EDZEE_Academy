<?php
// Inclure le fichier de configuration et la classe testC
require_once "../config.php";
require_once "../controller/testC.php";

// Créer une instance de la classe testC
$c = new testC();

// Générer le PDF
$pdf_filename = $c->generatePDF();

// Rediriger l'utilisateur vers le PDF généré
header("Location: $pdf_filename");
exit;
?>
