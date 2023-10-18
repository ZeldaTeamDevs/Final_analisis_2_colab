<?php
require('../fpdf/fpdf.php');


class PDF extends FPDF
{
    // Cabecera del PDF
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Título
        $this->Cell(0, 10, 'Tarjeta de Vida de la Mascota', 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    // Contenido del PDF
    function Content($mascota, $usuario)
    {
        $this->SetFont('Arial', '', 12);

        // Datos de la mascota
        $this->Cell(0, 10, 'Información de la Mascota', 0, 1);
        $this->Ln(5);

        $this->Cell(0, 10, 'Nombre de la Mascota: ' . $mascota['Nombre'], 0, 1);
        $this->Cell(0, 10, 'Fecha de Nacimiento: ' . $mascota['Fecha de nacimiento'], 0, 1);
        $this->Cell(0, 10, 'Código de Mascota: ' . $mascota['cod_Mascota'], 0, 1);
        $this->Cell(0, 10, 'Especie: ' . $mascota['Cod_especie'], 0, 1);
        $this->Cell(0, 10, 'Raza: ' . $mascota['Raza'], 0, 1);

        $this->Ln(10);

        // Datos del usuario
        $this->Cell(0, 10, 'Información del Usuario', 0, 1);
        $this->Ln(5);

        $this->Cell(0, 10, 'Nombre del Usuario: ' . $usuario['Nombre'], 0, 1);
        $this->Cell(0, 10, 'Correo Electrónico: ' . $usuario['Correo'], 0, 1);
    }
}

// Datos de ejemplo
$mascota = [
    'Nombre' => 'Rocky',
    'Fecha de nacimiento' => '2020-05-10',
    'cod_Mascota' => '123456',
    'Cod_especie' => 'Perro',
    'Raza' => 'Labrador'
];

$usuario = [
    'Nombre' => 'Juan Pérez',
    'Correo' => 'juan@example.com'
];

// Crear un objeto PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->Content($mascota, $usuario);
$pdf->Output();
