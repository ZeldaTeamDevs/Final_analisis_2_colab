<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Este es el inicio Admin</title>

    <!-- Enlaces a Bootstrap CSS y Bootstrap temática (Bootswatch) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css">

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
                    <a href="../../Vistas_Admin/Modulo_Mascotas/Cartillas.php">
                        <i class="fas fa-paw"></i> Cartillas
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="../../Vistas_Admin/Modulo_Mascotas/CRUD_mascotas.php">
                        <i class="fas fa-paw"></i> Gestion
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="../../Vistas_Admin/Modulo_Mascotas/Historial_Clinico.php">
                        <i class="fas fa-paw"></i> Historial clinico
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="../../Vistas_Admin/Modulo_Mascotas/Ficha.php">
                        <i class="fas fa-paw"></i> Ficha
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
                        Ingresar Nueva Mascota
                    </div>
                    <div class="card-body">
                        <form method="POST" action="insertar_mascota.php">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" name="fecha_nacimiento" required>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Especie:</label>
                                <select class="form-control" name="usuario" required>
                                    <?php
                                    // Conexión a la base de datos para obtener nombres de usuarios
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "bd_petcorp_system";
            
                                    $conn = new mysqli($servername, $username, $password, $dbname);
            
                                    if ($conn->connect_error) {
                                        die("Conexión fallida: " . $conn->connect_error);
                                    }
                                
                                    // Consulta para obtener nombres de usuarios
                                    $sql = "SELECT `id_especie`, `Especie` FROM `tb_especie`";
                                    $result = $conn->query($sql);
                                
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["id_especie"] . "'>" . $row["Especie"] . "</option>";
                                        }
                                    }
                                
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="raza">Raza:</label>
                                <input type="text" class="form-control" name="raza" required>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <select class="form-control" name="usuario" required>
                                    <?php
                                    // Conexión a la base de datos para obtener nombres de usuarios
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "bd_petcorp_system";

                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                    if ($conn->connect_error) {
                                        die("Conexión fallida: " . $conn->connect_error);
                                    }
                                
                                    // Consulta para obtener nombres de usuarios
                                    $sql = "SELECT `Cod_Usuario`, `Nombre` FROM `tb_usuario`";
                                    $result = $conn->query($sql);
                                
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["Cod_Usuario"] . "'>" . $row["Nombre"] . "</option>";
                                        }
                                    }
                                
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar Mascota</button>
                        </form>
                    </div>
                </div>
                                
                <div class="card mt-3">
                    <div class="card-header">
                        Lista de Mascotas
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Especie</th>
                                    <th>Raza</th>
                                    <th>Usuario</th>
                                    <!-- Agregar más columnas si es necesario -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Conexión a la base de datos para mostrar datos de mascotas
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "bd_petcorp_system";
                                
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                
                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }
                            
                                // Consulta para obtener datos de mascotas
                                $sql = "SELECT `id_Mascota`, `Nombre`, `Fecha de nacimiento`, `Cod_especie`, `Raza`, `Cod_usuario` FROM `tb_mascota`";
                                $result = $conn->query($sql);
                            
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["id_Mascota"] . "</td>";
                                        echo "<td>" . $row["Nombre"] . "</td>";
                                        echo "<td>" . $row["Fecha de nacimiento"] . "</td>";
                                        echo "<td>" . $row["Cod_especie"] . "</td>";
                                        echo "<td>" . $row["Raza"] . "</td>";
                                        echo "<td>" . $row["Cod_usuario"] . "</td>";
                                        // Agregar más columnas si es necesario
                                        echo "</tr>";
                                    }
                                }
                            
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>

    <!-- Enlaces a Bootstrap JS, jQuery y tus scripts personalizados -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../../../assets/js/side.js"></script>
</body>
</html>
