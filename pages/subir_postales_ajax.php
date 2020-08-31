<?php
    include("./configBD.php");
    include("./getPosts.php");

    $respAX = array();
    // PREPARANDO DESTINO Y NOMBRE DE LA POSTAL EN SU RESPECTIVA CATEGORIA
    $dirPostal = "./../cards/".$categoria."/";
    $fi = new FilesystemIterator($dirPostal, FilesystemIterator::SKIP_DOTS);
    $numberOfPostal = iterator_count($fi);
    $numberOfPostal++;
    $extPostal = pathinfo($_FILES["postal"]["name"], PATHINFO_EXTENSION);
    $namePostal = $numberOfPostal."_".$categoria.".".$extPostal;
    $destPostal = $dirPostal.$namePostal;
    // SUBIENDO POSTAL A SU CATEGORIA
    if(move_uploaded_file($_FILES["postal"]["tmp_name"], $destPostal))
    {
        // PREPARANDO DESTINO Y NOMBRE DE LA POSTAL EN DIRECTORIO "TODAS"
        $destPostalAlt = "./../cards/todas/".$numberOfPostal."_".$categoria.".".$extPostal;
        copy($destPostal, $destPostalAlt);
        // SUBIENDO A LA BD
        $sqlPostalNueva = "INSERT INTO postal VALUES('$namePostal', '$caption', '$categoria', NOW());";
        $resPostalNueva = mysqli_query($conexion, $sqlPostalNueva);
        $filasAfectadas = mysqli_affected_rows($conexion);

        if($filasAfectadas == 1)
        {
            $respAX["val"] = 1;
            $respAX["msj"] = "<h5 class='center-align'>La postal se guard&oacute; correctamente</h5>";
        }
        else
        {
            $respAX["val"] = 0;
            $respAX["msj"] = "<h5 class='center-align'>No se pudo guardar la postal en la BD</h5>";
        }
        
    }
    else
    {
        $respAX["val"] = 0;
        $respAX["msj"] = "<h5 class='center-align'>No se pudo guardar la postal en el directorio.</h5>";
    }
        
    echo json_encode($respAX);
?>