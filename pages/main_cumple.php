<?php
    session_start();
    if(isset($_SESSION["correo"])){
        include("./main_BD.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>WORM MAIN CUMPLE</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<!-- CSS -->
<link href="./../css/FontAwesome/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="./../css/materialize.min.css" rel="stylesheet">
<link href="./../css/validetta.min.css" rel="stylesheet">
<link href="./../css/jquery-confirm.min.css" rel="stylesheet">
<link href="./../css/misEstilos.css" rel="stylesheet">
<!-- SCRIPTS -->
<script src="./../js/jquery-3.4.1.min.js"></script>
<script src="./../js/materialize.min.js"></script>
<script src="./../js/validetta.min.js"></script>
<script src="./../js/validettaLang-es-ES.js"></script>
<script src="./../js/jquery-confirm.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    // SIDENAVS
    let sidenavs = document.querySelector(".sidenav");
    let sidenav_instances = M.Sidenav.init(sidenavs);
});
</script>
</head>
<body>
<header>
        <nav class="nav-extended">
            <div class="nav-wrapper">
                <a href="./main.php" class="brand-logo center">Worm</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><a href="#"><i class="material-icons sidenav-trigger" data-target="slide-out">menu</i></a></li>
                </ul>
            </div>
            <div class="nav-content">
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs tabs-transparent">
                            <li class="tab"><a class="active" href="./main.php">Todas</a></li>
                            <li class="tab"><a href="./main_cumple.php">Cumplea&ntilde;os</a></li>
                            <li class="tab"><a href="./main_amor.php">Amor</a></li>
                            <li class="tab"><a href="./main_amistad.php">Amistad</a></li>
                            <li class="tab"><a href="./main_festivos.php">D&iacute;as Festivos</a></li>
                        </ul>
                    </div>
                </div>
            </div>            
        </nav>
        
        <ul id="slide-out" class="sidenav">
            <li><div class="user-view">
                <div class="background">
                    <img src="./../fotos/<?php echo $foto ?>">
                </div>
                <a href="#user"><img class="circle" src="./../fotos/<?php echo $foto ?>"></a>
                <a href="#name"><span class="white-text name"><?php echo $nombre ?></span></a>
                <a href="#email"><span class="white-text email"><?php echo $correo ?></span></a>
            </div></li>
            <li><a href="./bandeja_entrada.php"><i class="material-icons">inbox</i>Bandeja Entrada</a></li>
            <li><a href="./bandeja_salida.php"><i class="material-icons">inbox</i>Bandeja Salida</a></li>
            <li><a href="./editar_info.php"><i class="material-icons">info</i>Editar Informaci&oacute;n</a></li>
            <li><a href="./cerrarSesion.php?nombreSesion=correo"><i class="material-icons">exit_to_app</i>Cerrar Sesi&oacute;n</a></li>
            <?php 
                if(strcmp($_SESSION["admin"], "true") == 0)
                {
                    echo
                    '<li><a href="./eliminar_postales.php"><i class="material-icons">burst_mode</i>Actualizar Postales</a></li>
                    <li><a href="./eliminar_usuarios.php"><i class="material-icons">person</i>Actualizar Usuarios</a></li>
                    <li><a href="./reporte.php"><i class="material-icons">category</i>Reporte</a></li>
                    <li><a href="./vista_general.php"><i class="material-icons">mail</i>Vista General de Postales</a></li>
                    ';
                }        
            ?>
        </ul>
    </header>
    
    <main>
        <div class="container">
            <div class="row">
                <?php 
                    $fi = new FilesystemIterator("./../cards/cumpleanos/", FilesystemIterator::SKIP_DOTS);
                    foreach ($fi as $postal)
                    {
                        $sqlPostal = "SELECT * FROM postal WHERE nombre = '".$postal->getFilename()."'";
                        if($resPostal = mysqli_query($conexion, $sqlPostal))
                        {
                            $postalInf = mysqli_fetch_row($resPostal);
                            echo 
                            '<div class="col s12 m3">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="./../cards/todas/'.$postal->getFilename().'" width="50" height="200">
                                    </div>
                                    <div class="card-content">
                                        <strong class="blue-text">'.$postalInf[1].'</strong>
                                    </div>
                                    <div class="card-action center">
                                        <a href="./enviar_postal.php?postal='.$postal->getFilename().'">Enviar</a>
                                    </div>
                                </div>
                            </div>';    
                            mysqli_free_result($resPostal);
                        }
                    }
                ?>
            </div>  
        </div>
    </main>

    <footer class="page-footer teal">
        <div class="footer-copyright teal darken-1">
        <div class="container">
            &copy; 2019 Worm - A Kessler Company product
            <a class="grey-text text-lighten-4 right" href="http://www.escom.ipn.mx">#Worm</a>
        </div>
        </div>
    </footer>   
</body>
</html>
<?php
    }else{
        header("location:./../index.html");
    }
?>