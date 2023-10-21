<?php

include "../php/conexionbd.php";

session_start();

//Funcion par generar codigo de usuario
function generarCodigoUsuario() {
    $codigo = '';

    // Obtén la fecha y hora actual
    $fechaActual = getdate();

    // Obtiene el día, mes, minuto, segundo y décimas de segundo
    $dia = $fechaActual['mday'];
    $mes = $fechaActual['mon'];
    $minuto = $fechaActual['minutes'];
    $segundo = $fechaActual['seconds'];
    $decimas = floor(microtime(true) * 10) % 10;

    // Formatea los valores y crea el código de usuario
    $codigo = sprintf('%02d%02d%02d%02d%01d', $dia, $mes, $minuto, $segundo, $decimas);

    return $codigo;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nombre = $_POST['nombre']; //Obtener valores del formulario
    $email = $_POST['correo'];
    $password = $_POST['password'];


    $codigo_generado= generarCodigoUsuario(); //Generar codigo de usuario


    $consulta= "INSERT into tb_usuario (Nombre,Correo,Contraseña,Nivel,Cod_Usuario) VALUES('$nombre', '$email','$password', 2, '$codigo_generado');";

    if ($conn->query( $consulta) === TRUE) {
        $_SESSION['msg_confirmacion'] = "Su cuenta ha sido creada con éxito";
        header('Location: ../Vistas/Vistas_Login/registro.php '); 
        exit();

    } else {
        $_SESSION['msg_confirmacion'] = "Algo salió mal, intentelo de nuevo";
        header('Location: ../Vistas/Vistas_Login/registro.php '); 
        exit();
    }
}



?>