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
<title>WORM VG</title>
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
    // FIXED BUTTON
    let fixed_btn = document.querySelectorAll(".fixed-action-btn");
    let fixed_btn_instance = M.FloatingActionButton.init(fixed_btn);
});
</script>
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
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red" href="./vista_general_pdf.php">
                <i class="large material-icons">picture_as_pdf</i>
            </a>
        </div>
        <div class="container">
            <div class="row">
                <?php 
                    $fi = new FilesystemIterator("./../cards/todas/", FilesystemIterator::SKIP_DOTS);
                    foreach ($fi as $postal)
                    {
                        $sqlPostal = "SELECT * FROM postal WHERE nombre = '".$postal->getFilename()."'";
                        if($resPostal = mysqli_query($conexion, $sqlPostal))
                        {
                            $postalInf = mysqli_fetch_row($resPostal);
                            $sqlPostalVEnviada = "SELECT COUNT(*) FROM bandeja_salida WHERE postal = '".$postal->getFilename()."'";
                            if($resPostalVEnviada = mysqli_query($conexion, $sqlPostalVEnviada))
                            {
                                $postalVEnviada = mysqli_fetch_row($resPostalVEnviada)[0];
                                echo 
                                '<div class="col s12 m4 l3">
                                    <div class="card">
                                        <div class="card-image">
                                            <img src="./../cards/todas/'.$postal->getFilename().'" width="50" height="200">
                                        </div>
                                        <div class="card-content">
                                            <span class="card-title activator blue-text"><i class="material-icons right">more_vert</i></span>
                                            <p class="blue-text"><strong>'.$postalInf[1].'</strong></p>
                                        </div>
                                        <div class="card-reveal">
                                            <span class="card-title blue-text"><strong>'.$postalInf[1].'</strong><i class="material-icons right">close</i></span>
                                            <p>Categor&iacute;a: <i class="blue-text">'.$postalInf[2].'</i></p>
                                            <p>Veces enviada: <i class="blue-text">'.$postalVEnviada.'</i></p>
                                            <p>Fecha creaci&oacute;n: <i class="blue-text">'.$postalInf[3].'</i></p>
                                            <p>Archivo: <i class="blue-text">'.$postalInf[0].'</i></p>
                                        </div>
                                    </div>
                                </div>';
                                mysqli_free_result($resPostalVEnviada);
                            }
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