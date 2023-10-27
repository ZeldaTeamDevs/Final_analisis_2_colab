<?php
require('../fpdf/fpdf.php');

// Recuperar el cod_Mascota de la solicitud POST
$cod_Mascota = $_POST['cod_Mascota'];

// Crea una conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_petcorp_system";

$conexion = mysqli_connect($servername, $username, $password, $dbname);

if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

class PDF extends FPDF {
    function Header() {
        // Encabezado del PDF
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Historia de Vida de la Mascota', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Consulta para obtener los datos de la mascota con el nombre de la especie
$query_mascota = "SELECT m.Nombre, m.`Fecha de nacimiento`, e.Especie, m.Raza
FROM tb_mascota m
INNER JOIN tb_especie e ON m.Cod_especie = e.id_especie
WHERE m.cod_Mascota = $cod_Mascota";
$result_mascota = mysqli_query($conexion, $query_mascota);
$mascota = mysqli_fetch_assoc($result_mascota);

// Consulta para obtener las citas con el nombre del veterinario
$query_citas = "SELECT c.Fecha_Hora_Cita, v.Nombre_Veterinario, c.Estado_Cita, c.Desc_Cita
FROM citas c
INNER JOIN veterinarios v ON c.ID_Veterinario = v.ID_Veterinario
WHERE c.cod_Mascota = $cod_Mascota";
$result_citas = mysqli_query($conexion, $query_citas);

// Agregar los datos de la mascota al PDF
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Datos de la Mascota', 0, 1);
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Nombre: ' . $mascota['Nombre'], 0, 1);
$pdf->Cell(0, 10, 'Fecha de Nacimiento: ' . $mascota['Fecha de nacimiento'], 0, 1);
$pdf->Cell(0, 10, 'Especie: ' . $mascota['Especie'], 0, 1);
$pdf->Cell(0, 10, 'Raza: ' . $mascota['Raza'], 0, 1);
$pdf->Ln(10);

// Agregar la tabla con las citas
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Citas de la Mascota', 0, 1);
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 8, 'Fecha y Hora', 1);
$pdf->Cell(40, 8, 'Veterinario', 1);
$pdf->Cell(35, 8, 'Estado', 1);
$pdf->Cell(60, 8, 'Descripcion', 1);
$pdf->Ln();

// Agregar los datos de las citas a la tabla
while ($cita = mysqli_fetch_assoc($result_citas)) {
    $pdf->Cell(50, 8, $cita['Fecha_Hora_Cita'], 1);
    $pdf->Cell(40, 8, $cita['Nombre_Veterinario'], 1); // Mostrar el nombre del veterinario
    $pdf->Cell(35, 8, $cita['Estado_Cita'], 1);
    $pdf->Cell(60, 8, $cita['Desc_Cita'], 1);
    $pdf->Ln();
}

$pdf->Output();

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
