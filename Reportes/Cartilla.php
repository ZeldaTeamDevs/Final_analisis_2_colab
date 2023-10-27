<?php
require('../fpdf/fpdf.php');

// Configuración para UTF-8
header('Content-Type: text/html; charset=UTF-8');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Cartilla de Vacunacion', 0, 1, 'C');
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
            $decodedRow = array_map('utf8_decode', $row);
            foreach ($decodedRow as $column) {
                $this->MultiCell(0, 10, $column, 'LTRB');
            }
            $this->Ln();
        }

        $this->Ln(10);
    }
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_petcorp_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el id_Mascota de la URL
$idMascota = $_GET['id'];
//hasjkdhfkjashdfjkhw

// Consulta para obtener la información de la cartilla de vacunación de la mascota
$sql = "SELECT c.Vacuna_Aplicada, c.FechaAplicacion, c.ProximaCita
        FROM cartilladevacunacion c
        WHERE c.cod_Mascota = $idMascota";

$result = $conn->query($sql);

// Crear un array con los datos
$cartilla_vacunacion = [['Vacuna', 'Fecha de Aplicacion', 'Proxima Cita']];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $cartilla_vacunacion[] = [$row['Vacuna_Aplicada'], $row['FechaAplicacion'], $row['ProximaCita']];
    }
}

// Crear el PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->ChapterTitle('Cartilla de Vacunacion');
$pdf->ChapterBody($cartilla_vacunacion);

// Cierra la conexión a la base de datos
$conn->close();

// Enviar el PDF al navegador
$pdf->Output();
