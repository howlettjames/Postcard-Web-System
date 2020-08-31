<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Worm Crear Cuenta</title>
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
<script src="../js/subir_postales.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() 
{
    let select = document.querySelectorAll('select');
    let select_instance = M.FormSelect.init(select);
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
            <h4 class="center-align">Subir postal nueva</h4>
            <br>
            <div class="row">
                <form id="subirPostalForm" class="col s12 offset-s3">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <label for="caption">Caption</label>
                            <input placeholder="Caption" id="caption" name="caption" type="text" data-validetta="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <select form="subirPostalForm" name="categoria">
                                <option value="ninguna" disabled selected>Elige tu opci&oacute;n</option>
                                <option value="amistad">Amistad</option>
                                <option value="amor">Amor</option>
                                <option value="cumpleanos">Cumplea&ntilde;os</option>
                                <option value="festivos">Festivos</option>
                            </select>
                            <label>Categor&iacute;a</label>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col s12 m6 input-field file-field">
                            <div class="btn blue">
                                <span>Postal</span>
                                <input type="file" name="postal" accept="image/jpeg,image/x-png" data-validetta="required">
                            </div>
                            <div class="file-path-wrapper">
                                <i class="fa fa-image prefix blue-text"></i>
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6 input-field">
                            <button type="submit" class="btn" style="width:100%;">Subir</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row right">
                <a href="./main.php">Regresar al Men&uacute;</a>
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