<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Clinico de Mascota</title>

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
<div class="card mt-3">
    <div class="card-header">
        Lista de Mascotas-Fichas
    </div>
    <div class="card-body">
        <input type="text" id="buscar" class="form-control mb-3" placeholder="Buscar mascotas">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Especie</th>
                    <th>Raza</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                    <!-- Agregar más columnas si es necesario -->
                </tr>
            </thead>
            <tbody>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "bd_petcorp_system";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta SQL utilizando INNER JOIN para combinar las tablas
                $sql = "SELECT m.id_Mascota, m.Nombre, m.`Fecha de nacimiento`, e.Especie, m.Raza, u.Nombre AS Usuario
                        FROM tb_mascota m
                        INNER JOIN tb_usuario u ON m.Cod_usuario = u.Cod_Usuario
                        INNER JOIN tb_especie e ON m.Cod_especie = e.id_especie";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_Mascota"] . "</td>";
                        echo "<td>" . $row["Nombre"] . "</td>";
                        echo "<td>" . $row["Fecha de nacimiento"] . "</td>";
                        echo "<td>" . $row["Especie"] . "</td>";
                        echo "<td>" . $row["Raza"] . "</td>";
                        echo "<td>" . $row["Usuario"] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-secondary' data-id='" . $row["id_Mascota"] . "' data-nombre='" . $row["Nombre"] . "' data-especie='" . $row["Especie"] . "'>Vacunas</button>";
                        echo "<button class='btn btn-info' data-id='" . $row["id_Mascota"] . "' data-nombre='" . $row["Nombre"] . "'>Historial</button>";
                        echo "<button class='btn btn-warning' data-id='" . $row["id_Mascota"] . "' data-nombre='" . $row["Nombre"] . "'>Cartilla</button>";
                        echo "<button class='btn btn-success' data-id='" . $row["id_Mascota"] . "' data-nombre='" . $row["Nombre"] . "'>Visitas</button>";
                        echo "</td>";
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
    <!-- Enlace a jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Enlaces a Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Tu otro código JavaScript personalizado -->
    <script src="../../../assets/js/side.js"></script>

    <script>
        // Función para filtrar la tabla cuando se ingrese texto en el campo de búsqueda
        $("#buscar").on("keyup", function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("buscar");
            filter = input.value.toUpperCase();
            table = document.querySelector(".table");
            tr = table.getElementsByTagName("tr");
    
            // Recorre todas las filas de la tabla y oculta aquellas que no coinciden con la búsqueda
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Cambia [1] al índice de la columna que deseas buscar (en este caso, Nombre)
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });
    </script>
</body>

</html>
