<?php session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


//print_r($_POST);
//print_r ($_SESSION);

include_once('clases/producto.php');
$product = new Product();

$number_oc=$_SESSION['oc_r'];
$number_id=$_SESSION['id_r'];

//formateo de numuero a miles
function formateonumero($num){
	$new=number_format($num,'0', ',','.');
	return $new;
}


?>
<!DOCTYPE html>
<html lang="en">
<div class="wrap"></div>
<?php include("header.php");//aca va el header?>
<?php

$otherdb = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql=$otherdb->query("SELECT * FROM `transacciones` WHERE `orden_pedido` = $number_id AND `id_pedido` = $number_oc");

//evalua si se encuentra coincidencia en la bbdd
if ($sql->num_rows==0) {
  echo '

  <div class="wrap">
  <div class="container-fluid">
    <div class="row final_error">
      <div class="col-12 d-flex ">
        <span class="fas fa-times-circle mr-3"></span><h4>Transacción fallida</h4>
      </div>
      <div class="col-12">
      <h1>Orden de compra anulada por usuario o problema con Transbank</h1>
        <p>Orden de Compra '.$number_id.' rechazada</p>
        <p>Las posibles causas de este rechazo son:</p>
        <p>* Error en el ingreso de los datos de su tarjeta de Crédito o Débito (fecha y/o código de seguridad).</p>
        <p>* Su tarjeta de Crédito o Débito no cuenta con saldo suficiente.</p>
        <p>* Tarjeta aún no habilitada en el sistema financiero.</p>
      </div>
      <div class="col-12"><button class="btn btn-warning"><a href="../index.php">Volver</a></button></div> 
    </div>
  </div>
  </div>   
  
  


  ';
  die;
}
//recorre el array para traer la transaccion...
foreach ($sql->fetch_all(MYSQLI_ASSOC) as $key) {
      $responseCode     =$key['codigo_pedido'];
      $orden_pedido     =$key['orden_pedido'];
      $id_pedido        =$key['id_pedido'];
      $monto_pedido     =$key['monto_pedido'];
      $tipo_pago        =$key['tipo_pago'];
      $tipo_cuota       =$key['cantidad_cuota'];
      $fecha_pedido     =$key['fecha_pedido'];
      $ultimos_digitos  =$key['ultimos_digitos'];
      $number_room      =$key['number_room'];
      $number_night     =$key['number_night'];
      $tipo_hab         =$key['tipo_habitacion'];
      $fecha_in         =$key['fecha_in'];
      $fecha_out        =$key['fecha_out'];
      $first_name       =$key['first'];       
      $lastname         =$key['lastname'];
      $mail             =$key['mail'];  
      $phone            =$key['phone'];
      $fecha_in         =$key['fecha_in'];
      $fecha_out        =$key['fecha_out'];
      $number_night     =$key['number_night'];
      $basic            =$key['basic'];
      $infierno         =$key['infierno'];
      $duckies          =$key['duckies'];
      $flotada          =$key['flotada'];      
      $kayak            =$key['kayak'];

    }
?>
<?php if($responseCode==0) : ?>
<?php
//guarda la reserva en la tabla que realiza la consulta...
$db_save_date = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$insert_sql=$db_save_date->query("INSERT INTO `test` (`codigo_reserva`,`codigo`, `categoria`, `room`, `descripcion`, `froom`, `too`) VALUE(null, '$number_room', '$tipo_hab', '','', '$fecha_in', '$fecha_out')");
//print_r($orden_pedido);
//print_r($tipo_hab);
//print_r($number_room);
//print_r($fecha_in);
//print_r($fecha_out);
?>
<div class="wrap">
  <div class="container-fluid">
    <div class="row final-exitoso">
      <span class="fas fa-check-circle"></span> <h4>Transacción Exitosa</h4>
    </div>
  </div>
<div class="container-fluid t_fin">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-3">
            <table class="table table-striped table-bordered">
        <thead>
          <tr class="bg-warning">
            <th colspan="2"><span class="far fa-credit-card mr-1 text-dark"></span>Detalles de Pago</th>
          </tr>
          
        </thead>
        <tbody>
          <tr>
            <td>Orden de compra</td>
            <td><?php echo $orden_pedido ?></td>
          </tr>
          
          <tr>
            <td>id de Pedido</td>
            <td><?php echo $id_pedido ?></td>
          </tr>
          <tr>
            <td>Fecha de compra</td>
            <td><?php echo $fecha_pedido ?></td>
          </tr>
          <tr>
            <td>Monto de Pedido</td>
            <td>CLP $<?php echo $monto_pedido ?></td>
          </tr>
          <tr>
            <td>Tipo de Pago</td>
            <td><?php echo $tipo_pago ?></td>
          </tr>
          <tr>
            <td>Ultimos 4 digitos de Tarjeta</td>
            <td><?php echo $ultimos_digitos ?></td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="bg-primary">
                <th colspan=2><span class="fas fa-user-friends mr-2 text-dark"></span>Datos de Contacto</th>
              </tr>
            </thead>
          <tbody>
            <tr>
              <td>Nombre</td>
              <td><?php echo $first_name ?></td>
            </tr>
            <tr>
              <td>Apellido</td>
              <td><?php echo $lastname ?></td>
            </tr>
            <tr>
              <td>Mail</td>
              <td><?php echo $mail ?></td>
            </tr>
            <tr>
              <td>Telefono/Phone</td>
              <td><?php echo $phone ?></td>
            </tr>
           </tbody>
        </table>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3">
        <table class="table table-striped table-bordered">
          <thead>
            <tr class="bg-info">
              <th class="text-left" colspan="4"><span class="fas fa-bed mr-2 text-dark"></span>Detalles de Reserva</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Check In</td>
              <td><?php echo $fecha_in ?></td>
            </tr>
            <tr>
              <td>Check Out</td>
              <td><?php echo $fecha_out ?></td>
            </tr>
            <tr>
              <td>Tipo de Habitación</td>
              <td><?php echo $tipo_hab ?></td>
            </tr>
            <tr>
              <td>N° Noches</td>
              <td><?php echo $number_night ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-2">
        <table class="table table-striped table-bordered">
          <thead>
            <tr class="table-info">
              <th class="text-left" colspan="4"><span class="fas fa-bolt mr-2 text-dark"></span>Detalles de Extras</th>
            </tr> 
          </thead>
          <tbody>
            <tr>
              <th>Extra</th>
              <th>N° Personas</th>
            </tr>
            <tr>
              <td>Basic Day</td>
              <td><?php echo $basic ?></td>
            </tr>
            <tr>
              <td>Infierno</td>
              <td><?php echo $infierno ?></td>
            </tr>
            <tr>
              <td>Duckies</td>
              <td><?php echo $duckies ?></td>
            </tr>
            <tr>
              <td>Flotada Familiar</td>
              <td><?php echo $flotada ?></td>
            </tr>
            <tr>
              <td>Clases Kayak</td>
              <td><?php echo $kayak ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
</div>
<?php


    $mail = new PHPMailer(true);
    
    $datos_res ='<h2>Hemos recibido con exito la cancelacion de tu reserva</h2><br><br>'.
                '<b>Orden de reserva numero:</b> '.$orden_pedido.'<br><br>'.
                '<b>ID de reserva:</b> '.$orden_pedido.'<br><br>'.
                '<b>Titular de reserva:</b> '.$first_name.' '.$lastname.'<br><br>'.
                '<b>Pago realizado:</b> '.$monto_pedido.'<br><br>'.
                '<b>Ultimos 4 digitos:</b> '.$ultimos_digitos.'<br><br>'.
                '<b>Fecha de Reserva:</b> '.$fecha_pedido. '<br><br>'.
                '<b>Numero de Noches reservadas:</b> '.$number_night. '<br><br>'.
                '<b>Check in: </b>'.$fecha_in.'<br><br>'.
                '<b>Check Out: </b>'.$fecha_out.'<br><br>'.
                '<b>Habitacion: </b>'.$tipo_hab.'<br><br>'.
                '<b>Extra "Basic" cantidad de personas: </b>'.$basic.'<br><br>'.
                '<b>Extra "Infierno" cantidad de personas: </b>'.$infierno.'<br><br>'.
                '<b>Extra "Duckies" cantidad de personas: </b>'.$duckies.'<br><br>'.
                '<b>Extra "Flotada Familiar" cantidad de personas: </b>'.$flotada.'<br><br>'.
                '<b>Extra "Kayak" cantidad de</b>'.$kayak.'<br><br>';
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
    //echo 'Mensaje enviado correctamente';
} catch (Exception $e) {
    //echo "Error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
}


?>

<?php else:?>

 <div class="wrap">
<div class="container-fluid">
  <div class="row final_error">
    <div class="col-12 d-flex ">
      <span class="fas fa-times-circle mr-3"></span><h4>Transacción fallida</h4>
    </div>
    <div class="col-12">
      <p>Orden de Compra <?php echo $number_id?> rechazada</p>
      <p>Las posibles causas de este rechazo son:</p>
      <p>* Error en el ingreso de los datos de su tarjeta de Crédito o Débito (fecha y/o código de seguridad).</p>
      <p>* Su tarjeta de Crédito o Débito no cuenta con saldo suficiente.</p>
      <p>* Tarjeta aún no habilitada en el sistema financiero.</p>
    </div>
    <div class="col-12"><button class="btn btn-warning"><a href="../index.php">Volver</a></button></div> 
  </div>
</div>
</div>   


<?php endif ?>

</body>
</html>