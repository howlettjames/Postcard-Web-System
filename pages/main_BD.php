<?php
    include("./configBD.php");

    $correo = $_SESSION["correo"];

    if(strcmp($_SESSION["admin"], "true") == 0)
        $tabla = "admin";
    else
        $tabla = "usuario";

    $sqlInfUsuario = "SELECT * FROM $tabla WHERE correo = '$correo'";
    $resInfUsuario = mysqli_query($conexion, $sqlInfUsuario);
    $infUsuario = mysqli_fetch_row($resInfUsuario);

    $nombre = $infUsuario[0];
    $genero = $infUsuario[2];
    $fechanac = $infUsuario[3];

    if(file_exists("./../fotos/$correo.jpg"))
        $foto = "./../fotos/$correo.jpg";
    else
        $foto = "./../fotos/$correo.png";
?>