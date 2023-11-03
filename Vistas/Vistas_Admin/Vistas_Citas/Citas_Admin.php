<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Citas</title>

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

            



            $idcita = $_POST['id'];
            $sql = "SELECT * FROM `citas` WHERE ID_Cita = '$idcita'";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();




        ?>

       

            <!--Formulario para editar usuario-->
            <div class="card">
                    <div class="card-header">
                        Editar Cita
                    </div>
                    <div class="card-body">

                    <form method="POST" action="../../../Operaciones_CA/editar.php">

                    <input type="hidden" name="id" value="<?php echo $idcita ?>">
                            
                        <div class="form-group">
                                <label for="cod_mascota">Codigo Mascota:</label>
                                <select class="form-control" name="cod_mascota" required>

                                
                                <?php  
                                    $sqlcod = "SELECT cod_Mascota FROM citas WHERE ID_Cita= '$idcita'";
                                    $resultado = $conn->query($sqlcod);
                                    $row= $resultado->fetch_assoc();
                                ?>

                                <option value="<?php echo $row['cod_Mascota'] ?>"><?php echo $row['cod_Mascota'] ?></option>
                                    <?php
                                    // Conexión a la base de datos para obtener niveles

                                    include '../../../php/conexionbd.php';

                                    // Consulta para obtener nombres de usuarios
                                    $sqlcod_mascota = "SELECT `cod_Mascota` FROM `tb_mascota`";
                                    $resultcm = $conn->query($sqlcod_mascota);
                                
                                    if ($resultcm->num_rows > 0) {
                                        while ($rowcm = $resultcm->fetch_assoc()) {
                                            echo "<option value='" . $rowcm["cod_Mascota"] . "'>" . $rowcm["cod_Mascota"] . "</option>";
                                        }
                                    }
                                
                                    $conn->close();
                                    
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                            <label for="Fecha_Hora_Cita">Fecha y Hora de la Cita</label>

                            <?php  
                                    include '../../../php/conexionbd.php';
                                    $sqlfecha = "SELECT Fecha_Hora_Cita FROM citas WHERE ID_Cita= '$idcita'";
                                    $resultado = $conn->query($sqlfecha);
                                    $row= $resultado->fetch_assoc();
                                ?>

                                
                                    <input type="datetime-local" name="Fecha_Hora_Cita" class="form-control" id="Fecha_Hora_Cita" value="<?php echo $row['Fecha_Hora_Cita'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="veterinario">Veterinario:</label>
                                <select class="form-control" name="veterinario" required>


                                    <?php 
                                    include '../../../php/conexionbd.php';

                                    $sqlvete= "SELECT ID_Veterinario FROM citas WHERE ID_Cita='$idcita'";
                                    $resultado = $conn->query($sqlvete);
                                    $row = $resultado->fetch_assoc(); 

                                    $sqlnombre = "SELECT Nombre_Veterinario FROM veterinarios WHERE ID_Veterinario= ".$row['ID_Veterinario'];
                                    $resultado2 = $conn->query($sqlnombre);
                                    $row2= $resultado2->fetch_assoc();
                                    
                                    ?>

                                    <option value="<?php echo $row['ID_Veterinario'] ?>"><?php echo $row2['Nombre_Veterinario'] ?></option>

                                    <?php
                                    // Conexión a la base de datos para obtener niveles

                                    include '../../../php/conexionbd.php';

                                    // Consulta para obtener nombres de usuarios
                                    $sqlvet = "SELECT `ID_Veterinario`,`Nombre_Veterinario`  FROM `veterinarios`";
                                    $resultvet = $conn->query($sqlvet);
                                
                                    if ($resultvet->num_rows > 0) {
                                        while ($rowvet = $resultvet->fetch_assoc()) {
                                            echo "<option value='" . $rowvet["ID_Veterinario"] . "'>" . $rowvet["Nombre_Veterinario"] . "</option>";
                                        }
                                    }
                                
                                    $conn->close();
                                    
                                    ?>
                                </select>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <select class="form-control" name="estado" required>

                                    <?php 
                                        
                                        include '../../../php/conexionbd.php';
                                        $sqlest= "SELECT `Estado_Cita` FROM citas WHERE ID_Cita='$idcita'";
                                        $resultado = $conn->query($sqlest);
                                        $row = $resultado->fetch_assoc();
                                        
                                        $sqlesname= "SELECT `Estado de cita` FROM nom_citas WHERE id_cita= ".$row['Estado_Cita'];
                                        $resultado3 = $conn->query($sqlesname);
                                        $row3 = $resultado3->fetch_assoc();

                                        

                                    ?>

                                        

                                    <option value="<?php echo $row['Estado_Cita'] ?>"><?php echo $row3['Estado de cita'] ?></option>

                                    

                                    <?php
                                    // Conexión a la base de datos para obtener niveles

                                    include '../../../php/conexionbd.php';

                                    // Consulta para obtener nombres de usuarios
                                    $sqlestado = "SELECT `id_cita`, `Estado de cita` FROM `nom_citas`";
                                    $resultes = $conn->query($sqlestado);
                                
                                    if ($resultes->num_rows > 0) {
                                        while ($rowes = $resultes->fetch_assoc()) {
                                            echo "<option value='" . $rowes["id_cita"] . "'>" . $rowes["Estado de cita"] . "</option>";
                                        }
                                    }
                                
                                    $conn->close();
                                    ?>
                                </select>
                            </div>

                                

                            <div class="form-group">


                                <?php

                                    include '../../../php/conexionbd.php';

                                    $sqldesc= "SELECT Desc_Cita FROM citas WHERE ID_Cita= '$idcita'";
                                    $resultado = $conn->query($sqldesc);
                                    $row= $resultado->fetch_assoc();
                                ?>


                                <label for="descripcion">Descripción:</label>
                                <input type="text" class="form-control" name="descripcion" value="<?php echo $row['Desc_Cita'] ?>" >
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
                        Ingresar nueva cita
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../../Operaciones_CA/registrar.php">
                            
                        <div class="form-group">
                                <label for="cod_mascota">Codigo Mascota:</label>
                                <select class="form-control" name="cod_mascota" required>
                                    <?php
                                    // Conexión a la base de datos para obtener niveles

                                    include '../../../php/conexionbd.php';

                                    // Consulta para obtener nombres de usuarios
                                    $sqlcod_mascota = "SELECT `cod_Mascota` FROM `tb_mascota`";
                                    $resultcm = $conn->query($sqlcod_mascota);
                                
                                    if ($resultcm->num_rows > 0) {
                                        while ($rowcm = $resultcm->fetch_assoc()) {
                                            echo "<option value='" . $rowcm["cod_Mascota"] . "'>" . $rowcm["cod_Mascota"] . "</option>";
                                        }
                                    }
                                
                                    $conn->close();
                                    
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                            <label for="Fecha_Hora_Cita">Fecha y Hora de la Cita</label>
                                    <input type="datetime-local" name="Fecha_Hora_Cita" class="form-control" id="Fecha_Hora_Cita">
                            </div>

                            <div class="form-group">
                                <label for="veterinario">Veterinario:</label>
                                <select class="form-control" name="veterinario" required>
                                    <?php
                                    // Conexión a la base de datos para obtener niveles

                                    include '../../../php/conexionbd.php';

                                    // Consulta para obtener nombres de usuarios
                                    $sqlvet = "SELECT `ID_Veterinario`,`Nombre_Veterinario`  FROM `veterinarios`";
                                    $resultvet = $conn->query($sqlvet);
                                
                                    if ($resultvet->num_rows > 0) {
                                        while ($rowvet = $resultvet->fetch_assoc()) {
                                            echo "<option value='" . $rowvet["ID_Veterinario"] . "'>" . $rowvet["Nombre_Veterinario"] . "</option>";
                                        }
                                    }
                                
                                    $conn->close();
                                    
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <select class="form-control" name="estado" required>
                                    <?php
                                    // Conexión a la base de datos para obtener niveles

                                    include '../../../php/conexionbd.php';

                                    // Consulta para obtener nombres de usuarios
                                    $sqlestado = "SELECT `id_cita`, `Estado de cita` FROM `nom_citas`";
                                    $resultes = $conn->query($sqlestado);
                                
                                    if ($resultes->num_rows > 0) {
                                        while ($rowes = $resultes->fetch_assoc()) {
                                            echo "<option value='" . $rowes["id_cita"] . "'>" . $rowes["Estado de cita"] . "</option>";
                                        }
                                    }
                                
                                    $conn->close();
                                    ?>
                                </select>
                            </div>

                        

                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <input type="text" class="form-control" name="descripcion" >
                            </div>


                            <button type="submit" class="btn btn-primary">Agregar Cita</button>
                        </form>
                    </div>
                </div>

                <?php } ?>

                <!--Fin formulario para insertar usuario-->
                                
                <div class="card mt-3">
                    <div class="card-header">
                        Lista de Citas
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Codigo mascota</th>
                                    <th>Fecha-Hora</th>
                                    <th>Veterinario</th>
                                    <th>Estado</th>
                                    <th>Descripcion</th>
                                    <th>Opciones</th>
                                    <!-- Agregar más columnas si es necesario -->
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        // Conexión a la base de datos
                        include '../../../php/conexionbd.php';

                        // Consulta para obtener datos de citas con nombres de veterinarios y estados
                        $sql = "SELECT c.ID_Cita, c.cod_Mascota, c.Fecha_Hora_Cita, v.Nombre_Veterinario, nc.`Estado de cita`, c.Desc_Cita
                                FROM `citas` c
                                INNER JOIN `veterinarios` v ON c.ID_Veterinario = v.ID_Veterinario
                                INNER JOIN `nom_citas` nc ON c.Estado_Cita = nc.id_cita";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["ID_Cita"] . "</td>";
                                echo "<td>" . $row["cod_Mascota"] . "</td>";
                                echo "<td>" . $row["Fecha_Hora_Cita"] . "</td>";
                                echo "<td>" . $row["Nombre_Veterinario"] . "</td>";
                                echo "<td>" . $row["Estado de cita"] . "</td>";
                                echo "<td>" . $row["Desc_Cita"] . "</td>";
                                echo 
                                "<td>
                                    <form method='POST' action='".$_SERVER['PHP_SELF']."'>
                                    <input type='hidden' name='id' value='".$row["ID_Cita"]."'>
                                    <button name='editar' class='btn btn-primary'>Editar</button>
                                    </form>
                                </td>";
                            
                                echo 
                                "<td>
                                    <form onsubmit=\"return confirm('Realmente desea eliminar el registro?');\" method='POST' action='../../../Operaciones_CA/eliminar.php'>
                                    <input type='hidden' name='id' value='".$row["ID_Cita"]."'>
                                    <button type='submit' name'eliminar' class='btn btn-danger'>Eliminar</button>
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
