<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PetCorp</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
            rel="stylesheet">
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css">
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
                        <a href="Programar_Cita.php">
                            <i class="far fa-calendar"></i> Programar Cita
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="Perfil.php">
                            <i class="fas fa-user"></i> Mi Perfil
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">
                            <i class="fas fa-box"></i> Mis Pedidos
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
                            <div class="row">
                                <?php
                                // Conexión a la base de datos
                                $conn = new mysqli("localhost", "root", "",
                                "bd_petcorp_system");

                                // Verifica la conexión
                                if ($conn->connect_error) {
                                die("Conexión fallida: " .
                                $conn->connect_error);
                                }

                                // Consulta SQL para obtener las mascotas
                                $sql =
                                "SELECT `id_Mascota`, `Nombre`, `Raza` FROM `tb_mascota`";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                echo '<div class="col-md-4 mb-4">';
                                    echo '<div class="card">';
                                        echo '<div class="card-body">';
                                            echo '<h5 class="card-title">' .
                                                $row['Nombre'] . '</h5>';
                                            echo '<p>Raza: ' . $row['Raza'] . '</p>';
                                            echo '<a
                                                href="Ficha_Mascota.php"
                                                class="btn btn-primary">Ver
                                                Mascota</a>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                                } else {
                                echo
                                "No se encontraron mascotas en la base de datos.";
                                }

                                // Cierra la conexión
                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card crdbody">
                    <div class="card-body">
                        <h5 class="card-title">Mis Citas</h5>
                        <div class="container mt-5">
                            <div class="row">
                                <?php
                                // Conexión a la base de datos
                                $conn = new mysqli("localhost", "root", "", "bd_petcorp_system");

                                // Verifica la conexión
                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }
                            
                                // Consulta SQL para obtener todas las citas
                                // Consulta SQL para obtener todas las citas
                                $sql = "SELECT c.ID_Cita, c.Fecha_Hora_Cita, c.Estado_Cita, m.Nombre as NombreMascota, m.Raza, v.Nombre_Veterinario 
                                FROM citas c
                                INNER JOIN tb_mascota m ON c.cod_Mascota = m.cod_Mascota
                                INNER JOIN veterinarios v ON c.ID_Veterinario = v.ID_Veterinario
                                WHERE c.Estado_Cita = 'Activo'";
                        


                                $result = $conn->query($sql);
                            
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="col-md-4 mb-4">';
                                        echo '<div class="card">';
                                        echo '<div class="card-body">';
                                        echo '<h5 class="card-title">Cita para ' . $row['NombreMascota'] . '</h5>';
                                        echo '<p>Raza: ' . $row['Raza'] . '</p>';
                                        echo '<p>Fecha y Hora: ' . $row['Fecha_Hora_Cita'] . '</p>';
                                        echo '<p>Veterinario: ' . $row['Nombre_Veterinario'] . '</p>';
                                        echo '<p>Estado: ' . $row['Estado_Cita'] . '</p>';
                                        // Agregar botón para ver cita
                                        echo '<a href="ver_cita.php?id=' . $row['ID_Cita'] . '" class="btn btn-primary">Ver Cita</a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo "No se encontraron citas en la base de datos.";
                                }
                            
                                // Cierra la conexión
                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card crdbody">
                    <div class="card-body">
                        <h5 class="card-title">Facturas</h5>
                        <div class="container mt-5">
                            <div class="row">
                                <?php
                                // Conexión a la base de datos
                                $conn = new mysqli("localhost", "root", "", "bd_petcorp_system");
                                            
                                // Verifica la conexión
                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }
                            
                                // Consulta SQL para obtener todas las facturas con información del usuario
                                $sql = "SELECT f.ID_Factura, u.Nombre, f.Fecha_Emision, f.Descripcion_Servicios, f.Monto_Total
                                        FROM facturas f
                                        INNER JOIN tb_usuario u ON f.Cod_Usuario = u.Cod_Usuario";
                
                                $result = $conn->query($sql);
                            
                                if ($result) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<div class="col-md-4 mb-4">';
                                            echo '<div class="card">';
                                            echo '<div class="card-body">';
                                            echo '<h5 class="card-title">Factura: </h5>';
                                            echo '<p>Cliente: ' . $row['Nombre'] . '</p>';
                                            echo '<p>Fecha de Emisión: ' . $row['Fecha_Emision'] . '</p>';
                                            echo '<p>Monto Total: $' . $row['Monto_Total'] . '</p>';
                                            // Agregar botón para ver la factura
                                            echo '<a href="ver_factura.php?id=' . $row['ID_Factura'] . '" class="btn btn-primary">Ver Factura</a>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo "No se encontraron facturas en la base de datos.";
                                    }
                                } else {
                                    echo "Error en la consulta: " . $conn->error;
                                }
                            
                                // Cierra la conexión
                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <!-- Enlace a Bootstrap JS y jQuery (necesarios para el funcionamiento de Bootstrap) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Enlace a FontAwesome para los iconos -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="../assets/js/side.js"></script>
    </body>

</html>
