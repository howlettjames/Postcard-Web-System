<?php
    session_start();
    if(isset($_SESSION["correo"])){
        include("./main_BD.php");
        $sqlPostales = "SELECT * FROM bandeja_entrada WHERE correo = '$correo'";
        $postales = array();    
        if($resPostales = mysqli_query($conexion, $sqlPostales))
        {
            $i = 0;
            while($postal=mysqli_fetch_row($resPostales))
            {
                $postales[$i] = $postal;
                $i++;
            }
            mysqli_free_result($resPostales);
        }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>WORM BANDEJA ENTRADA</title>
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
</head>
<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <a href="./main.php" class="brand-logo center">Worm</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                </ul>
            </div>
        </nav>
    </header>
    
    <main>
        <div class="container">
            <div class="row">
                <?php 
                    for($i = 0; $i < count($postales); $i++)
                    {
                        $postal = $postales[$i];
                        $sqlPostal = "SELECT * FROM postal WHERE nombre = '".$postal[4]."'";
                        if($resPostal = mysqli_query($conexion, $sqlPostal))
                        {
                            $postalInf = mysqli_fetch_row($resPostal);
                            echo
                            '<div class="col s12 m4">
                                <div class="card">
                                    <div class="card-image waves-effect waves-block waves-light">
                                        <img class="activator" src="./../cards/todas/'.$postal[4].'">
                                    </div>
                                    <div class="card-content">
                                        <strong class="blue-text">'.$postalInf[1].'</strong>
                                        <span class="card-title activator"><strong>Enviado por: '.$postal[2].'</strong><i class="material-icons right">more_vert</i></span>
                                        <p>Correo: '.$postal[1].'</p>
                                        <p>Fecha envio: '.$postal[5].'</p>
                                    </div>
                                    <div class="card-reveal">
                                        <span class="card-title grey-text text-darken-4"><strong>Dedicatoria:</strong><i class="material-icons right">close</i></span>
                                        <p>'.$postal[3].'</p> 
                                    </div>
                                </div>
                            </div>';                            
                            mysqli_free_result($resPostal);
                        }
                    }
                ?>
            </div>  
            <div class="row right">
                <a href="./main.php">Regresar al Menu</a>
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