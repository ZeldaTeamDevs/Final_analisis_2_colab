<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_petcorp_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoge los valores del formulario
$codMascota = $_POST["codMascota"];
$fechaAplicacion = $_POST["fechaAplicacion"];
$comentarios = $_POST["comentarios"];
$vacunaAplicada = $_POST["vacunaAplicada"];

// Genera una fecha y hora de última actualización
$ultimaActualizacion = date("Y-m-d H:i:s");

// Consulta para insertar datos en la tabla cartilladevacunacion
$sql = "INSERT INTO cartilladevacunacion (cod_Mascota, FechaCreacion, UltimaActualizacion, Comentarios, Vacuna_Aplicada) VALUES ('$codMascota', '$fechaAplicacion', '$ultimaActualizacion', '$comentarios', '$vacunaAplicada')";

if ($conn->query($sql) === TRUE) {
    // Éxito al insertar
    header("Location:  ../../Vistas_Admin/Modulo_Mascotas/CRUD_vacunas.php"); // Redirige a la página deseada
} else {
    // Error al insertar
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
