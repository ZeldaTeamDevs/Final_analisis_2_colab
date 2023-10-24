<?php
require('../fpdf/fpdf.php');

// Configuración para UTF-8
header('Content-Type: text/html; charset=UTF-8');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Historial de Citas', 0, 1, 'C');
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

// Obtener los datos POST
$cod_Mascota = $_POST['cod_Mascota'];
$nombre = $_POST['nombre'];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_petcorp_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener la información de las citas de la mascota
$sql = "SELECT c.ID_Cita, c.Fecha_Hora_Cita, c.ID_Veterinario, c.Estado_Cita, c.Desc_Cita
        FROM citas c
        WHERE c.cod_Mascota = $cod_Mascota";

$result = $conn->query($sql);

// Crear un array con los datos
$historial_citas = [['ID Cita', 'Fecha y Hora', 'ID Veterinario', 'Estado', 'Descripción']];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $historial_citas[] = [
            $row['ID_Cita'],
            $row['Fecha_Hora_Cita'],
            $row['ID_Veterinario'],
            $row['Estado_Cita'],
            $row['Desc_Cita'],
        ];
    }
}

// Crear el PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->ChapterTitle('Historial de Citas para ' . $nombre);
$pdf->ChapterBody($historial_citas);

// Cierra la conexión a la base de datos
$conn->close();

// Enviar el PDF al navegador
$pdf->Output();
?>
