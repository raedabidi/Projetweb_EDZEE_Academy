<?php
require_once(__DIR__. '/../vendor/autoload.php');

class PDFControllerLocation {
    public function generateLocationPDF($locations) {
        $pdf = new FPDF('P'); // Format portrait par défaut
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('Arial', 'B', 16);

        // Header
        $pdf->Cell(0, 10, 'Locations List', 0, 1, 'C');
        $pdf->Ln(10); 

        // Header colors
        $pdf->SetFillColor(0, 0, 255); // Bleu
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(30, 10, 'ID', 1, 0, 'C', true);
        $pdf->Cell(60, 10, 'Location', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Capacity', 1, 0, 'C', true); 
        $pdf->Cell(60, 10, 'Category', 1, 1, 'C', true);

        // Reset font and colors
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetFillColor(224, 235, 255); // Bleu clair
        $pdf->SetTextColor(0);

        // Table data
        $fill = false;
        foreach ($locations as $location) {
            $pdf->Cell(30, 10, $location['id_location'], 1, 0, 'C', $fill);
            $pdf->Cell(60, 10, $location['emplacement'], 1, 0, 'C', $fill);
            $pdf->Cell(40, 10, $location['capacite'], 1, 0, 'C', $fill);
            $pdf->Cell(60, 10, $location['categorie'], 1, 1, 'C', $fill);
            $fill = !$fill;
        }

        // Save the file or force download
        $pdf->Output('locations_list.pdf', 'D');
    }
}
?>