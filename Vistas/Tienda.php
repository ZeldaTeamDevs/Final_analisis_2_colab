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
      href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css"
      integrity="sha384-H4X+4tKc7b8s4GoMrylmy2ssQYpDHoqzPa9aKXbDwPoPUA3Ra8PA5dGzijN+ePnH"
      crossorigin="anonymous">
      
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/functions.js"></script>
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Nuevos_estilos.css">

  </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarColor01" aria-controls="navbarColor01"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <li class="nav-item">
                <img src="../assets/images/logo.png" alt="Logo" style="width: 120px; height: 120px;">
            </li>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="../landing/HomePage.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mas de Nosotros</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Aun no eres CLiente?
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-pencil-alt"></i> Registarse
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">
                                    <i class="fas fa-user"></i> Iniciar Sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Shopping Cart Icon -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-shopping-cart"></i> Visita nuestra tienda
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form class="d-flex" action="busqueda.php" method="GET">
        <input class="form-control me-2" type="text" placeholder="Buscar productos..." name="q">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>

    <!-- Contenido de la Tienda en Línea -->
    <div class="container mt-5">
        <h1>Bienvenido a Tu PetCorp Salud Al alcance de la Pata</h1>
        <p>Explora nuestros productos y encuentra las mejores ofertas en productos para mascotas.</p>
        
        <div class="row">
            <?php
            // Conexión a la base de datos
            $conn = new mysqli("localhost", "root", "", "midb");

            // Verifica la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL para obtener los productos
            $sql = "SELECT * FROM productos";
            $result = $conn->query($sql);

            // Consulta SQL para obtener los productos
                $sql = "SELECT * FROM productos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-4 mb-4">';
                        echo '<div class="card">';
                        echo '<img src="' . $row['Imagen'] . '" class="card-img-top" alt="Producto">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row['Nombre'] . '</h5>';
                        echo '<p class="card-text">' . $row['Descripcion'] . '</p>';
                        echo '<p>Precio: Q' . $row['Precio'] . '</p>';
                        echo '<a href="#" class="btn btn-primary">Comprar</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "No se encontraron productos en la base de datos.";
                }


            // Cierra la conexión

            ?>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y jQuery (necesarios para el funcionamiento de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
