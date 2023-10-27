
<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(60, 10, 'PETCORP', 0, 0, 'L');
        $this->Cell(60, 10, 'FACTURA', 0, 0, 'C');
        $this->Cell(60, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
        
        $this->Cell(60, 10, '', 0, 1, 'L'); // Espacio en blanco
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Información del cliente
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Cliente: ZeldaTeam', 0, 1);
$pdf->Cell(0, 10, 'Direccion: La direccion de ZeldaTeam', 0, 1);
$pdf->Cell(0, 10, 'Fecha de Factura: ' . date('d/m/Y'), 0, 1);

$pdf->Ln(10); // Espacio en blanco

// Detalles de la factura
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 10, 'Descripcion', 1, 0, 'C');
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
$pdf->Cell(30, 10, 'Precio Unitario', 1, 0, 'C');
$pdf->Cell(30, 10, 'Subtotal', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 10, 'Juguete para perros', 1, 0);
$pdf->Cell(30, 10, '1', 1, 0, 'C');
$pdf->Cell(30, 10, 'Q4.99', 1, 0, 'C');
$pdf->Cell(30, 10, 'Q4.99', 1, 1, 'C');

$pdf->Cell(50, 10, 'Comedero para aves', 1, 0);
$pdf->Cell(30, 10, '1', 1, 0, 'C');
$pdf->Cell(30, 10, 'Q3.99', 1, 0, 'C');
$pdf->Cell(30, 10, 'Q3.99', 1, 1, 'C');

// Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(110, 10, 'Total', 1, 0, 'C');
$pdf->Cell(30, 10, 'Q8.98', 1, 1, 'C');

$pdf->Output();
?>
