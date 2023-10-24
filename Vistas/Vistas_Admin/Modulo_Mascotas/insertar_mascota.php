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
$nombre = $_POST["nombre"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$especie = $_POST["Especie"];
$raza = $_POST["raza"];
$usuario = $_POST["usuario"];

// Genera un código único basado en la fecha y hora
$codMascota = date("YmdHis");

// Consulta para insertar datos en la tabla tb_mascota
$sql = "INSERT INTO tb_mascota (Nombre, `Fecha de nacimiento`, Cod_especie, Raza, Cod_usuario, cod_Mascota) VALUES ('$nombre', '$fecha_nacimiento', '$especie', '$raza', '$usuario', '$codMascota')";

if ($conn->query($sql) === TRUE) {
    // Éxito al insertar
    header("Location: ../../Vistas_Admin/Modulo_Mascotas/CRUD_mascotas.php"); // Redirige de vuelta a la página principal
} else {
    // Error al insertar
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
