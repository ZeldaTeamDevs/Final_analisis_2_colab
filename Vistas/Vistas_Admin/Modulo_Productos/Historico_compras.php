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
                           <a href="Generar_Venta.php">
                               <i class="fas fa-shopping-cart"></i> Generar Compras
                           </a>
                       </li>

                       <li class="list-group-item">
                           <a href="inicio_Productos_Facturacion.php">
                               <i class="fas fa-arrow-left"></i> Regresar
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

            <div class="card mt-3">
                    <div class="card-header">
                        Historial de Compras
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código Usuario</th>
                                    <th>NIT</th>
                                    <th>Fecha Emisión</th>
                                    <th>Productos</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                    <!-- Agregar más columnas si es necesario -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Conexión a la base de datos para mostrar datos de usuarios en la tabla
                               
                                include '../../../php/conexionbd.php';
                            
                                // Consulta para obtener datos de mascotas
                                $sql = "SELECT * FROM `facturas`";
                                $result = $conn->query($sql);
                            
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        //Consulta para obtener el nombre del nivel
                                        /*
                                        $sql2 = "SELECT `Nivel` FROM `tb_niveles` WHERE `id_Nivel` = " . $row["Nivel"];

                                        $result2 = $conn->query($sql2);
                                        $row2 = $result2->fetch_assoc();
                                        */
                                        echo "<tr>";
                                        echo "<td>" . $row["ID_Factura"] . "</td>";
                                        echo "<td>" . $row["Cod_Usuario"] . "</td>";
                                        echo "<td>" . $row["nit"] . "</td>";
                                        echo "<td>" . $row["Fecha_Emision"] . "</td>";
                                        echo "<td>" . $row["Descripcion_Servicios"] . "</td>";
                                        echo "<td>" ."Q".$row["Monto_Total"] . "</td>";
                                        echo 
                                        "<td>
                                        <form method='POST' action='".$_SERVER['PHP_SELF']."'>
                                        <input type='hidden' name='id' value='".$row["ID_Factura"]."'>
                                        <a href='../../../Reportes/Facturas.php' name='editar' class='btn btn-primary'>Imprimir</a>
                                        </form>
                                        </td>";

                                        
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
