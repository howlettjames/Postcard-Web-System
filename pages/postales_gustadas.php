<?php
    session_start();
    if(isset($_SESSION["correo"]))
    {
        include("./main_BD.php");
        $sqlAmor = "SELECT COUNT(*) FROM bandeja_salida WHERE categoria = 'amor' AND fecha > date_sub(NOW(), interval 1 week);";
        $sqlAmistad = "SELECT COUNT(*) FROM bandeja_salida WHERE categoria = 'amistad' AND fecha > date_sub(NOW(), interval 1 week);";
        $sqlCumple = "SELECT COUNT(*) FROM bandeja_salida WHERE categoria = 'cumpleanos' AND fecha > date_sub(NOW(), interval 1 week);";
        $sqlFestivos = "SELECT COUNT(*) FROM bandeja_salida WHERE categoria = 'festivos' AND fecha > date_sub(NOW(), interval 1 week);";
        
        if($resAmor = mysqli_query($conexion, $sqlAmor))
        {
            $no_amor = mysqli_fetch_row($resAmor)[0];
            mysqli_free_result($resAmor);
        }
        if($resAmistad = mysqli_query($conexion, $sqlAmistad))
        {
            $no_amistad = mysqli_fetch_row($resAmistad)[0];
            mysqli_free_result($resAmistad);
        }
        if($resCumple = mysqli_query($conexion, $sqlCumple))
        {
            $no_cumple = mysqli_fetch_row($resCumple)[0];
            mysqli_free_result($resCumple);
        }
        if($resFestivos = mysqli_query($conexion, $sqlFestivos))
        {
            $no_festivos = mysqli_fetch_row($resFestivos)[0];
            mysqli_free_result($resFestivos);
        }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>WORM CATEGOR&Iacute;AS</title>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function()
{
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
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

        // Configuration options go here
        options: {
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
        <div class="container">
            <div class="row">
                <canvas id="myChart"></canvas>
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