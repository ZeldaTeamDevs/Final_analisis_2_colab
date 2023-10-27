<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtén los datos enviados desde JavaScript
    $descripcionServicios = json_decode($_POST["descripcionServicios"]);
    $montoTotal = $_POST["montoTotal"];
    $cliente = $_POST["cliente"];
    $nit = $_POST["nit"];

    // Generar la fecha de emisión actual
    $fechaEmision = date("Y-m-d"); // Formato: YYYY-MM-DD

    // Conecta a la base de datos (reemplaza con tus credenciales)
    $conn = new mysqli("localhost", "root", "", "bd_petcorp_system");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Inserta los datos en la tabla de facturas
    $sql = "INSERT INTO facturas (Descripcion_Servicios, Monto_Total, Cod_Usuario, nit, Fecha_Emision) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sddsd", $descripcionServiciosTexto, $montoTotal, $cliente, $nit, $fechaEmision);
    
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
