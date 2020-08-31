<?php
    include("./configBD.php");
    include("./getPosts.php");

    $respAX = array();
    $contrasena = md5($contrasena);
    $sqlRegistro = "INSERT INTO usuario VALUES('$nombre', '$correo', '$genero', '$fechanac', '$contrasena', NOW());";
    $resRegistro = mysqli_query($conexion, $sqlRegistro);
    $filasAfectadasRegistro = mysqli_affected_rows($conexion);
    $msjError = mysqli_error($conexion);

    if($filasAfectadasRegistro == 1)
    {
        $respAX["val"] = 1;
        $respAX["msj"] = "<h5 class='center-align'>Se registraron correctamente sus datos</h5>";
        $dirFoto = "../fotos/";
        $archFoto = $dirFoto.basename($_FILES["foto"]["name"]);
        $extFoto = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $destFoto = $dirFoto.$_POST["correo"].".".$extFoto;
        if(move_uploaded_file($_FILES["foto"]["tmp_name"], $destFoto))
            $respAX["msj"] .= "<h5 class='center-align'>La foto se guard&oacute; correctamente</h5>";
        else
            $respAX["msj"] .= "<h5 class='center-align'>No se pudo guardar la foto</h5>";
    }
    else if(strpos($msjError, "Duplicate") !== false)
    {
        $respAX["val"] = 0;
        $respAX["msj"] = "<h5 class='center-align'>Error: El correo ya existe</h5>";
    }
    else
    {
        $respAX["val"] = 0;
        $respAX["msj"] = "<h5 class='center-align'>Se produj&oacute un error. Favor de intentarlo de nuevo</h5>";
    }
    
    echo json_encode($respAX);
?>