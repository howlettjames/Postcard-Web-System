<?php
    $servidorBD = "localhost";
    $usuarioBD = "root";
    $contrasenaBD = "";
    $nombreBD = "proyecto";
    $conexion = mysqli_connect($servidorBD, $usuarioBD, $contrasenaBD, $nombreBD);
    if(mysqli_connect_errno($conexion))
    {
        die("Problemas con la conexi&oacute;n al servidor MySQL:");
    }
    else
    {
        mysqli_query($conexion, "SET NAMES 'utf8'");
    }
?>
