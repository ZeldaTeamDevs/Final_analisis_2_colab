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
$id_mascota = $_POST["id_mascota"];
$nombre = $_POST["edit_nombre"];
$fecha_nacimiento = $_POST["edit_fecha_nacimiento"];
$especie = $_POST["edit_especie"];
$raza = $_POST["edit_raza"];
$usuario = $_POST["edit_usuario"];

// Consulta para actualizar los datos de la mascota
$sql = "UPDATE tb_mascota SET Nombre = '$nombre', `Fecha de nacimiento` = '$fecha_nacimiento', Cod_especie = '$especie', Raza = '$raza', Cod_usuario = '$usuario' WHERE id_Mascota = $id_mascota";

if ($conn->query($sql) === TRUE) {
    // Éxito al actualizar
    header("Location: ../../Vistas_Admin/Modulo_Mascotas/CRUD_mascotas.php"); // Redirige de vuelta a la página principal
} else {
    // Error al actualizar
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
