<?php 
    include("./main_BD.php");
    // Require composer autoload
    require_once __DIR__ . '/vendor/autoload.php';
    // Create an instance of the class:
    $mpdf = new \Mpdf\Mpdf();
    
    $html = 
    "
        <!DOCTYPE html>
        <html>
        <body>
        <h1 style='text-align:center;color:orange;'>WORM POSTALES AMISTAD</h1>
    ";
    $mpdf->WriteHTML($html);
    // ----------------------------------------- ESCRIBIENDO LAS POSTALES DE AMISTAD --------------------------------
    $i = 0;
    $fi = new FilesystemIterator("./../cards/amistad/", FilesystemIterator::SKIP_DOTS);
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
                $html =
                '   
                    <br>
                    <h3 style="text-align:center;color:tomato;">'.$postalInf[1].'</h3>
                    <img style="margin-left:180px;" src="./../cards/amistad/'.$postal->getFilename().'" height="200" width="300">
                    <h5 style="text-align:center;color:blue;">Categor&iacute;a: '.$postalInf[2].'</h5>
                    <h5 style="text-align:center;color:blue;">Veces enviada: '.$postalVEnviada.'</h5>
                    <h5 style="text-align:center;color:blue;">Fecha creaci&oacute;n: '.$postalInf[3].'</h5>
                    <h5 style="text-align:center;color:blue;">Archivo: '.$postalInf[0].'</h5>
                ';
                $mpdf->WriteHTML($html);
                $i++;
                if(($i % 2) == 0)
                    $mpdf->AddPage();    
                
                mysqli_free_result($resPostalVEnviada);
            }
            mysqli_free_result($resPostal);
        }
    }
    // ----------------------------------------- ESCRIBIENDO LAS POSTALES DE AMOR --------------------------------
    $mpdf->AddPage();    
    $html = "<h1 style='text-align:center;color:orange;'>WORM POSTALES AMOR</h1>";
    $mpdf->WriteHTML($html);
    $i = 0;
    $fi = new FilesystemIterator("./../cards/amor/", FilesystemIterator::SKIP_DOTS);
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
                $html =
                '   
                    <br>
                    <h3 style="text-align:center;color:tomato;">'.$postalInf[1].'</h3>
                    <img style="margin-left:180px;" src="./../cards/amor/'.$postal->getFilename().'" height="200" width="300">
                    <h5 style="text-align:center;color:blue;">Categor&iacute;a: '.$postalInf[2].'</h5>
                    <h5 style="text-align:center;color:blue;">Veces enviada: '.$postalVEnviada.'</h5>
                    <h5 style="text-align:center;color:blue;">Fecha creaci&oacute;n: '.$postalInf[3].'</h5>
                    <h5 style="text-align:center;color:blue;">Archivo: '.$postalInf[0].'</h5>
                ';
                $mpdf->WriteHTML($html);
                $i++;
                if(($i % 2) == 0)
                    $mpdf->AddPage();    
                
                mysqli_free_result($resPostalVEnviada);
            }
            mysqli_free_result($resPostal);
        }
    }
    // ----------------------------------------- ESCRIBIENDO LAS POSTALES DE CUMPLEAÑOS --------------------------------
    $mpdf->AddPage();    
    $html = "<h1 style='text-align:center;color:orange;'>WORM POSTALES CUMPLEA&Ntilde;OS</h1>";
    $mpdf->WriteHTML($html);
    $i = 0;
    $fi = new FilesystemIterator("./../cards/cumpleanos/", FilesystemIterator::SKIP_DOTS);
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
                $html =
                '   
                    <br>
                    <h3 style="text-align:center;color:tomato;">'.$postalInf[1].'</h3>
                    <img style="margin-left:180px;" src="./../cards/cumpleanos/'.$postal->getFilename().'" height="200" width="300">
                    <h5 style="text-align:center;color:blue;">Categor&iacute;a: '.$postalInf[2].'</h5>
                    <h5 style="text-align:center;color:blue;">Veces enviada: '.$postalVEnviada.'</h5>
                    <h5 style="text-align:center;color:blue;">Fecha creaci&oacute;n: '.$postalInf[3].'</h5>
                    <h5 style="text-align:center;color:blue;">Archivo: '.$postalInf[0].'</h5>
                ';
                $mpdf->WriteHTML($html);
                $i++;
                if(($i % 2) == 0)
                    $mpdf->AddPage();    
                
                mysqli_free_result($resPostalVEnviada);
            }
            mysqli_free_result($resPostal);
        }
    }
    // ----------------------------------------- ESCRIBIENDO LAS POSTALES DE DÍAS FESTIVOS --------------------------------
    $mpdf->AddPage();    
    $html = "<h1 style='text-align:center;color:orange;'>WORM POSTALES D&Iacute;AS FESTIVOS</h1>";
    $mpdf->WriteHTML($html);
    $i = 0;
    $fi = new FilesystemIterator("./../cards/festivos/", FilesystemIterator::SKIP_DOTS);
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
                $html =
                '   
                    <br>
                    <h3 style="text-align:center;color:tomato;">'.$postalInf[1].'</h3>
                    <img style="margin-left:180px;" src="./../cards/festivos/'.$postal->getFilename().'" height="200" width="300">
                    <h5 style="text-align:center;color:blue;">Categor&iacute;a: '.$postalInf[2].'</h5>
                    <h5 style="text-align:center;color:blue;">Veces enviada: '.$postalVEnviada.'</h5>
                    <h5 style="text-align:center;color:blue;">Fecha creaci&oacute;n: '.$postalInf[3].'</h5>
                    <h5 style="text-align:center;color:blue;">Archivo: '.$postalInf[0].'</h5>
                ';
                $mpdf->WriteHTML($html);
                $i++;
                if(($i % 2) == 0)
                    $mpdf->AddPage();    
                
                mysqli_free_result($resPostalVEnviada);
            }
            mysqli_free_result($resPostal);
        }
    }
    $html = 
    "
    </body>
    </html>
    ";
    $mpdf->WriteHTML($html);
    
    // Output a PDF file directly to the browser
    // $mpdf->Output("./../pdfs/mpdf.pdf", \Mpdf\Output\Destination::FILE);
    $mpdf->Output();
?>