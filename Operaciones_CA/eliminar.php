<?php

include "../php/conexionbd.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $idcita= $_POST['id'];


    $consulta= "DELETE FROM citas WHERE ID_Cita= '$idcita'";

    $conn->query( $consulta); //Ejecutar consulta

    header('Location: ../Vistas/Vistas_Admin/Vistas_Citas/Citas_Admin.php '); 
    exit();
       
}


?>