<?php 
    session_start();
    include("./main_BD.php");
    $postal = $_REQUEST["postal"];
    $correo_dest = $_REQUEST["correo_dest"];
    $nombre_dest = $_REQUEST["nombre_dest"];
    $dedicatoria = $_REQUEST["dedicatoria"];
    $caption = $_REQUEST["caption"];

    // Require composer autoload
    require_once __DIR__ . '/vendor/autoload.php';
    // Create an instance of the class:
    $mpdf = new \Mpdf\Mpdf();
    
    $html = 
    "<!DOCTYPE html>
    <html>
    <body>
    
    <h1 style='text-align:center;color:orange;'>WORM POSTALES</h1>
    
    <br>
    <br>
    <br>
    
    <h2 style='text-align:center;color:tomato;'>Hola ".$nombre_dest." soy ".$nombre." te he enviado esta postal</h2>

    <h2 style='text-align:center;color:blue;'>".$caption."</h2>
    
    <br>
    <br>
    
    <img style='margin-left:180px;' src='./../cards/todas/".$postal."'>

    <br>
    <br>
    
    <h2 style='text-align:center;color:tomato;'>Dedicatoria: ".$dedicatoria."</h2>

    <br><br><br><br><br><br>
    
    <h3 style='text-align:center;color:tomato;'>Enviado a: ".$correo_dest."</h3>
    
    </body>
    </html>";

    // Write some HTML code:
    $mpdf->WriteHTML($html);
    
    // Output a PDF file directly to the browser
    $mpdf->Output("./../pdfs/mpdf.pdf", \Mpdf\Output\Destination::FILE);

    $respAX = array();
    $respAX["val"] = 1;
    $respAX["msj"] = "<h5 class='center-align'>Se pudo guardar el PDF.</h5>";
    echo json_encode($respAX);
?>