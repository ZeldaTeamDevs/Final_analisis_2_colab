<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../assets/css/estilo.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto Flex">
</head>
<body>

    <div class="contenedor">

        <div class="cont_imagen">
           <img src="../../assets/images/perros.png" alt="perros"> 

        </div>

        <div class="cont_form">

            <p>Bienvenido!</p>

          
            <?php

                session_start();

                // Verificar si hay un mensaje de error
                if (isset($_SESSION['error_login'])) {
                    echo '<div style="color:red">' . $_SESSION['error_login'] . '</div>';
                    unset($_SESSION['error_login']); // Limpia el mensaje de error
                }

            ?>
            

            <form action="../../consultas_login/validar_usuario.php" method="POST">

                           
            <div class="input-group">     
                <i class="bi bi-envelope" id="icono1"></i>
                <input type="email" class="textbox" name="correo" placeholder="Correo electrónico" required>
            </div>

                <br>
                
            <div class="input-group"> 
                <i class="bi bi-lock" id="icono2"></i>
                <input type="password" class="textbox" name="password" placeholder="Contraseña" required>
            </div>


          

            <button type="submit" class="boton">Iniciar Sesión</button>
           
           


            </form>

            
            <a href="./registro.php" id="btn_registro">No tengo cuenta</a>
    
        </div>

    </div>
    
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
</body>
</html>