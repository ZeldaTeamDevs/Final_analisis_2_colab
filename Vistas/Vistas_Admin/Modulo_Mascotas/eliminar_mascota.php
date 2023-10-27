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

// Recoge el ID de la mascota a eliminar
$id_mascota = $_GET["id"];

// Consulta para eliminar la mascota
$sql = "DELETE FROM tb_mascota WHERE id_Mascota = $id_mascota";

if ($conn->query($sql) === TRUE) {
    // Éxito al eliminar
    header("Location: ../../Vistas_Admin/Modulo_Mascotas/CRUD_mascotas.php"); // Redirige de vuelta a la página principal
} else {
    // Error al eliminar
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
