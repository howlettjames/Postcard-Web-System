<?php
    session_start();
    if(isset($_SESSION["correo"]))
    {
        include("./main_BD.php");
        $postal = $_REQUEST["postal"];
        $sqlPostal = "SELECT * FROM postal WHERE nombre = '".$postal."'";
        if($resPostal = mysqli_query($conexion, $sqlPostal))
        {
            $postalInf = mysqli_fetch_row($resPostal);
            mysqli_free_result($resPostal);
        }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>WORM ENVIO</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<!-- CSS -->
<link href="./../css/FontAwesome/css/all.min.css" rel="stylesheet">
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
<script src="./../js/enviar_postal.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    // SIDENAVS
    let sidenavs = document.querySelector(".sidenav");
    let sidenav_instances = M.Sidenav.init(sidenavs);
});
</script>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="./main.php" class="brand-logo center">Worm</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
            </ul>
        </div>
    </nav>
    
    <main class="valign-wrapper">
        <div class="container section">
            <div class="row">
                <div class="col s12 m6 push-m3">
                    <div class="card">
                        <div class="card-image">
                            <img src="./../cards/todas/<?php echo $postal?>" alt="Postal" class="responsive-img">
                        </div>
                        <div class="card-content">
                            <strong class="blue-text"><?php echo $postalInf[1] ?></strong>
                            <br><br>
                            <i><?php echo $postalInf[2] ?></i>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="row">
                <form action="./../js/enviar_postal.js" id="formEnviarPostal" autocomplete="off">
                    <div class="row">
                        <div class="col s12 m6 input-field">
                            <i class="fas fa-user prefix blue-text"></i>
                            <label for="nombre_dest">Nombre destinatario: </label>
                            <input type="text" id="nombre_dest" name="nombre_dest" data-validetta="required">
                            <input type="text" id="caption" name="caption" hidden value="<?php echo $postalInf[1] ?>">
                        </div>
                        <div class="col s12 m6 input-field">
                            <i class="fas fa-user prefix blue-text"></i>
                            <label for="correo_dest">Correo destinatario: </label>
                            <input type="email" placeholder="alguien@ejemplo.com" id="correo_dest" class="validate" name="correo_dest" data-validetta="required, email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 input-field">
                            <i class="fas fa-mail-bulk prefix blue-text"></i>
                            <label for="dedicatoria">Dedicatoria</label>
                            <textarea id="dedicatoria" name="dedicatoria" class="materialize-textarea" data-validetta=""></textarea>
                            <input type="text" id="postal" value="<?php echo $postal ?>" name="postal" hidden>
                        </div>
                    </div>
                    <div class="col s12 l4 input-field">
                        <button id="enviar" type="submit" class="btn blue" style="width:100%;">Enviar</button>
                    </div>
                </form>
            </div>
            <div class="row right">
                <!-- <div class="col s6">
                    <a href="./postal_pdf.php?dedicatoria=fuck">Descargar como PDF</a>
                </div> -->
                <div class="col s12">
                    <a href="./main.php">Regresar al Menu</a>
                </div>
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