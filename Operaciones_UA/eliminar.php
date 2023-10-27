<?php

include "../php/conexionbd.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $idusuario= $_POST['id'];


    $consulta= "DELETE FROM tb_usuario WHERE id_Usuario= '$idusuario'";

    $conn->query( $consulta); //Ejecutar consulta

    header('Location: ../Vistas/Vistas_Admin/Vistas_Usuarios/Usuarios_Admin.php '); 
    exit();
       
}


?>