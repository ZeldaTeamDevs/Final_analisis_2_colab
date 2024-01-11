<?php

include "../php/conexionbd.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){


    //lo que esta entre corchetes es el nombre de los campos en el form
    $email = $_POST['correo'];
    $password = $_POST['password'];


    


    //Consulta sql para obtener el id de usuario y verificar si existe
    
    $sql= "SELECT id_Usuario from tb_usuario WHERE Correo='$email' AND Contraseña='$password'";
    $resultado= $conn->query($sql); //Ejecutar consulta


    if($resultado->num_rows==1){ //Si existe el usuario ingresa

        $row=  $resultado->fetch_assoc();

        $id = $row["id_Usuario"]; //obtener el id del usuario 


        //Verificar el nivel del usuario para redirigirlo a la pagina correspondiente

        //Consulta sql para obtener el nivel del usuario 
        $sql_nivel= "SELECT Nivel from tb_usuario WHERE id_Usuario='$id'";

        $res_nivel= $conn->query($sql_nivel); //Ejecutar consulta

        if($res_nivel->num_rows==1){

            $fila = $res_nivel->fetch_assoc();
            $nivel_usuario= $fila["Nivel"];


            if($nivel_usuario==1){
                header('Location: ../Vistas/Vistas_Admin/Inicio_Admin.php '); // Redirigir a la pagina de inicio de usuario
                exit();

            }else if($nivel_usuario==2){

                header('Location: ../Vistas/inicio_Usuario.php '); // Redirigir a la pagina de inicio de usuario
                exit();

            }


        }
        
    }else{

        $_SESSION['error_login'] = "Los datos ingresados no son válidos";
        header('Location: ../Vistas/Vistas_Login/login.php '); // Redirigir al formulario
        exit();


    }
   
}



?>