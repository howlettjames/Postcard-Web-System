<?php
    session_start();
    include("./configBD.php");
    include("./getPosts.php");
    $correo = $_SESSION["correo"];
    $correo_modificado = "false";

    $respAX = array();
    if(strcmp($contrasena, "") != 0) // La contraseña se modificó
    {
        $contrasena = md5($contrasena);
        $sqlRegistro = "UPDATE usuario SET nombre = '$nombre', correo = '$correo', genero = '$genero', fechanac = '$fechanac', contrasena = '$contrasena' WHERE correo = '$correo'";
    }
    else if(strcmp($correo_nuevo, $correo) != 0) // El correo se modificó
    {
        $sqlRegistro = "UPDATE usuario SET nombre = '$nombre', correo = '$correo_nuevo', genero = '$genero', fechanac = '$fechanac' WHERE correo = '$correo';";
        $_SESSION["correo"] = $correo_nuevo;
        $correo_modificado = "true";
    }
    else
        $sqlRegistro = "UPDATE usuario SET nombre = '$nombre', correo = '$correo', genero = '$genero', fechanac = '$fechanac' WHERE correo = '$correo';";
        
    $resRegistro = mysqli_query($conexion, $sqlRegistro);
    $filasAfectadasRegistro = mysqli_affected_rows($conexion);
    $msjError = mysqli_error($conexion);

    if($filasAfectadasRegistro == 1)
    {
        $respAX["val"] = 1;
        $respAX["msj"] = "<h5 class='center-align'>Se actulizaron correctamente sus datos</h5>";    
        if(strcmp($correo_modificado, "true") == 0)
        {
            // RENAMING EXISTING PHOTO
            if(file_exists("./../fotos/$correo.jpg"))
            {
                if(rename("/opt/lampp/htdocs/TW/Proyecto/fotos/$correo.jpg", "/opt/lampp/htdocs/TW/Proyecto/fotos/$correo_nuevo.jpg"))
                    $respAX["msj"] .= "<h5 class='center-align'>Se actualiz&oacute; el correo tambi&eacute;n</h5>";
                else
                    $respAX["msj"] .= "<h5 class='center-align'>No pudo actualizarse el correo</h5>";
            }
            else
            {
                if(rename("/opt/lampp/htdocs/TW/Proyecto/fotos/$correo.png", "/opt/lampp/htdocs/TW/Proyecto/fotos/$correo_nuevo.png"))
                    $respAX["msj"] .= "<h5 class='center-align'>Se actualiz&oacute; el correo tambi&eacute;n</h5>";
                else
                    $respAX["msj"] .= "<h5 class='center-align'>No pudo actualizarse el correo</h5>";
            }        
            $correo = $correo_nuevo; // This is in case the photo was edited also, because var $ correo is used later
        }    
        if(strcmp($_FILES["foto"]["name"], "") != 0) // Se actualizó la foto además de los datos
        {
            $dirFoto = "../fotos/";
            $archFoto = $dirFoto.basename($_FILES["foto"]["name"]);
            $extFoto = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
            $destFoto = $dirFoto.$correo.".".$extFoto;
            // DELETING EXISTING PHOTO
            if(file_exists("./../fotos/$correo.jpg"))
                unlink("./../fotos/$correo.jpg");
            else
                unlink("./../fotos/$correo.png");

            if(move_uploaded_file($_FILES["foto"]["tmp_name"], $destFoto))
                $respAX["msj"] .= "<h5 class='center-align'>La foto se actualiz&oacute; correctamente</h5>";
            else
                $respAX["msj"] .= "<h5 class='center-align'>No se pudo actualizar la foto</h5>";
        }
    }
    else if($filasAfectadasRegistro == 0) // Solo se editó la foto
    {    
        $dirFoto = "../fotos/";
        $archFoto = $dirFoto.basename($_FILES["foto"]["name"]);
        $extFoto = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $destFoto = $dirFoto.$correo.".".$extFoto;
        // DELETING EXISTING FOTO
        if(file_exists("./../fotos/$correo.jpg"))
            unlink("./../fotos/$correo.jpg");
        else
            unlink("./../fotos/$correo.png");

        if(move_uploaded_file($_FILES["foto"]["tmp_name"], $destFoto))
        {
            $respAX["val"] = 1;
            $respAX["msj"] = "<h5 class='center-align'>La foto se actualiz&oacute; correctamente</h5>";
        }
        else
        {
            $respAX["val"] = 0;
            $respAX["msj"] = "<h5 class='center-align'>No se pudo actualizar la foto</h5>";
        }
    }
    else
    {
        $respAX["val"] = 0;
        $respAX["msj"] = "<h5 class='center-align'>Se produj&oacute un error. Favor de intentarlo de nuevo</h5>";
    }
    
    echo json_encode($respAX);
?>