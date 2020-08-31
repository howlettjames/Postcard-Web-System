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
<title>Worm Editar Info</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<!-- CSS -->
<link href="../css/FontAwesome/css/all.min.css" rel="stylesheet">
<link href="../css/materialize.min.css" rel="stylesheet">
<link href="../css/validetta.min.css" rel="stylesheet">
<link href="../css/jquery-confirm.min.css" rel="stylesheet">
<link href="../css/misEstilos.css" rel="stylesheet">
<!-- SCRIPTS -->
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/validetta.min.js"></script>
<script src="../js/validettaLang-es-ES.js"></script>
<script src="../js/jquery-confirm.min.js"></script>
<script src="../js/editar_info.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function()
{
    let datepicker = document.querySelector(".datepicker");
    let options = { format: "yyyy-mm-dd",
                    i18n: { months: ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"],
                            weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sáb"]},
                    yearRange: 50,
                    autoClose: true
                  };
    let datepicker_instance = M.Datepicker.init(datepicker, options);
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

    <main class="valign-wrapper">
        <div class="container">
            <h4 class="center-align">Editar Informaci&oacute;n</h4>
            <div class="row">
                <div class="col s12 offset-m3">
                    <form id="editarInfoForm" autocomplete="off">
                        <div class="row">
                            <div class="col s12 m6 input-field">
                                <i class="fas fa-user prefix blue-text"></i>
                                <label for="nombre">Nombre: </label>
                                <input type="text" id="nombre" name="nombre" data-validetta="required" value="<?php echo $nombre ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 input-field">
                            <h5 class="blue-text">G&eacute;nero</h5>
                            <p>
                                <label>
                                    <input name="genero" type="radio" class="with-gap" value="Hombre" <?php if(strcmp($genero, "Hombre") == 0) { echo "checked"; }?> data-validetta="required"/>
                                    <span>Hombre</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="genero" type="radio" class="with-gap" value="Mujer" <?php if(strcmp($genero, "Mujer") == 0) { echo "checked"; }?> data-validetta="required"/>
                                    <span>Mujer</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="genero" type="radio" class="with-gap" value="Otro" <?php if(strcmp($genero, "Otro") == 0) { echo "checked"; }?>data-validetta="required"/>
                                    <span>Otro</span>
                                </label>
                            </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 input-field">
                                <i class="fas fa-birthday-cake prefix blue-text"></i>
                                <label for="fechanac">Fecha de nacimiento: </label>
                                <input type="text" class="datepicker" id="fechanac" name="fechanac" value="<?php echo $fechanac ?>" data-validetta="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 input-field">
                                <i class="fas fa-envelope prefix blue-text"></i>
                                <label for="correo_nuevo">Correo: </label>
                                <input type="text" id="correo_nuevo" name="correo_nuevo" value="<?php echo $correo ?>" data-validetta="required,email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 input-field">
                                <i class="fas fa-key prefix blue-text"></i>
                                <label for="contrasena">Contrasena: </label>
                                <input type="password" id="contrasena" name="contrasena">
                                <span class="helper-text">*No es necesario cambiarla</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 input-field file-field">
                                <div class="btn blue">
                                    <span>Foto</span>
                                    <input type="file" name="foto" accept="image/jpeg,image/x-png">
                                </div>
                                <div class="file-path-wrapper">
                                    <i class="fa fa-image prefix blue-text"></i>
                                    <input class="file-path validate" type="text">
                                    <span class="helper-text">*No es necesario cambiarla</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 input-field">
                                <button type="submit" class="btn" style="width:100%;">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
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