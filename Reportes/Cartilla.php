<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Cartilla de Vacunación', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    function ChapterTitle($title)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $title, 0, 1);
        $this->Ln(5);
    }

    function ChapterBody($data)
    {
        $this->SetFont('Arial', '', 10);

        foreach ($data as $row) {
            foreach ($row as $column) {
                $this->MultiCell(0, 10, $column, 'LTRB');
            }
            $this->Ln();
        }

        $this->Ln(10);
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Datos de ejemplo
$cartilla_vacunacion = [
    ['Vacuna', 'Fecha de Aplicación', 'Próxima Cita'],
    ['Vacuna 1', '2023-01-15', '2023-02-15'],
    ['Vacuna 2', '2023-03-20', '2023-04-20'],
    ['Vacuna 3', '2023-06-10', '2023-07-10'],
    ['Vacuna 4', '2023-09-05', '2023-10-05'],
];

$pdf->ChapterTitle('Cartilla de Vacunación');
$pdf->ChapterBody($cartilla_vacunacion);

$pdf->Output();
?>
