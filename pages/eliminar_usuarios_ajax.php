<?php
    include("./configBD.php");
    include("./getPosts.php");

    $respAX = array();
    
    $sqlDeleteUser = "DELETE FROM usuario WHERE correo = '$usuario_correo';";
    if(mysqli_query($conexion, $sqlDeleteUser)) // ELIMINANDO DE LA BD
    {    
        if(file_exists("./../fotos/".$usuario_correo.".jpg")) // COMPROBANDO QUE SE BORRÓ LA FOTO
        {                       
            unlink("./../fotos/".$usuario_correo.".jpg");
            $respAX["val"] = 1;
            $respAX["msj"] = "<h5 class='center-align'>Se pudo eliminar al usuario con &eacute;xito</h5>";    
        }
        else if(file_exists("./../fotos/".$usuario_correo.".png")) // COMPROBANDO QUE SE BORRÓ LA FOTO
        {                       
            unlink("./../fotos/".$usuario_correo.".png");
            $respAX["val"] = 1;
            $respAX["msj"] = "<h5 class='center-align'>Se pudo eliminar al usuario con &eacute;xito</h5>";    
        }
    }
    else 
    {
        $respAX["val"] = 0;
        $respAX["msj"] = "<h5 class='center-align'>No se pudo eliminar al usuario</h5>";    
    }
        
    echo json_encode($respAX);
?>