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
                    <a href="#">
                        <i class="fas fa-paw"></i> Ficha de Mascotas
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <i class="fas fa-paw"></i> Tarjetas de Vacunación
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <i class="fas fa-user"></i> Mi Perfil
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
                <h2>Datos de Usuario</h2>
                <div class="card-body">
                    <!-- Aquí puedes mostrar los datos del usuario, por ejemplo: -->
                    <p>Nombre: Juan Pérez</p>
                    <p>Correo Electrónico: juan@example.com</p>
                    <!-- Agrega más datos según tu base de datos -->
                </div>
            </div>
            <div class="card">
                <h2>Visitas Confirmadas</h2>
                <div class="card-body">
                    <ul>
                        <?php
                        // Aquí puedes obtener y mostrar las visitas confirmadas desde la base de datos usando PHP
                        // Por ejemplo, supongamos que tienes un arreglo $visitas con datos de visitas
                        $visitas = array(
                            array("Fecha" => "2023-10-15", "Hora" => "10:00 AM", "Lugar" => "Clínica A"),
                            array("Fecha" => "2023-10-16", "Hora" => "2:30 PM", "Lugar" => "Clínica B"),
                            // Agrega más datos según tu base de datos
                        );

                        foreach ($visitas as $visita) {
                            echo "<li>{$visita['Fecha']} a las {$visita['Hora']} en {$visita['Lugar']}</li>";
                        }
                        ?>
                    </ul>
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
