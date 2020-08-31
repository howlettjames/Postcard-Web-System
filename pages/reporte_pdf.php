<?php 
    $best_amistad = $_REQUEST["best_amistad"];
    $best_amistad_caption = $_REQUEST["best_amistad_caption"];
    $best_amistad_veces = $_REQUEST["best_amistad_veces"];
    $best_amor = $_REQUEST["best_amor"];
    $best_amor_caption = $_REQUEST["best_amor_caption"];
    $best_amor_veces = $_REQUEST["best_amor_veces"];
    $best_cumpleanos = $_REQUEST["best_cumpleanos"];
    $best_cumpleanos_caption = $_REQUEST["best_cumpleanos_caption"];
    $best_cumpleanos_veces = $_REQUEST["best_cumpleanos_veces"];
    $best_festivos = $_REQUEST["best_festivos"];
    $best_festivos_caption = $_REQUEST["best_festivos_caption"];
    $best_festivos_veces = $_REQUEST["best_festivos_veces"];
    $best_all = $_REQUEST["best_all"];
    $best_all_caption = $_REQUEST["best_all_caption"];
    $best_all_veces = $_REQUEST["best_all_veces"];

    // Require composer autoload
    require_once __DIR__ . '/vendor/autoload.php';
    // Create an instance of the class:
    $mpdf = new \Mpdf\Mpdf();
    
    $html = 
    "
    <!DOCTYPE html>
    <html>
    <body>
    
    <h1 style='text-align:center;color:orange;'>WORM POSTALES</h1>
        
    <h3 style='text-align:center;color:tomato;'>CATEGOR&Iacute;AS</h3>
    <img style='margin-left:70px;' src='/home/james/Downloads/categorias.png' height='270' width='500'>

    <br><br><br><br><br><br>
    <h3 style='text-align:center;color:tomato;'>G&Eacute;NERO DE LOS USUARIOS</h3>
    <img style='margin-left:70px;' src='/home/james/Downloads/generos.png' height='270' width='500'>

    ";

    $mpdf->WriteHTML($html);

    $html = 
    "   
    <h3 style='text-align:center;color:tomato;'>EDADES DE LOS USUARIOS</h3>
    <img style='margin-left:70px;' src='/home/james/Downloads/edades.png' height='270' width='500'>

    <br><br><br><br><br><br>
    <h3 style='text-align:center;color:tomato;'>M&Aacute;S ENVIADA AMISTAD</h3>
    <img style='margin-left:140px;' src='./../cards/todas/".$best_amistad."' height='300' width='400'>
    <h3 style='text-align:center;color:blue;'>".$best_amistad_caption."</h3>
    <h3 style='text-align:center;color:blue;'>Veces enviada: ".$best_amistad_veces."</h3>
    ";

    $mpdf->AddPage();
    $mpdf->WriteHTML($html);

    $html =
    "
    <h3 style='text-align:center;color:tomato;'>M&Aacute;S ENVIADA AMOR</h3>
    <img style='margin-left:140px;' src='./../cards/todas/".$best_amor."' height='300' width='400'>
    <h3 style='text-align:center;color:blue;'>".$best_amor_caption."</h3>
    <h3 style='text-align:center;color:blue;'>Veces enviada: ".$best_amor_veces."</h3>
    
    <br><br><br><br><br>
    <h3 style='text-align:center;color:tomato;'>M&Aacute;S ENVIADA CUMPLEA&Ntilde;OS</h3>
    <img style='margin-left:140px;' src='./../cards/todas/".$best_cumpleanos."' height='300' width='400'>
    <h3 style='text-align:center;color:blue;'>".$best_cumpleanos_caption."</h3>
    <h3 style='text-align:center;color:blue;'>Veces enviada: ".$best_cumpleanos_veces."</h3>
    ";

    $mpdf->AddPage();
    $mpdf->WriteHTML($html);

    $html = 
    "
    <h3 style='text-align:center;color:tomato;'>M&Aacute;S ENVIADA D&Iacute;AS FESTIVOS</h3>
    <img style='margin-left:140px;' src='./../cards/todas/".$best_festivos."' height='300' width='400'>
    <h3 style='text-align:center;color:blue;'>".$best_festivos_caption."</h3>
    <h3 style='text-align:center;color:blue;'>Veces enviada: ".$best_festivos_veces."</h3>
    
    <br><br><br><br><br>
    <h3 style='text-align:center;color:tomato;'>M&Aacute;S ENVIADA DE TODAS</h3>
    <img style='margin-left:140px;' src='./../cards/todas/".$best_all."' height='300' width='400'>
    <h3 style='text-align:center;color:blue;'>".$best_all_caption."</h3>
    <h3 style='text-align:center;color:blue;'>Veces enviada: ".$best_all_veces."</h3>
    
    </body>
    </html>
    ";
    
    $mpdf->AddPage();
    $mpdf->WriteHTML($html);
    
    // Output a PDF file directly to the browser
    // $mpdf->Output("./../pdfs/mpdf.pdf", \Mpdf\Output\Destination::FILE);
    $mpdf->Output();
?>