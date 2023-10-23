
<?php
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "bd_petcorp_system");
    mysqli_set_charset($conexion, "utf8");

    // Consultas SQL para contar registros en cada tabla
    $queryArticulos = "SELECT COUNT(*) AS count FROM inventario";
    $resultArticulos = mysqli_query($conexion, $queryArticulos);
    $rowArticulos = mysqli_fetch_assoc($resultArticulos);
    $countArticulos = $rowArticulos['count'];

    $queryCitas = "SELECT COUNT(*) AS count FROM citas";
    $resultCitas = mysqli_query($conexion, $queryCitas);
    $rowCitas = mysqli_fetch_assoc($resultCitas);
    $countCitas = $rowCitas['count'];

    $queryMascotas = "SELECT COUNT(*) AS count FROM tb_mascota";
    $resultMascotas = mysqli_query($conexion, $queryMascotas);
    $rowMascotas = mysqli_fetch_assoc($resultMascotas);
    $countMascotas = $rowMascotas['count'];

    $queryUsuarios = "SELECT COUNT(*) AS count FROM tb_usuario";
    $resultUsuarios = mysqli_query($conexion, $queryUsuarios);
    $rowUsuarios = mysqli_fetch_assoc($resultUsuarios);
    $countUsuarios = $rowUsuarios['count'];
?>
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
    <link rel="stylesheet" href="../../assets/css/side.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
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
                    <a href="../Vistas_Admin/Modulo_Mascotas/Admin_Mascotas.php">
                        <i class="fas fa-paw"></i> Módulo Mascotas
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <i class="far fa-calendar"></i> Módulo Citas
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="Perfil.php">
                        <i class="fas fa-user"></i> Perfiles de Usuarios
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <i class="fas fa-shopping-bag"></i> Inventario
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
            <!-- Contenido principal -->
                
            <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fas fa-paw fa-5x" style="color: #E57373;"></i>
                                    <h5 class="card-title">Mascotas</h5>
                                    <p class="card-text">Administra las mascotas.</p>
                                    <p class="card-text">Cantidad de Registros: <?php echo $countMascotas; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class ="card">
                                <div class="card-body">
                                    <i class="fas fa-users fa-5x" style="color: #64B5F6;"></i>
                                    <h5 class="card-title">Usuarios</h5>
                                    <p class="card-text">Administra los usuarios del sistema.</p>
                                    <p class="card-text">Cantidad de Registros: <?php echo $countUsuarios; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <i class="far fa-calendar fa-5x" style="color: #FFD54F;"></i>
                                    <h5 class="card-title">Citas</h5>
                                    <p class="card-text">Administra las citas de las mascotas.</p>
                                    <p class="card-text">Cantidad de Registros: <?php echo $countCitas; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <i class="fas fa-shopping-bag fa-5x" style="color: #81C784;"></i>
                                    <h5 class="card-title">Productos</h5>
                                    <p class="card-text">Administra el inventario de productos.</p>
                                    <p class="card-text">Cantidad de Registros: <?php echo $countArticulos; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                

        </div>
    </div>

    <!-- Enlaces a Bootstrap JS, jQuery y tus scripts personalizados -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../../assets/js/side.js"></script>
</body>
</html>
