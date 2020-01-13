<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);
    
    $orden_pedido="375463992";
    $first_name ='Carlos';
    $lastname = 'Paredes';
    $monto_pedido="$343.223";
    $ultimos_digitos='6653';
    $fecha_pedido="23-02-20";
    $number_night="3";
    $fecha_in="23-02-20";
    $fecha_out="26-02-20";
    $tipo_hab="ROOMATTES";
    
    $datos_res ='<div class="logo"><img src="https://www.outdoorpatagonia.cl/img/outdoor_logo_black.png"><p>Bienvenido a la Patagonia</p></div><style>.logo{display: flex;align-items: center;}.logo p{margin-left: 10px;}.logo img{display: flex;width: 80px;height: 25px;}</style><br>'.
                '<h2>Hemos recibido con exito la cancelacion de tu reserva</h2><br><br>'.
                '<b>Orden de reserva numero:</b> '.$orden_pedido.'<br><br>'.
                '<b>ID de reserva:</b> '.$orden_pedido.'<br><br>'.
                '<b>Titular de reserva:</b> '.$first_name.' '.$lastname.'<br><br>'.
                '<b>Pago realizado:</b> '.$monto_pedido.'<br><br>'.
                '<b>Ultimos 4 digitos:</b> '.$ultimos_digitos.'<br><br>'.
                '<b>Fecha de Reserva:</b> '.$fecha_pedido. '<br><br>'.
                '<b>Numero de Noches reservadas:</b> '.$number_night. '<br><br>'.
                '<b>Check in: </b>'.$fecha_in.'<br><br>'.
                '<b>Check Out: </b>'.$fecha_out.'<br><br>'.
                '<b>Habitacion: </b>'.$tipo_hab.'<br><br>';
                
                
try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.outdoorpatagonia.cl';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'postmaster@outdoorpatagonia.cl';                     // SMTP username
    $mail->Password   = 'gVN1-p@0QtOl19';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('postmaster@outdoorpatagonia.cl', 'Reservas');
    $mail->addAddress('charly@facocero.cl', 'Carlos Paredes');     // Add a recipient
    $mail->addAddress('fflores@facocero.cl');               // Name is optional
    $mail->addAddress('rparedes@facocero.cl');
    $mail->addAddress('cparedes.escobar@gmail.com');
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    
             
    $mail->Subject = 'Reserva generada automaticamente desde OutdoorPatagonia N:'.$orden_pedido;
    $mail->Body    = $datos_res;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mensaje enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
}


?>