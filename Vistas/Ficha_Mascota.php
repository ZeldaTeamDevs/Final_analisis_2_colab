<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCorp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- Agrega tus estilos CSS personalizados -->
    <link rel="stylesheet" href="../assets/css/side.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <!-- Dashboard -->
    <div class="dashboard-container">
        <div class="sidebar">
            <h2>PetCorp</h2>
            <button class="btn toggle-button" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="Ficha_Mascota.php">
                        <i class="fas fa-paw"></i> Ficha de Mascotas
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="Vacunacion.php">
                        <i class="fas fa-paw"></i> Tarjetas de Vacunación
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="Perfil.php">
                        <i class="fas fa-user"></i> Mi Perfil
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="inicio_Usuario.php">
                        <i class="fas fa-paw"></i> PetCorp
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
            <div class="card crdbody">
                <div class="card-body">
                    <h5 class="card-title">Mis Mascotas</h5>
                    <div class="container mt-5">
                        <?php
                        // Conexión a la base de datos
                        $conn = new mysqli("localhost", "root", "", "bd_petcorp_system");

                        // Verifica la conexión
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener las mascotas con los datos requeridos
                        $sql = "SELECT m.*, e.Especie, u.Nombre as NombreUsuario
                                FROM tb_mascota m
                                INNER JOIN tb_especie e ON m.Cod_especie = e.id_especie
                                INNER JOIN tb_usuario u ON m.Cod_usuario = u.Cod_Usuario";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo '<table class="table">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Nombre</th>';
                            echo '<th>Fecha de Nacimiento</th>';
                            echo '<th>Raza</th>';
                            echo '<th>Especie</th>';
                            echo '<th>Nombre de Dueño</th>';
                            echo '<th>Fecha de Registro</th>';
                            echo '<th>Acciones</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['Nombre'] . '</td>';
                                echo '<td>' . $row['Fecha de nacimiento'] . '</td>';
                                echo '<td>' . $row['Raza'] . '</td>';
                                echo '<td>' . $row['Especie'] . '</td>';
                                echo '<td>' . $row['NombreUsuario'] . '</td>';
                                echo '<td>' . $row['Fecha_Registro'] . '</td>';
                                echo '<td><a href="../Reportes/Ficha_Mascota.php" target="_blank" class="btn btn-primary">Ver Ficha</a></td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo "No se encontraron mascotas en la base de datos.";
                        }

                        // Cierra la conexión
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y jQuery (necesarios para el funcionamiento de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Enlace a FontAwesome para los iconos -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../assets/js/side.js"></script>
</body>
</html>
