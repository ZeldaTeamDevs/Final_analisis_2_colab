<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtén los datos enviados desde JavaScript
    $descripcionServicios = json_decode($_POST["descripcionServicios"]);
    $montoTotal = $_POST["montoTotal"];

    // Conecta a la base de datos (reemplaza con tus credenciales)
    $conn = new mysqli("localhost", "root", "", "bd_petcorp_system");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO facturas (descripcion_servicios, monto_total) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sd", $descripcionServiciosTexto, $montoTotal);
    
    $descripcionServiciosTexto = implode(", ", $descripcionServicios);
    
    if ($stmt->execute()) {
        echo "La compra se ha registrado con éxito.";
    } else {
        echo "Error al registrar la compra: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Solicitud no válida.";
}
?>
