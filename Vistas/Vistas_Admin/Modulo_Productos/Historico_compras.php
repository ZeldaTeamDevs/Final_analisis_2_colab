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
