<?php

include "../php/conexionbd.php";




if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $idcita= $_POST['id'];

    $codigomascota = $_POST['cod_mascota']; //Obtener valores del formulario
    $fechahora = $_POST['Fecha_Hora_Cita'];
    $veterinario = $_POST['veterinario'];
    $estado= $_POST['estado'];
    $descripcion= $_POST['descripcion'];




   
    $consulta= "UPDATE citas SET cod_Mascota='$codigomascota', Fecha_Hora_Cita='$fechahora', ID_Veterinario='$veterinario', Estado_Cita='$estado', Desc_Cita= '$descripcion' WHERE ID_Cita='$idcita' ";

    $conn->query( $consulta); //Ejecutar consulta

    header('Location: ../Vistas/Vistas_Admin/Vistas_Citas/Citas_Admin.php '); 
    exit();
       

   
    
}



?>