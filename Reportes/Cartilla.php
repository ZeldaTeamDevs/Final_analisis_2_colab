<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Citas y Registros Clínicos', 0, 1, 'C');
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
$citas = [
    ['ID Cita', 'Código Mascota', 'Fecha y Hora', 'ID Veterinario', 'Estado'],
    [1, 'M001', '2023-10-19 09:00:00', 101, 'Programada'],
    [2, 'M002', '2023-10-20 15:30:00', 102, 'Realizada'],
];

$registros_clinicos = [
    ['ID Registro Clínico', 'Código Mascota', 'Fecha Visita', 'Diagnóstico', 'Tratamiento', 'Medicamentos Recetados'],
    [1, 'M001', '2023-10-19', 'Fiebre', 'Analgésicos', 'Paracetamol'],
    [2, 'M002', '2023-10-20', 'Dolor de estómago', 'Reposo', 'Omeprazol'],
];

$pdf->ChapterTitle('Citas');
$pdf->ChapterBody($citas);

$pdf->ChapterTitle('Registros Clínicos');
$pdf->ChapterBody($registros_clinicos);

$pdf->Output();
?>
