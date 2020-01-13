<?php
session_start();
$b="<br>";
require_once '../vendor/autoload.php';
include_once('clases/producto.php');

use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;

$transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
                ->getNormalTransaction();
    


$tokenWs = filter_input(INPUT_POST, 'token_ws');
$result = $transaction->getTransactionResult($tokenWs);
$output=$result->detailOutput;


$number_night   =   $_SESSION['number_night'];
$number_room    =   $_SESSION['number_room'];
$tipo_hab       =   $_SESSION['type_room'];
$fechain        =   $_SESSION['fechain'];
$fechaout       =   $_SESSION['fechaout'];
$first          =   $_SESSION['first'];
$lastname       =   $_SESSION['lastname'];
$mail           =   $_SESSION['mail'];
$state          =   $_SESSION['state'];
$phone          =   $_SESSION['phone'];
// $zip            =   $_SESSION['zip'];

$basic=0;
$infierno=0;
$duckies=0;
$flotada=0;
$kayak=0;




if($_SESSION['Basic Day']>0){
    $basic=$_SESSION['Basic Day'];
}else{
    $basic=null;
}
if($_SESSION['Infierno']>0){
    $infierno=$_SESSION['Infierno'];
}else{
    $infierno=null;
}
if($_SESSION['Duckies']>0){
    $duckies=$_SESSION['Duckies'];
}else{
    $duckies=null;
}
if($_SESSION['Flotada Familiar']>0){
    $flotada=$_SESSION['Flotada Familiar'];
}else{
    $flotada=null;
}
if($_SESSION['Clases de Kayak']>0){
    $kayak=$_SESSION['Clases de Kayak'];
}else{
    $kayak=null;
}


// print_r($_SESSION);


$orden_pedido=$output->buyOrder;
$id_pedido=$result->sessionId;
$monto_pedido=$output->amount;
$codigo_pedido=$output->responseCode;
$fecha_pedido=$result->transactionDate;
$tipo_pago=$output->paymentTypeCode;
$cantidad_cuota=$output->sharesNumber;
$ultimos_digitos=$result->cardDetail->cardNumber;


// print_r($orden_pedido);
// print_r($b);
// print_r($id_pedido);
// print_r($b);
// print_r($monto_pedido);
// print_r($b);
// print_r($codigo_pedido);
// print_r($b);
// print_r($fecha_pedido);
// print_r($b);
// print_r($tipo_pago);
// print_r($b);
// print_r($cantidad_cuota);
// print_r($b);
// print_r($ultimos_digitos);
// print_r($b);
// print_r($number_night);
// print_r($b);
// print_r($number_room);
// print_r($b);
// print_r($tipo_hab);
// print_r($b);
// print_r($fechain);
// print_r($b);
// print_r($fechaout);
// print_r($b);
// print_r($first);
// print_r($b);
// print_r($lastname);
// print_r($b);
// print_r($mail);
// print_r($b);
// print_r($state);
// print_r($b);
// print_r($phone);
// print_r($b);
// print_r($b);



if($output->responseCode == 0) : 

$otherdb = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//$ins = $otherdb->query("INSERT INTO `prueba` (`id`, `valores`) VALUES (NULL, '$test')");

$sql=$otherdb->query("INSERT INTO `transacciones` (
    `id`,`orden_pedido`, `id_pedido`, `monto_pedido`,
     `codigo_pedido`, `fecha_pedido`, `tipo_pago`, 
     `tipo_cuota`, `cantidad_cuota`, `ultimos_digitos`, 
     `descripcion`,`number_night`,`number_room`,`tipo_habitacion`,
     `fecha_in`,`fecha_out`, `first`,`lastname`,`mail`,`state`,`phone`,
     `zip`,`basic`,`infierno`,`duckies`,`flotada`,`kayak`) 
     VALUES (
         null,'$orden_pedido', '$id_pedido', '$monto_pedido', 
         '$codigo_pedido', '$fecha_pedido', '$tipo_pago',
          null, '$cantidad_cuota', '$ultimos_digitos', 
          null, '$number_night', '$number_room','$tipo_hab', 
          '$fechain', '$fechaout', '$first', '$lastname', 
          '$mail', '$state', '$phone',
          null,'$basic','$infierno','$duckies','$flotada','$kayak'
          )"
          );

?>

<form action="<?php echo $result->urlRedirection  ?>" method="POST" id="return-form" >
    <input type="hidden" name="token_ws" value="<?php echo $tokenWs?>">
</form>

<script>
        alert ("ok");
</script>

<script>
    document.getElementById('return-form').submit();
</script>


//----------------fin de el IF ------------


<?php else:?>
<script>
        //alert ("caimos en el else, vamos bien");
</script>
<?php
$otherdb = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql=$otherdb->query("INSERT INTO `transacciones` (null,`orden_pedido`, `id_pedido`, `monto_pedido`, `codigo_pedido`, `fecha_pedido`, `tipo_pago`, `tipo_cuota`, `cantidad_cuota`, `ultimos_digitos`, `descripcion`,`number_night`,`number_room`,`tipo_habitacion`,`fecha_in`,`fecha_out`, `first`,`lastname`,`mail`,`state`,`phone`,`zip`,`basic`,`infierno`,`duckies`,`flotada`,`kayak`) VALUES ('$orden_pedido', '$id_pedido', '$monto_pedido', '$codigo_pedido', '$fecha_pedido', '$tipo_pago', ' ', '$cantidad_cuota', '$ultimos_digitos', '', '$number_night', '$number_room','$tipo_hab', '$fechain', '$fechaout', '$first', '$lastname', '$mail', '$state', '$phone',' ','$basic','$infierno','$duckies','$flotada','$kayak')");   

//$sql=$otherdb->query("INSERT INTO `transacciones` (`orden_pedido`, `id_pedido`, `monto_pedido`, `codigo_pedido`, `fecha_pedido`, `tipo_pago`, `tipo_cuota`, `cantidad_cuota`, `ultimos_digitos`, `descripcion`,`number_night`,`number_room`,`tipo_habitacion`,`fecha_in`,`fecha_out`, `first`,`lastname`,`mail`,`state`,`phone`,`basic`,`infierno`,`duckies`,`flotada`,`kayak`) VALUES ('$orden_pedido', '$id_pedido', '$monto_pedido', '$codigo_pedido', '$fecha_pedido', '$tipo_pago', '', '$cantidad_cuota', '$ultimos_digitos', '', '$number_night', '$number_room','$tipo_hab', '$fechain', '$fechaout', '$first', '$lastname', '$mail', '$state', '$phone','$basic','$infierno','$duckies','$flotada','$kayak')");

?>
<form action="<?php echo $result->urlRedirection  ?>" method="POST" id="return-form" >
    <input type="hidden" name="token_ws" value="<?php echo $tokenWs?>">
</form>

<script>
    document.getElementById('return-form').submit();
</script>
<?php endif;?>