<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_Mascota = $_POST["cod_Mascota"];
    $Fecha_Hora_Cita = $_POST["Fecha_Hora_Cita"];
    $ID_Veterinario = $_POST["ID_Veterinario"];
    $Desc_Cita = $_POST["Desc_Cita"]; // Nueva variable
    $Estado_Cita = "Activo"; // Estado por defecto

    // Validación de disponibilidad de cita
    $db = new mysqli("localhost", "root", "", "bd_petcorp_system");

    // Verificar si ya hay una cita para la misma hora y el mismo veterinario
    $query = "SELECT COUNT(*) as count FROM citas WHERE Fecha_Hora_Cita = ? AND ID_Veterinario = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $Fecha_Hora_Cita, $ID_Veterinario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row['count'] > 0) {
        // Mensaje de conflicto con alerta JavaScript
        echo "<script>
            alert('Ya hay una cita asignada para esa hora con el mismo veterinario.');
            window.location.href = '../Vistas/Programar_Cita.php';
        </script>";
    } else {
        // Insertar la cita si no hay conflicto
        $query = "INSERT INTO citas (cod_Mascota, Fecha_Hora_Cita, ID_Veterinario, Desc_Cita, Estado_Cita) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("sssss", $cod_Mascota, $Fecha_Hora_Cita, $ID_Veterinario, $Desc_Cita, $Estado_Cita);

        if ($stmt->execute()) {
            // Mensaje de éxito con alerta JavaScript
            echo "<script>
                alert('Cita insertada correctamente');
                window.location.href = '../Vistas/Programar_Cita.php';
            </script>";
            exit();
        } else {
            // Mensaje de error con alerta JavaScript en caso de fallo en la inserción
            echo "<script>
                alert('Hubo un error al programar la cita. Por favor, inténtelo de nuevo.');
                window.location.href = '../Vistas/Programar_Cita.php';
            </script>";
        }
    }

    $db->close();
}
?>
