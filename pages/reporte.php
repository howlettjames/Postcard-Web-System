<?php
    session_start();
    if(isset($_SESSION["correo"]))
    {
        include("./main_BD.php");
        include("./report_queries_BD.php");
        unlink("/home/james/Downloads/categorias.png");
        unlink("/home/james/Downloads/generos.png");
        unlink("/home/james/Downloads/edades.png");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>WORM REPORT</title>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function()
{
    // FIXED BUTTON
    let fixed_btn = document.querySelectorAll(".fixed-action-btn");
    let fixed_btn_instance = M.FloatingActionButton.init(fixed_btn);
    // TODO LO DEMAS
    let already_called_categorias = false;
    let already_called_generos = false;
    let already_called_edades = false;
        
    function done_categorias()
    {
        if(!already_called_categorias)
        {
            let categoriasChart64 = categoriasChart.toBase64Image();
            document.getElementById("descargarCategorias").href = categoriasChart64;
            document.getElementById("descargarCategorias").click();        
        }
        already_called_categorias = true;
    }
    function done_generos()
    {
        if(!already_called_generos)
        {
            let generosChart64 = generosChart.toBase64Image();
            document.getElementById("descargarGeneros").href = generosChart64;
            document.getElementById("descargarGeneros").click();        
        }
        already_called_generos = true;
    }
    function done_edades()
    {
        if(!already_called_edades)
        {
            let edadesChart64 = categoriasChart.toBase64Image();
            document.getElementById("descargarEdades").href = edadesChart64;
            document.getElementById("descargarEdades").click();        
        }
        already_called_edades = true;
    }

    var categoriasCanvas = document.getElementById('categoriasCanvas').getContext('2d');
    var categoriasChart = new Chart(categoriasCanvas, {
        type: 'bar',
        data: {
            labels: ['Amistad', 'Amor', 'Cumpleaños', 'Festivos'],
            datasets: [{
                label: 'Categorías más gustadas',
                backgroundColor: ['green', 'red', 'yellow', 'blue'],
                borderColor: 'black',
                borderWidth: 0.5,
                data: [<?php echo $no_amistad?>, <?php echo $no_amor?>, <?php echo $no_cumple?>, <?php echo $no_festivos?>],
            }]
        },
        options: 
        {
            bezierCurve: false,
            animation: {onComplete: done_categorias}, 
            scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
        }
    });

    var generosCanvas = document.getElementById('generosCanvas').getContext('2d');
    var generosChart = new Chart(generosCanvas, {
        type: 'pie',
        data: {
            labels: ['Hombres', 'Mujeres', 'Otros'],
            datasets: [{
                label: 'Géneros',
                backgroundColor: ['green', 'red', 'yellow'],
                borderColor: 'black',
                borderWidth: 0.5,
                data: [<?php echo $n_hombres?>, <?php echo $n_mujeres?>, <?php echo $n_otros?>],
            }]
        },
        options: 
        {
            bezierCurve: false,
            animation: {onComplete: done_generos}, 
            scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
        }
    });
    var edadesCanvas = document.getElementById('edadesCanvas').getContext('2d');
    var edadesChart = new Chart(edadesCanvas, {
        type: 'bar',
        data: {
            labels: ['0-20', '21-40', '41-60', '61-80'],
            datasets: [{
                label: 'Edades',
                backgroundColor: ['green', 'red', 'yellow', 'blue'],
                borderColor: 'black',
                borderWidth: 0.5,
                data: [<?php echo $n_ninos?>, <?php echo $n_jovenes?>, <?php echo $n_adultos?>, <?php echo $n_ancianos?>],
            }]
        },
        options: 
        {
            bezierCurve: false,
            animation: {onComplete: done_edades}, 
            scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
        }
    });   
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
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red" href="./reporte_pdf.php?
            best_amistad=<?php echo $best_amistadInf[0]?>
            &best_amistad_caption=<?php echo $best_amistadInf[1]?>
            &best_amistad_veces=<?php echo $best_amistad_veces?>
            &best_amor=<?php echo $best_amorInf[0]?>
            &best_amor_caption=<?php echo $best_amorInf[1]?>
            &best_amor_veces=<?php echo $best_amor_veces?>
            &best_cumpleanos=<?php echo $best_cumpleanosInf[0]?>
            &best_cumpleanos_caption=<?php echo $best_cumpleanosInf[1]?>
            &best_cumpleanos_veces=<?php echo $best_cumpleanos_veces?>
            &best_festivos=<?php echo $best_festivosInf[0]?>
            &best_festivos_caption=<?php echo $best_festivosInf[1]?> 
            &best_festivos_veces=<?php echo $best_festivos_veces?>
            &best_all=<?php echo $best_allInf[0]?>
            &best_all_caption=<?php echo $best_allInf[1]?>
            &best_all_veces=<?php echo $best_all_veces?>
            ">
                <i class="large material-icons">picture_as_pdf</i>
            </a>
        </div>
        
        <div class="container">
            <div class="section">
            <div class="row">
                <h3 class="center blue-text">CATEGOR&Iacute;AS</h3>
                <canvas id="categoriasCanvas"></canvas>
                <a href="" download="categorias.png" id="descargarCategorias" hidden>Descargar Categorias</a>
            </div>
            </div>
            <div class="section">
                <div class="row">
                    <h3 class="center blue-text">G&Eacute;NERO DE LOS USUARIOS</h3>
                    <canvas id="generosCanvas"></canvas>
                    <a href="" download="generos.png" id="descargarGeneros" hidden>Descargar Generos</a>
                </div>
            </div>
            <div class="section">
                <div class="row">
                    <h3 class="center blue-text">EDADES DE LOS USUARIOS</h3>
                    <canvas id="edadesCanvas"></canvas>
                    <a href="" download="edades.png" id="descargarEdades" hidden>Descargar Edades</a>
                </div>
            </div>
            <div class="section">
                <div class="row">
                    <h3 class="center blue-text">POSTALES M&Aacute;S GUSTADAS</h3>
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="./../cards/todas/<?php echo $best_amistad?>">
                            </div>
                            <div class="card-content">
                                <strong class="blue-text"><?php echo $best_amistadInf[1] ?></strong>
                                <p>Postal m&aacute;s gustada de la semana en categor&iacute;a Amistad</p>
                                <p>Veces enviada: <?php echo $best_amistad_veces ?></p>
                            </div>
                            <div class="card-action">
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="./../cards/todas/<?php echo $best_amor?>">
                            </div>
                            <div class="card-content">
                                <strong class="blue-text"><?php echo $best_amorInf[1] ?></strong>
                                <p>Postal m&aacute;s gustada de la semana en categor&iacute;a Amor</p>
                                <p>Veces enviada: <?php echo $best_amor_veces ?></p>
                            </div>
                            <div class="card-action">
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="./../cards/todas/<?php echo $best_cumpleanos?>">
                            </div>
                            <div class="card-content">
                                <strong class="blue-text"><?php echo $best_cumpleanosInf[1] ?></strong>
                                <p>Postal m&aacute;s gustada de la semana en categor&iacute;a Cumplea&ntilde;os</p>
                                <p>Veces enviada: <?php echo $best_cumpleanos_veces ?></p>
                            </div>
                            <div class="card-action">
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="./../cards/todas/<?php echo $best_festivos?>">
                            </div>
                            <div class="card-content">
                                <strong class="blue-text"><?php echo $best_festivosInf[1] ?></strong>
                                <p>Postal m&aacute;s gustada de la semana en categor&iacute;a Festivos</p>
                                <p>Veces enviada: <?php echo $best_festivos_veces ?></p>
                            </div>
                            <div class="card-action">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="row">
                    <h3 class="center blue-text">POSTAL M&Aacute;S GUSTADA</h3>
                    <div class="col s12 m12">
                        <div class="card">
                            <div class="card-image">
                                <img src="./../cards/todas/<?php echo $best_all?>">
                            </div>
                            <div class="card-content center">
                                <strong class="blue-text"><?php echo $best_allInf[1] ?></strong>
                                <p>Postal m&aacute;s gustada de la semana</p>
                                <p>Veces enviada: <?php echo $best_all_veces ?></p>
                            </div>
                            <div class="card-action">
                            </div>
                        </div>
                    </div>
                </div>
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
<?php
    }else{
        header("location:./../index.html");
    }
?>