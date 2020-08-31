<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require './vendor/autoload.php';

session_start();
if(isset($_SESSION["correo"]))
{
    include("./main_BD.php");
    $postal = $_REQUEST["postal"];
    $correo_dest = $_REQUEST["correo_dest"];
    $dedicatoria = $_REQUEST["dedicatoria"];
    $nombre_dest = $_REQUEST["nombre_dest"];
    $caption = $_REQUEST["caption"];
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // SMTP::DEBUG_OFF = off (for production use)
    // SMTP::DEBUG_CLIENT = client messages
    // SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption mechanism to use - STARTTLS or SMTPS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'jamesf6888@gmail.com';
    //Password to use for SMTP authentication
    $mail->Password = '';
    //Set who the message is to be sent from
    $mail->setFrom('jamesf6888@gmail.com', 'WORM Postals');
    //Set an alternative reply-to address
    $mail->addReplyTo('jamesf6888@gmail.com', 'WORM Postals');
    //Set who the message is to be sent to
    $mail->addAddress($correo_dest, $nombre_dest);
    //Set the subject line
    $mail->Subject = "Hola ".$nombre_dest." soy ".$nombre." te he enviado esta postal";
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    
    //Content
    $mail->isHTML(true);
    $mail->Body = 
    '
        <h3>Caption: '.$caption.'</h3>
        <h3>Dedicatoria: '.$dedicatoria.'</h3>
        <h3>Mi correo es: '.$correo.'</h3>
    ';    
    $mail->AltBody = 'Texto alternativo del correo en caso de no soporte';
    // //Attach an image file
    $mail->addAttachment('./../cards/todas/'.$postal); // Se puede usar n veces igual que addAddress
    $mail->addAttachment('./../pdfs/mpdf.pdf'); // Se puede usar n veces igual que addAddress
    //send the message, check for errors
    
    $respAX = array();
    if(!$mail->send())
    {
        $respAX["val"] = 0;
        $respAX["msj"] = "<h5 class='center-align'>Hubo un problema al enviar el correo. Por favor, intente de nuevo</h5>";
        // echo 'Mailer Error: '. $mail->ErrorInfo;
    } 
    else
    {
        if(strpos($postal, "amistad") !== false)
            $categoria = "amistad";
        else if(strpos($postal, "amor") !== false)
            $categoria = "amor";
        else if(strpos($postal, "cumpleanos") !== false)
            $categoria = "cumpleanos";
        else if(strpos($postal, "festivos") !== false)
            $categoria = "festivos";
        
        $sqlInsertPostal = "INSERT INTO bandeja_salida VALUES('$correo', '$correo_dest', '$nombre_dest', '$dedicatoria', '$postal', '$categoria', NOW());";
        $resInsertPostal = mysqli_query($conexion, $sqlInsertPostal);
        $filasAfectadasInsertPostal = mysqli_affected_rows($conexion);
        $msjError = mysqli_error($conexion);

        if($filasAfectadasInsertPostal == 1)
        {
            $sqlInsertPostal = "INSERT INTO bandeja_entrada VALUES('$correo_dest', '$correo', '$nombre', '$dedicatoria', '$postal', NOW());";
            $resInsertPostal = mysqli_query($conexion, $sqlInsertPostal);
            $filasAfectadasInsertPostal = mysqli_affected_rows($conexion);
            $msjError = mysqli_error($conexion);

            if($filasAfectadasInsertPostal == 1)
            {
                $respAX["val"] = 1;
                $respAX["msj"] = "<h5 class='center-align'>Se ha enviado la postal correctamente</h5>";
            }
            else
            {
                $respAX["val"] = 0;
                $respAX["msj"] = "<h5 class='center-align'>Se produj&oacute un error al. Favor de intentarlo de nuevo.2</h5>";
            }
        }
        else
        {
            $respAX["val"] = 0;
            $respAX["msj"] = "<h5 class='center-align'>Se produj&oacute un error al. Favor de intentarlo de nuevo.1</h5>";
        }

    }
    // header("location:./enviar_postal.php");
    echo json_encode($respAX);     
}
else
{
    header("location:./../index.html");
}