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
<title>WORM MAIN</title>
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
<script src="./../js/eliminar_postales.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    // SIDENAVS
    let sidenavs = document.querySelector(".sidenav");
    let sidenav_instances = M.Sidenav.init(sidenavs);
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
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><a href="./main.php">Men&uacute;</a></li>
                </ul>
            </div>
        </nav>
    </header>
    
    <main>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red" href="./subir_postales.php">
                <i class="large material-icons">add</i>
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
                            echo 
                            '<div class="col s12 m3">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="./../cards/todas/'.$postalInf[0].'" width="50" height="200">
                                        <a hreflang="'.$postalInf[0].'" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">remove</i></a>
                                    </div>
                                    <div class="card-content">
                                        <strong class="blue-text">'.$postalInf[1].'</strong>
                                        <br><br>
                                        <i>'.$postalInf[2].'</i>
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

    <div class="footer-copyright teal darken-1">
    <footer class="page-footer teal">
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