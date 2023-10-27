<?php

include "../php/conexionbd.php";




if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $idusuario= $_POST['id'];

    $nombre = $_POST['nombre']; //Obtener valores del formulario
    $email = $_POST['correo'];
    $password = $_POST['password'];
    $nivel= $_POST['nivel'];
    $codigo= $_POST['codigo'];




   
    $consulta= "UPDATE tb_usuario SET Nombre='$nombre', Correo='$email', Contraseña='$password', Nivel='$nivel', Cod_usuario= '$codigo' WHERE id_Usuario='$idusuario' ";

    $conn->query( $consulta); //Ejecutar consulta

    header('Location: ../Vistas/Vistas_Admin/Vistas_Usuarios/Usuarios_Admin.php '); 
    exit();
       

   
    
}



?>