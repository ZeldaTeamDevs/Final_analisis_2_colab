<?php
// Conexión a la base de datos para obtener las vacunas
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_petcorp_system";

$conn = new mysqli($servername, $username, $password, $dbname);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Este es el inicio Admin</title>

    <!-- Enlaces a Bootstrap CSS y Bootstrap temática (Bootswatch) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/minty/bootstrap.min.css">

    <!-- Enlace a FontAwesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Agrega tus estilos CSS personalizados -->
    <link rel="stylesheet" href="../../../assets/css/side.css">
    <link rel="stylesheet" href="../../../assets/css/estilos.css">
</head>
<body>
    <!-- Dashboard -->
    <div class="dashboard-container">
        <div class="sidebar">
            <h2>Admin</h2>
            <button class="btn toggle-button" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="../../Vistas_Admin/Modulo_Mascotas/CRUD_mascotas.php">
                        <i class="fas fa-paw"></i> Gestion
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="../../Vistas_Admin/Modulo_Mascotas/Historial_Clinico.php">
                        <i class="fas fa-paw"></i> Historial clínico
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="../Inicio_Admin.php">
                        <i class="fas fa-paw"></i> Regresar
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>
                <!-- Agrega más elementos de menú aquí -->
            </ul>
        </div>
        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    Ingresar Nueva Vacuna
                </div>
                <div class="card-body crdbody">
                    <form method="POST" action="insertar_cartilla.php">
                        <div class="form-group">
                            <label for="codMascota">Mascota:</label>
                            <select class="form-control" name="codMascota" required>
                                <?php
                                // Consulta para obtener las mascotas desde la tabla "tb_mascota"
                                $sql = "SELECT `id_Mascota`,cod_Mascota, `Nombre` FROM `tb_mascota`";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["cod_Mascota"] . "'>" . $row["Nombre"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fechaAplicacion">Fecha de Aplicación de la Vacuna:</label>
                            <input type="date" class="form-control" name="fechaAplicacion" required>
                        </div>
                        <div class="form-group">
                            <label for="comentarios">Comentarios:</label>
                            <textarea class="form-control" name="comentarios" rows="3"></textarea>
                        </div>
                        <div class="form-group crdbody">
                            <label for="vacunaAplicada">Vacuna Aplicada:</label>
                            <select class="form-control" name="vacunaAplicada" required>
                                <?php
                                // Consulta para obtener las vacunas desde la tabla "vacunas"
                                $sql = "SELECT `id_vacunas`, `Nombre` FROM `vacunas`";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["id_vacunas"] . "'>" . $row["Nombre"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Cartilla de Vacunación</button>
                    </form>
                </div>
            </div>
            <div class="card crdbody">
                <div class="card-header">
                    Vacunas Aplicadas
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Cartilla</th>
                                <th>Nombre de la Mascota</th>
                                <th>Fecha de Creación</th>
                                <th>Última Actualización</th>
                                <th>Comentarios</th>
                                <th>Nombre de la Vacuna</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Consulta SQL con INNER JOIN
                            $sql = "SELECT c.ID_Cartilla, m.Nombre AS NombreMascota, c.FechaCreacion, c.UltimaActualizacion, c.Comentarios, v.Nombre AS NombreVacuna
                                    FROM cartilladevacunacion c
                                    INNER JOIN tb_mascota m ON c.cod_Mascota = m.cod_Mascota
                                    INNER JOIN vacunas v ON c.Vacuna_Aplicada = v.id_vacunas";

                            $result = $conn->query($sql);

                            // Comprueba si hay resultados
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row["ID_Cartilla"] . '</td>';
                                    echo '<td>' . $row["NombreMascota"] . '</td>';
                                    echo '<td>' . $row["FechaCreacion"] . '</td>';
                                    echo '<td>' . $row["UltimaActualizacion"] . '</td>';
                                    echo '<td>' . $row["Comentarios"] . '</td>';
                                    echo '<td>' . $row["NombreVacuna"] . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo "No se encontraron registros.";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Enlaces a Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Tu otro código JavaScript personalizado -->
    <script src="../../../assets/js/side.js"></script>
</body>
</html>
