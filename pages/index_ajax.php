<?php
    session_start();
    include("./configBD.php");
    include("./getPosts.php");

    if(strcmp($admin, "true") == 0)
    {
        $tabla = "admin";
        $_SESSION["admin"] = "true";
    }
    else
    {
        $tabla = "usuario";
        $_SESSION["admin"] = "false";
    }
            
    $contrasena = md5($contrasena);
    $respAX = array();
    $sqlLoginV3 = "SELECT * FROM $tabla WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $resLoginV3 = mysqli_query($conexion, $sqlLoginV3);
    $infLoginV3 = mysqli_fetch_row($resLoginV3); // Convertimos el registro a un arreglo con los campos

    // V3
    if(mysqli_num_rows($resLoginV3) == 1)
    {
        $_SESSION["correo"] = $infLoginV3[1];
        $respAX["val"] = 1;
        $respAX["msj"] = "<h5 class='center-align'> Bienvenido(a):  </h5>";
    }
    else
    {
        $respAX["val"] = 0;
        $respAX["msj"] = "<h5 class='center-align'> El usuario o contrase&ntilde;a no existen </h5>";
    }
    
    echo json_encode($respAX);
?>