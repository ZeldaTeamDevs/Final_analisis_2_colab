<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCorp - Mi Perfil</title>
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
                    <a href="Mascota.php">
                        <i class="fas fa-paw"></i> Mis Mascotas
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="inicio_Usuario.php">
                        <i class="fas fa-paw"></i> PetCorp
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="../landing/HomePage.php">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>
                <!-- Agrega más elementos de menú aquí -->
            </ul>
        </div>
        <div class="main-content">
            <div class="card user-profile crdbody">
                <div class="card-body">
                    <h5 class="card-title">Perfil de Usuario</h5>
                    <div class="user-info">
                        <div class="user-details">
                            <h6 class="user-name">Nombre de Usuario:</h6>
                            <p class="user-email">Correo Electrónico: usuario@example.com</p>
                            <p class="user-citas">Número de Citas: </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card crdbody">
                <div class="card-body">
                    <h5 class="card-title">Visitas Realizadas</h5>
                    <div class="container mt-5">
                        <div class="row">
                        <?php
                            // Conexión a la base de datos
                            $conn = new mysqli("localhost", "root", "", "bd_petcorp_system");

                            // Verifica la conexión
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consulta SQL para obtener las citas con Estado_Cita igual a "Realizada"
                            $sql = "SELECT c.ID_Cita, c.Fecha_Hora_Cita, c.Estado_Cita, m.Nombre as NombreMascota, m.Raza, v.Nombre_Veterinario 
                                    FROM citas c
                                    INNER JOIN tb_mascota m ON c.cod_Mascota = m.cod_Mascota
                                    INNER JOIN veterinarios v ON c.ID_Veterinario = v.ID_Veterinario
                                    WHERE c.Estado_Cita = 'Realizada'"; // Agregamos la condición aquí

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Cita para</th>';
                                echo '<th>Raza</th>';
                                echo '<th>Fecha y Hora</th>';
                                echo '<th>Veterinario</th>';
                                echo '<th>Estado</th>';
                                echo '<th>Acciones</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                            
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row['NombreMascota'] . '</td>';
                                    echo '<td>' . $row['Raza'] . '</td>';
                                    echo '<td>' . $row['Fecha_Hora_Cita'] . '</td>';
                                    echo '<td>' . $row['Nombre_Veterinario'] . '</td>';
                                    echo '<td>' . $row['Estado_Cita'] . '</td>';
                                    echo '<td><a href="ver_cita.php?id=' . $row['ID_Cita'] . '" class="btn btn-primary">Ver Cita</a></td>';
                                    echo '</tr>';
                                }
                            
                                echo '</tbody>';
                                echo '</table>';
                                echo '</div>';
                            } else {
                                echo "No se encontraron citas realizadas en la base de datos.";
                            }

                            // Cierra la conexión
                            $conn->close();
                        ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card user-purchases">
                <div class="card-body crdbody">
                    <h5 class="card-title">Compras Realizadas</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID de Factura</th>
                                    <th>Fecha de Emisión</th>
                                    <th>Descripción de Servicios</th>
                                    <th>Monto Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se cargarán dinámicamente los datos de las compras mediante PHP -->
                                <?php
                                // Conexión a la base de datos
                                $conn = new mysqli("localhost", "root", "", "bd_petcorp_system");

                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }

                                // Consulta SQL para obtener todas las compras del usuario logeado
                                $sql = "SELECT `ID_Factura`, `Fecha_Emision`, `Descripcion_Servicios`, `Monto_Total` FROM `facturas` WHERE `Cod_Usuario` = 'codigo_de_usuario'";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['ID_Factura'] . '</td>';
                                        echo '<td>' . $row['Fecha_Emision'] . '</td>';
                                        echo '<td>' . $row['Descripcion_Servicios'] . '</td>';
                                        echo '<td>' . $row['Monto_Total'] . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="4">No se encontraron compras realizadas.</td></tr>';
                                }

                                // Cierra la conexión
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
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
