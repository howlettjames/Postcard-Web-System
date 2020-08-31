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
<script src="./../js/eliminar_usuarios.js"></script>
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
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><a href="./main.php">Men&uacute;</a></li>
                </ul>
            </div>
        </nav>
    </header>
    
    <main>
        <div class="container">
            <div class="row">
                <?php
                    $sqlUsuarios = "SELECT * FROM usuario";
                    if($resUsuarios = mysqli_query($conexion, $sqlUsuarios))
                    {
                        $i = 0;
                        while($usuario=mysqli_fetch_row($resUsuarios))
                        {
                            if(file_exists("./../fotos/$usuario[1].jpg"))
                                $fotoUsuario = "./../fotos/$usuario[1].jpg";
                            else
                                $fotoUsuario = "./../fotos/$usuario[1].png";
                            
                            echo 
                            '<div class="col s12 m4">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="'.$fotoUsuario.'" width="50" height="200">
                                        <a hreflang="'.$usuario[1].'" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">remove</i></a>
                                    </div>
                                    <div class="card-content">
                                        <strong>'.$usuario[1].'</strong>
                                    </div>
                                </div>
                            </div>';
                        }
                        mysqli_free_result($resUsuarios);
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