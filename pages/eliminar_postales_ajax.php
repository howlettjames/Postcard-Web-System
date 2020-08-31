<?php
    include("./configBD.php");
    $postal = $_REQUEST["postal"];
    $respAX = array(); 

    if(strpos($postal, "amistad") !== false)
        unlink("./../cards/amistad/$postal");
    else if(strpos($postal, "amor") !== false)
        unlink("./../cards/amor/$postal"); 
    else if(strpos($postal, "cumpleanos") !== false)
        unlink("./../cards/cumpleanos/$postal");
    else if(strpos($postal, "festivos") !== false)
        unlink("./../cards/festivos/$postal");

    unlink("./../cards/todas/$postal");
    if(file_exists("./../cards/todas/$postal")) // COMPROBANDO QUE SE BORRÓ DEL DIRECTORIO 'TODAS'
    {                   
        $respAX["val"] = 0;
        $respAX["msj"] = "<h5 class='center-align'>Ocurri&oacute; un problema, intente de nuevo, por favor</h5>";
    }
    else
    {
        $sqlPostal = "DELETE FROM postal WHERE nombre = '$postal'";
        if($resPostal = mysqli_query($conexion, $sqlPostal))
        {
            $respAX["val"] = 1;
            $respAX["msj"] = "<h5 class='center-align'>Se pudo eliminar la postal con &eacute;xito</h5>";                
        }
    }
        
    echo json_encode($respAX);
?>