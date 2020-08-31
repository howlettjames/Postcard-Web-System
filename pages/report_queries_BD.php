<?php
    // ---------------------------- C A T E G O R I A S --------------------------------------
    $sqlAmor = "SELECT COUNT(*) FROM bandeja_salida WHERE categoria = 'amor' AND fecha > date_sub(NOW(), interval 1 week);";
    $sqlAmistad = "SELECT COUNT(*) FROM bandeja_salida WHERE categoria = 'amistad' AND fecha > date_sub(NOW(), interval 1 week);";
    $sqlCumple = "SELECT COUNT(*) FROM bandeja_salida WHERE categoria = 'cumpleanos' AND fecha > date_sub(NOW(), interval 1 week);";
    $sqlFestivos = "SELECT COUNT(*) FROM bandeja_salida WHERE categoria = 'festivos' AND fecha > date_sub(NOW(), interval 1 week);";
    
    if($resAmor = mysqli_query($conexion, $sqlAmor))
    {
        $no_amor = mysqli_fetch_row($resAmor)[0];
        mysqli_free_result($resAmor);
    }
    if($resAmistad = mysqli_query($conexion, $sqlAmistad))
    {
        $no_amistad = mysqli_fetch_row($resAmistad)[0];
        mysqli_free_result($resAmistad);
    }
    if($resCumple = mysqli_query($conexion, $sqlCumple))
    {
        $no_cumple = mysqli_fetch_row($resCumple)[0];
        mysqli_free_result($resCumple);
    }
    if($resFestivos = mysqli_query($conexion, $sqlFestivos))
    {
        $no_festivos = mysqli_fetch_row($resFestivos)[0];
        mysqli_free_result($resFestivos);
    }
    // ---------------------------- P O S T A L E S  --------------------------------------
    $best_all = "";
    $n_best_all = "";
    // HALLANDO LA POSTAL MAS ENVIADA DE AMISTAD
    $first_postal_n = 0;
    $first_postal_name = "";
    $fi = new FilesystemIterator("./../cards/amistad/", FilesystemIterator::SKIP_DOTS);
    foreach ($fi as $postal)
    {
        $sqlPostal = "SELECT COUNT(*) FROM bandeja_salida WHERE postal = '".$postal->getFilename()."' AND fecha > date_sub(NOW(), interval 1 week);";
        if($resPostal = mysqli_query($conexion, $sqlPostal))
        {
            $no_postal = mysqli_fetch_row($resPostal)[0];
            if($no_postal > $first_postal_n)
            {
                $first_postal_n = $no_postal;
                $first_postal_name = $postal->getFilename();
            }
            mysqli_free_result($resPostal);
        }    
    }
    $best_amistad = $first_postal_name;
    $best_all = $best_amistad;
    $n_best_all = $first_postal_n;
    // HALLANDO LAS VECES QUE SE COMPARTIÓ LA POSTAL MÁS GUSTADA DE AMISTAD DE LA SEMANA
    $sqlPostal = "SELECT COUNT(*) FROM bandeja_salida WHERE postal = '".$best_amistad."' AND fecha > date_sub(NOW(), interval 1 week);";
    if($resPostal = mysqli_query($conexion, $sqlPostal))
    {
        $best_amistad_veces = mysqli_fetch_row($resPostal)[0];
        mysqli_free_result($resPostal);
    }
    // HALLANDO LA POSTAL MAS ENVIADA DE AMOR
    $first_postal_n = 0;
    $first_postal_name = "";
    $fi = new FilesystemIterator("./../cards/amor/", FilesystemIterator::SKIP_DOTS);
    foreach ($fi as $postal)
    {
        $sqlPostal = "SELECT COUNT(*) FROM bandeja_salida WHERE postal = '".$postal->getFilename()."' AND fecha > date_sub(NOW(), interval 1 week);";
        if($resPostal = mysqli_query($conexion, $sqlPostal))
        {
            $no_postal = mysqli_fetch_row($resPostal)[0];
            if($no_postal > $first_postal_n)
            {
                $first_postal_n = $no_postal;
                $first_postal_name = $postal->getFilename();
            }
            mysqli_free_result($resPostal);
        }    
    }
    $best_amor = $first_postal_name;
    if($first_postal_n > $n_best_all)
    {
        $n_best_all = $first_postal_n;
        $best_all = $best_amor;
    }
    // HALLANDO LAS VECES QUE SE COMPARTIÓ LA POSTAL MÁS GUSTADA DE AMOR DE LA SEMANA
    $sqlPostal = "SELECT COUNT(*) FROM bandeja_salida WHERE postal = '".$best_amor."' AND fecha > date_sub(NOW(), interval 1 week);";
    if($resPostal = mysqli_query($conexion, $sqlPostal))
    {
        $best_amor_veces = mysqli_fetch_row($resPostal)[0];
        mysqli_free_result($resPostal);
    }
    // HALLANDO LA POSTAL MAS ENVIADA DE CUMPLEANOS
    $first_postal_n = 0;
    $first_postal_name = "";
    $fi = new FilesystemIterator("./../cards/cumpleanos/", FilesystemIterator::SKIP_DOTS);
    foreach ($fi as $postal)
    {
        $sqlPostal = "SELECT COUNT(*) FROM bandeja_salida WHERE postal = '".$postal->getFilename()."' AND fecha > date_sub(NOW(), interval 1 week);";
        if($resPostal = mysqli_query($conexion, $sqlPostal))
        {
            $no_postal = mysqli_fetch_row($resPostal)[0];
            if($no_postal > $first_postal_n)
            {
                $first_postal_n = $no_postal;
                $first_postal_name = $postal->getFilename();
            }
            mysqli_free_result($resPostal);
        }    
    }
    $best_cumpleanos = $first_postal_name;
    if($first_postal_n > $n_best_all)
    {
        $n_best_all = $first_postal_n;
        $best_all = $best_cumpleanos;
    }
    // HALLANDO LAS VECES QUE SE COMPARTIÓ LA POSTAL MÁS GUSTADA DE CUMPLEAÑOS DE LA SEMANA
    $sqlPostal = "SELECT COUNT(*) FROM bandeja_salida WHERE postal = '".$best_cumpleanos."' AND fecha > date_sub(NOW(), interval 1 week);";
    if($resPostal = mysqli_query($conexion, $sqlPostal))
    {
        $best_cumpleanos_veces = mysqli_fetch_row($resPostal)[0];
        mysqli_free_result($resPostal);
    }
    // HALLANDO LA POSTAL MAS ENVIADA DE FESTIVOS
    $first_postal_n = 0;
    $first_postal_name = "";
    $fi = new FilesystemIterator("./../cards/festivos/", FilesystemIterator::SKIP_DOTS);
    foreach ($fi as $postal)
    {
        $sqlPostal = "SELECT COUNT(*) FROM bandeja_salida WHERE postal = '".$postal->getFilename()."' AND fecha > date_sub(NOW(), interval 1 week);";
        if($resPostal = mysqli_query($conexion, $sqlPostal))
        {
            $no_postal = mysqli_fetch_row($resPostal)[0];
            if($no_postal > $first_postal_n)
            {
                $first_postal_n = $no_postal;
                $first_postal_name = $postal->getFilename();
            }
            mysqli_free_result($resPostal);
        }    
    }
    $best_festivos = $first_postal_name;
    if($first_postal_n > $n_best_all)
    {
        $n_best_all = $first_postal_n;
        $best_all = $best_festivos;
    }
    // HALLANDO LAS VECES QUE SE COMPARTIÓ LA POSTAL MÁS GUSTADA DE AMISTAD DE LA SEMANA
    $sqlPostal = "SELECT COUNT(*) FROM bandeja_salida WHERE postal = '".$best_festivos."' AND fecha > date_sub(NOW(), interval 1 week);";
    if($resPostal = mysqli_query($conexion, $sqlPostal))
    {
        $best_festivos_veces = mysqli_fetch_row($resPostal)[0];
        mysqli_free_result($resPostal);
    }
    // HALLANDO LAS VECES QUE SE COMPARTIÓ LA POSTAL MÁS GUSTADA DE LA SEMANA
    $sqlPostal = "SELECT COUNT(*) FROM bandeja_salida WHERE postal = '".$best_all."' AND fecha > date_sub(NOW(), interval 1 week);";
    if($resPostal = mysqli_query($conexion, $sqlPostal))
    {
        $best_all_veces = mysqli_fetch_row($resPostal)[0];
        mysqli_free_result($resPostal);
    }
    // ---------------------------- OBTENIENTO INFO DE LAS POSTALES MÁS GUSTADAS --------------------------
    $sqlBest = "SELECT * FROM postal WHERE nombre = '$best_amistad';"; 
    if($resBest = mysqli_query($conexion, $sqlBest))
    {
        $best_amistadInf = mysqli_fetch_row($resBest);
        mysqli_free_result($resBest);
    }
    $sqlBest = "SELECT * FROM postal WHERE nombre = '$best_amor';"; 
    if($resBest = mysqli_query($conexion, $sqlBest))
    {
        $best_amorInf = mysqli_fetch_row($resBest);
        mysqli_free_result($resBest);
    }
    $sqlBest = "SELECT * FROM postal WHERE nombre = '$best_cumpleanos';"; 
    if($resBest = mysqli_query($conexion, $sqlBest))
    {
        $best_cumpleanosInf = mysqli_fetch_row($resBest);
        mysqli_free_result($resBest);
    }
    $sqlBest = "SELECT * FROM postal WHERE nombre = '$best_festivos';"; 
    if($resBest = mysqli_query($conexion, $sqlBest))
    {
        $best_festivosInf = mysqli_fetch_row($resBest);
        mysqli_free_result($resBest);
    }
    $sqlBest = "SELECT * FROM postal WHERE nombre = '$best_all';"; 
    if($resBest = mysqli_query($conexion, $sqlBest))
    {
        $best_allInf = mysqli_fetch_row($resBest);
        mysqli_free_result($resBest);
    }
    // ---------------------------- G E N E R O  --------------------------------------
    $sqlHombres = "SELECT COUNT(*) FROM usuario WHERE genero = 'Hombre';";
    $sqlMujeres = "SELECT COUNT(*) FROM usuario WHERE genero = 'Mujer';";
    $sqlOtros = "SELECT COUNT(*) FROM usuario WHERE genero = 'Otro';"; 
    if($resHombres = mysqli_query($conexion, $sqlHombres))
    {
        $n_hombres = mysqli_fetch_row($resHombres)[0];
        mysqli_free_result($resHombres);
    }
    if($resMujeres = mysqli_query($conexion, $sqlMujeres))
    {
        $n_mujeres = mysqli_fetch_row($resMujeres)[0];
        mysqli_free_result($resMujeres);
    }
    if($resOtros = mysqli_query($conexion, $sqlOtros))
    {
        $n_otros = mysqli_fetch_row($resOtros)[0];
        mysqli_free_result($resOtros);
    }
    // ---------------------------- E D A D E S  --------------------------------------
    $sqlNinos = "SELECT COUNT(*) FROM usuario WHERE YEAR(CURDATE()) - YEAR(fechanac) BETWEEN 0 AND 20;";
    $sqlJovenes = "SELECT COUNT(*) FROM usuario WHERE YEAR(CURDATE()) - YEAR(fechanac) BETWEEN 21 AND 40;";
    $sqlAdultos = "SELECT COUNT(*) FROM usuario WHERE YEAR(CURDATE()) - YEAR(fechanac) BETWEEN 41 AND 60;";
    $sqlAncianos = "SELECT COUNT(*) FROM usuario WHERE YEAR(CURDATE()) - YEAR(fechanac) BETWEEN 61 AND 80;";   
    if($resNinos = mysqli_query($conexion, $sqlNinos))
    {
        $n_ninos = mysqli_fetch_row($resNinos)[0];
        mysqli_free_result($resNinos);
    }
    if($resJovenes = mysqli_query($conexion, $sqlJovenes))
    {
        $n_jovenes = mysqli_fetch_row($resJovenes)[0];
        mysqli_free_result($resJovenes);
    }
    if($resAdultos = mysqli_query($conexion, $sqlAdultos))
    {
        $n_adultos = mysqli_fetch_row($resAdultos)[0];
        mysqli_free_result($resAdultos);
    }
    if($resAncianos = mysqli_query($conexion, $sqlAncianos))
    {
        $n_ancianos = mysqli_fetch_row($resAncianos)[0];
        mysqli_free_result($resAncianos);
    }
?>