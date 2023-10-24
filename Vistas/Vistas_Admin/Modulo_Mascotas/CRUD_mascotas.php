<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Este es el inicio Admin</title>

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
                            <label for="Especie">Especie:</label>
                            <select class="form-control" name="Especie" required>
                                <?php
                                // Conexión a la base de datos para obtener nombres de especies
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "bd_petcorp_system";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }

                                // Consulta para obtener nombres de especies
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
                                <th>Opciones</th>
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
                                    echo "<a href='javascript:void(0);' class='btn btn-primary editar-btn' data-id='" . $row["id_Mascota"] . "' data-nombre='" . $row["Nombre"] . "' data-fecha-nacimiento='" . $row["Fecha de nacimiento"] . "' data-especie='" . $row["Especie"] . "' data-raza='" . $row["Raza"] . "' data-usuario='" . $row["Usuario"] . "'>Editar</a>";
                                    echo "<a href='eliminar_mascota.php?id=" . $row["id_Mascota"] . "' class='btn btn-danger'>Eliminar</a>";
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


    <!-- Modal para la edición de mascotas -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Mascota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de edición de mascotas -->
                    <form method="POST" action="editar_mascota.php">
                        <input type="hidden" name="id_mascota" id="edit_id_mascota" value="">
                        <div class="form-group">
                            <label for="edit_nombre">Nombre:</label>
                            <input type="text" class="form-control" name="edit_nombre" id="edit_nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" name="edit_fecha_nacimiento" id="edit_fecha_nacimiento" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_especie">Especie:</label>
                            <select class="form-control" name="edit_especie" id="edit_especie" required>
                            <?php
                                // Conexión a la base de datos para obtener nombres de especies
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "bd_petcorp_system";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }

                                // Consulta para obtener nombres de especies
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
                            <label for="edit_raza">Raza:</label>
                            <input type="text" class="form-control" name="edit_raza" id="edit_raza" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_usuario">Usuario:</label>
                            <select class="form-control" name="edit_usuario" id="edit_usuario" required>
                            
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
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
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

<!-- Resto de tu HTML y scripts -->



    <!-- Añade esta sección al final de tu archivo HTML -->
<script>
    // Función para abrir el modal de edición y cargar datos
    function abrirModalEditar(idMascota, nombre, fechaNacimiento, especie, raza, usuario) {
        // Llenar los campos del formulario en el modal con los datos del registro seleccionado
        document.getElementById("edit_id_mascota").value = idMascota;
        document.getElementById("edit_nombre").value = nombre;
        document.getElementById("edit_fecha_nacimiento").value = fechaNacimiento;
        document.getElementById("edit_especie").value = especie;
        document.getElementById("edit_raza").value = raza;
        document.getElementById("edit_usuario").value = usuario;

        // Mostrar el modal de edición
        $('#editarModal').modal('show');
    }

    // Agrega un evento click a todos los botones "Editar"
    var editButtons = document.querySelectorAll('.editar-btn');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Obtener los atributos de datos del botón
            var idMascota = this.getAttribute('data-id');
            var nombre = this.getAttribute('data-nombre');
            var fechaNacimiento = this.getAttribute('data-fecha-nacimiento');
            var especie = this.getAttribute('data-especie');
            var raza = this.getAttribute('data-raza');
            var usuario = this.getAttribute('data-usuario');

            // Llamar a la función para abrir el modal de edición
            abrirModalEditar(idMascota, nombre, fechaNacimiento, especie, raza, usuario);
        });
    });
</script>

    <!-- Agrega tus scripts personalizados aquí -->
</body>

</html>
