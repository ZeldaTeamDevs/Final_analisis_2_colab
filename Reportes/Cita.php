<?php
require('../fpdf/fpdf.php');
class PDF extends FPDF
{
    function Header()
    {
        // Título
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Informe de Cita', 0, 1, 'C');

        // Línea decorativa
        $this->SetLineWidth(1);
        $this->Line(10, 25, 200, 25);
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear una instancia de PDF
$pdf = new PDF();
$pdf->AddPage();

// Contenido del informe
$pdf->SetFont('Arial', '', 12);

if (isset($_POST["NombreMascota"]) && isset($_POST["Fecha_Hora_Cita"]) && isset($_POST["Nombre_Veterinario"]) && isset($_POST["Desc_Cita"])) {
    // Recuperar los datos del formulario y convertir a UTF-8
    $NombreMascota = utf8_decode($_POST["NombreMascota"]);
    $Fecha_Hora_Cita = utf8_decode($_POST["Fecha_Hora_Cita"]);
    $Nombre_Veterinario = utf8_decode($_POST["Nombre_Veterinario"]);
    $Desc_Cita = utf8_decode($_POST["Desc_Cita"]);

    // Datos de la cita
    $pdf->Cell(0, 10, 'Mascota: ' . $NombreMascota, 0, 1);
    $pdf->Cell(0, 10, 'Fecha y Hora de la Cita: ' . $Fecha_Hora_Cita, 0, 1);
    $pdf->Cell(0, 10, 'Veterinario: ' . $Nombre_Veterinario, 0, 1);

    // Descripción de la cita
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Descripcion de la Cita:', 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, $Desc_Cita);

    $pdf->Ln(10);
} else {
    // Manejar el caso en el que los datos no están disponibles
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Error', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'No se han proporcionado los datos necesarios para generar el informe.', 0, 1);
}

// Generar el PDF
$pdf->Output();
