<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>

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
                    <a href="../../../landing/HomePage.php">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>
                <!-- Agrega más elementos de menú aquí -->
            </ul>
        </div>


        <div class="main-content">

        <!--Comprobar si hay que ingresar o editar un Usuario-->

        <?php
        if (isset($_POST['editar'])){
            
            include '../../../php/conexionbd.php';



            $idusuario = $_POST['id'];
            $sql = "SELECT * FROM `tb_usuario` WHERE id_Usuario = '$idusuario'";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();



        ?>

       

            <!--Formulario para editar usuario-->
            <div class="card">
                    <div class="card-header">
                        Editar usuario
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../../Operaciones_UA/editar.php">

                            <input type="hidden" name="id"  value="<?php echo $idusuario ?>">

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo $row['Nombre'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" name="correo" value="<?php echo $row['Correo'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" value="<?php echo $row['Contraseña'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="codigo">Codigo Usuario:</label>
                                <input type="text" class="form-control" name="codigo" value="<?php echo $row['Cod_Usuario'] ?>" >
                            </div>

                            <div class="form-group">
                                <label for="usuario">Nivel:</label>
                                <select class="form-control" name="nivel"  required>

                                    <?php
                                        include '../../../php/conexionbd.php';
                                        $sql2 = "SELECT `Nivel` FROM `tb_niveles` WHERE `id_Nivel` = " . $row["Nivel"];

                                        $result2 = $conn->query($sql2);
                                        $row2 = $result2->fetch_assoc();
                                    ?>



                                    <option value="<?php echo $row['Nivel'] ?>"><?php echo $row2['Nivel'] ?></option>
                                    <?php
                                    // Conexión a la base de datos para obtener niveles

                                    include '../../../php/conexionbd.php';

                                    // Consulta para obtener nombres de usuarios
                                    $sql = "SELECT `id_Nivel`, `Nivel` FROM `tb_niveles`";
                                    $result = $conn->query($sql);
                                
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["id_Nivel"] . "'>" . $row["Nivel"] . "</option>";
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

                <?php } else{?>


                <!--Fin formulario para editar usuario-->



            <!--Formulario para insertar usuario-->
                <div class="card">
                    <div class="card-header">
                        Ingresar nuevo usuario
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../../Operaciones_UA/registrar.php">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" name="correo" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <div class="form-group">
                                <label for="usuario">Nivel:</label>
                                <select class="form-control" name="nivel" required>
                                    <?php
                                    // Conexión a la base de datos para obtener niveles

                                    include '../../../php/conexionbd.php';

                                    // Consulta para obtener nombres de usuarios
                                    $sql = "SELECT `id_Nivel`, `Nivel` FROM `tb_niveles`";
                                    $result = $conn->query($sql);
                                
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["id_Nivel"] . "'>" . $row["Nivel"] . "</option>";
                                        }
                                    }
                                
                                    $conn->close();
                                    ?>
                                </select>
                            </div>

                        

                            <div class="form-group">
                                <label for="codigo">Codigo Usuario:</label>
                                <input type="text" class="form-control" name="codigo" disabled>
                            </div>


                            <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                        </form>
                    </div>
                </div>

                <?php } ?>

                <!--Fin formulario para insertar usuario-->
                                
                <div class="card mt-3">
                    <div class="card-header">
                        Lista de Usuarios
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Contraseña</th>
                                    <th>Nivel</th>
                                    <th>Codigo Usuario</th>
                                    <th>Opciones</th>
                                    <!-- Agregar más columnas si es necesario -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Conexión a la base de datos para mostrar datos de usuarios en la tabla
                               
                                include '../../../php/conexionbd.php';
                            
                                // Consulta para obtener datos de mascotas
                                $sql = "SELECT * FROM `tb_usuario`";
                                $result = $conn->query($sql);
                            
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        //Consulta para obtener el nombre del nivel

                                        $sql2 = "SELECT `Nivel` FROM `tb_niveles` WHERE `id_Nivel` = " . $row["Nivel"];

                                        $result2 = $conn->query($sql2);
                                        $row2 = $result2->fetch_assoc();

                                        echo "<tr>";
                                        echo "<td>" . $row["id_Usuario"] . "</td>";
                                        echo "<td>" . $row["Nombre"] . "</td>";
                                        echo "<td>" . $row["Correo"] . "</td>";
                                        echo "<td>" . $row["Contraseña"] . "</td>";
                                        echo "<td>" . $row2["Nivel"] . "</td>";
                                        echo "<td>" . $row["Cod_Usuario"] . "</td>";
                                        echo 
                                        "<td>
                                        <form method='POST' action='".$_SERVER['PHP_SELF']."'>
                                        <input type='hidden' name='id' value='".$row["id_Usuario"]."'>
                                        <button name='editar' class='btn btn-primary'>Editar</button>
                                        </form>
                                        </td>";

                                        echo 
                                        "<td>
                                        <form  onsubmit=\"return confirm('Realmente desea eliminar el registro?');\" method='POST' action='../../../Operaciones_UA/eliminar.php'>
                                        <input type='hidden' name='id' value='".$row["id_Usuario"]."'>
                                        <button type='submit' name='eliminar' class='btn btn-danger' >Eliminar</button>
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
