<?php
require_once(__DIR__. '/../vendor/autoload.php');

class PDFControllerEvent {
  public function generateEventPDF($events) {
      $pdf = new FPDF('L'); // Spécifie le format paysage
      $pdf->AddPage();

      // Set font
      $pdf->SetFont('Arial', 'B', 16);

      // Header
      $pdf->Cell(0, 10, 'Events List', 0, 1, 'C');
      $pdf->Ln(10); 

      // Header colors
      $pdf->SetFillColor(255, 0, 0); // Red
      $pdf->SetTextColor(255);
      $pdf->SetDrawColor(0);
      $pdf->SetFont('Arial', 'B', 12);
      $pdf->Cell(30, 10, 'ID', 1, 0, 'C', true);
      $pdf->Cell(60, 10, 'Subject', 1, 0, 'C', true);
      $pdf->Cell(40, 10, 'Start Date', 1, 0, 'C', true); 
      $pdf->Cell(40, 10, 'End Date', 1, 0, 'C', true);
      $pdf->Cell(30, 10, 'Available Seats', 1, 0, 'C', true);
      $pdf->Cell(60, 10, 'Details', 1, 1, 'C', true);

      // Reset font and colors
      $pdf->SetFont('Arial', '', 12);
      $pdf->SetFillColor(224, 235, 255); // Light blue
      $pdf->SetTextColor(0);

      // Table data
      $fill = false;
      foreach ($events as $event) {
          $pdf->Cell(30, 10, $event['id_event'], 1, 0, 'C', $fill);
          $pdf->Cell(60, 10, $event['sujet'], 1, 0, 'C', $fill);
          $pdf->Cell(40, 10, $event['date_debut'], 1, 0, 'C', $fill);
          $pdf->Cell(40, 10, $event['date_fin'], 1, 0, 'C', $fill);
          $pdf->Cell(30, 10, $event['nb_place'], 1, 0, 'C', $fill);
          $pdf->MultiCell(60, 10, $event['detail'], 1, 'C', $fill);
          $fill = !$fill;
      }

      // Save the file or force download
      $pdf->Output('events_list.pdf', 'D');
  }
}
?>