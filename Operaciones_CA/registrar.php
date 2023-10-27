<?php

include "../php/conexionbd.php";







if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $codmascota = $_POST['cod_mascota']; //Obtener valores del formulario
    $fechahora = $_POST['Fecha_Hora_Cita'];
    $veterinario = $_POST['veterinario'];
    $estado= $_POST['estado'];
    $descripcion = $_POST['descripcion'];






    $consulta= "INSERT into citas (cod_Mascota,Fecha_Hora_Cita,ID_Veterinario,Estado_Cita,Desc_Cita) VALUES('$codmascota', '$fechahora','$veterinario', '$estado', '$descripcion');";

    $conn->query( $consulta); //Ejecutar consulta

    header('Location: ../Vistas/Vistas_Admin/Vistas_Citas/Citas_Admin.php '); 
    exit();
       

   
    
}



?>