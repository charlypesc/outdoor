<?php
session_start();
$b="<br>";
require_once '../vendor/autoload.php';
include_once('clases/producto.php');

use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;

//$transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
//->getNormalTransaction();
    $configuration = new Configuration();
    $configuration->setEnvironment("PRODUCCION");
    $configuration->setCommerceCode(597034831114);
    $configuration->setPrivateKey(
        "-----BEGIN RSA PRIVATE KEY-----\n".
            "MIIEpAIBAAKCAQEAt5rFzRY8ObvTdaufWlAjdEXqBUsk8Qllh1hoGOdXCBSihZR3\n".
            "AhQwEynqjyfBb1qHVsZuCiqm+KjmFCxXbLP7LJSgZ5tistHOC4m7lXiDaTzBdLcB\n".
            "UtZqIBPAAZh0nepZi/fFCCfNQpIEYsf7oPHPKsB1USkIksd9NTtN7aeyasWbaPv8\n".
            "5khIPVgmpjzN1r0eIlEBY3PG2WUu2iBmbVLYl805U47UoAmmLUKuYCK426KEDtKk\n".
            "LVdsq6slEwRCD+CpziboZ98FyEUS9GMTDny4qnAiAAKTUDf1rzkCpz5LbFhvb0HI\n".
            "4EmBTIf5hYjbxNIyhAO/V8TckCMkHF4I6R8XTwIDAQABAoIBADh3xXX57LPk7Hg4\n".
            "PF5OX1kXV44hOk9XkH471mgyXjYCAqoKqz9cbhy2u4kjtP5GXXF2vckqrQe1Cm4R\n".
            "5SFtiUaAv4Sd6ZENrc0moyapVeE76lO3JRURFLqg2GClPtiCht/haBvGAf8DYY3v\n".
            "65foRsrjPjGj6Rsbd4qznpgFB36GmmPyJY65pbDgRLbTSVVtxnDADzFm/RflJHUW\n".
            "itogd71j048PkfnCU3Vfg6ipedbZRZkKvqXKmz6JjOSW6pfZNrJPX0hL9K3ORlw9\n".
            "+ASHiYJ/H9kA6Qdo1Yi164DKWpJq7UNHEanR82sLEh6XICMlKg9eITgmjR3CWKFT\n".
            "8jGKIMECgYEA5OAL+qFiYlel+Nm0n1PJXTBZ+TovLwtCHsYlgrcrf3gtS9zXGjUj\n".
            "8mMfzqqp+s6AAr1qyN+rCnnG3FqWiAeYlvjYRzEfLndM0PC5qAgYF5OikeACEKPW\n".
            "Zc7SDSG0HIqMUXSSkEXP1VxvLfSNM0Zxw905iCP4csLdR1OtJT8whnkCgYEAzV09\n".
            "UCPivi//Olvma6uOP98ixk0OjpK4EM/QaxhQrb0sL0TJ5xujvlxPxXDsSgLvPQ8n\n".
            "PP3/SDg7a3FoTRLz6QcejJd9RpraBwzNYkFHvzCabLaTGqyPhwRgzyFhzWE+rv7y\n".
            "oC5RrGHqmY3rQ8WWRNVS3sZew0Nl/ah5Xe30OgcCgYEA04oU6FCTW2vBVnD5la1e\n".
            "VwhikIzroWKZeVIQx3E+/fD4hL6X/XwSPmzJsD1jIBIOlPm3ofPA5czKNU5xBUdo\n".
            "DFnxpFNNi6fuUsu7/QeGJPxqbMOLhQ+5EJ4I3ORC0YJo0Lya3kf4IS7u/52hiDva\n".
            "2Ho3O5Jrhr5+wPcg+GUgF5kCgYEAkyCBlLCg+XCZgc3lPq4hs1DBMSBzlWE3zZOU\n".
            "1aUN5+rnhNXbcF806GRqIiHMpxmDHFOG4QN3qN3gdBFDkDRL2l7nXAIMFlFKclKR\n".
            "shris+62M7x5l1qZWTmhwcNAtks9BVJRsMB+cumTkX9DVcJw7c+HF2M28N2QbDIP\n".
            "AWRA3HECgYBGaqzAsvctgOaHZ7geZ9pzVgl06O+N+9NBuN8IlOKrkIvAucYXrYMt\n".
            "IdwkB7Oc2sM0G6RXMq3qOwioMeO/vee4fDpURNDMsCBuPUMoJAdmcNUVZY3GDuyV\n".
            "PYK4ieLwqnsexeTbLvNqegf2Uqf2V/p9fK7u7vedj+1U56VL69ibew==\n".
            "-----END RSA PRIVATE KEY-----\n"        
    );
    $configuration->setPublicCert(
            "-----BEGIN CERTIFICATE-----\n".
            "MIICqjCCAZICCQDWU7PeGboYJDANBgkqhkiG9w0BAQUFADAXMRUwEwYDVQQDDAw1\n".
            "OTcwMzQ4MzExMTQwHhcNMTkxMTE4MTgxMzQ3WhcNMjMxMTE3MTgxMzQ3WjAXMRUw\n".
            "EwYDVQQDDAw1OTcwMzQ4MzExMTQwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEK\n".
            "AoIBAQC3msXNFjw5u9N1q59aUCN0ReoFSyTxCWWHWGgY51cIFKKFlHcCFDATKeqP\n".
            "J8FvWodWxm4KKqb4qOYULFdss/sslKBnm2Ky0c4LibuVeINpPMF0twFS1mogE8AB\n".
            "mHSd6lmL98UIJ81CkgRix/ug8c8qwHVRKQiSx301O03tp7JqxZto+/zmSEg9WCam\n".
            "PM3WvR4iUQFjc8bZZS7aIGZtUtiXzTlTjtSgCaYtQq5gIrjbooQO0qQtV2yrqyUT\n".
            "BEIP4KnOJuhn3wXIRRL0YxMOfLiqcCIAApNQN/WvOQKnPktsWG9vQcjgSYFMh/mF\n".
            "iNvE0jKEA79XxNyQIyQcXgjpHxdPAgMBAAEwDQYJKoZIhvcNAQEFBQADggEBAFmW\n".
            "Eix2bGYBaEBRsTVZkhhLWVXA76KhN8XbPaanVMwR6AC5aEidbiLzbBH4jtxrdcVt\n".
            "27hseeeH8onxylhwbRlnQtYhERUnOsPx+9oSBOPCNFQxpOgVrakaga0KU5nrOb6E\n".
            "bNXdIjMOmO8nXWTXd1Hb3wt+lMSI012NstIegZCroE+ZNgj3zB/8EVaj3j/4jVAZ\n".
            "Qm72/7nJ7wxNcTv3umSHUggHdE/8trLmo34vm57YWVzpBgY8tZV8fH9fTva2VR8O\n".
            "GeRhYq/AiVPjVGTeg/8Y0iqQbk3W8j4df8N5xP7yQEITB7vRnlKGKfBenTWv+5Ee\n".
            "591o6faqfDoM8HB29ag=\n".
            "-----END CERTIFICATE-----\n"
    );

$webpay = new Webpay($configuration);

$transaction = $webpay->getNormalTransaction();



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

if($_SESSION['Basic Day']>0){
    $basic=$_SESSION['Basic Day'];
}else{
    $basic="0";
}
if($_SESSION['Infierno']>0){
    $infierno=$_SESSION['Infierno'];
}else{
    $infierno="0";
}
if($_SESSION['Duckies']>0){
    $duckies=$_SESSION['Duckies'];
}else{
    $duckies="0";
}
if($_SESSION['Flotada Familiar']>0){
    $flotada=$_SESSION['Flotada Familiar'];
}else{
    $flotada="0";
}
if($_SESSION['Clases de Kayak']>0){
    $kayak=$_SESSION['Clases de Kayak'];
}else{
    $kayak="0";
}

$orden_pedido=$output->buyOrder;
$id_pedido=$result->sessionId;
$monto_pedido=$output->amount;
$codigo_pedido=$output->responseCode;
$fecha_pedido=$result->transactionDate;
$tipo_pago=$output->paymentTypeCode;
$cantidad_cuota=$output->sharesNumber;
$ultimos_digitos=$result->cardDetail->cardNumber;

?>

<?php if($output->responseCode == 0) : 
//guardamos en base de datos
$otherdb = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql=$otherdb->query("INSERT INTO `trans` (`orden_pedido`, `id_pedido`, `monto_pedido`, `codigo_pedido`, `fecha_pedido`, `tipo_pago`, `tipo_cuota`, `cantidad_cuota`, `ultimos_digitos`, `descripcion`,`number_night`,`number_room`,`tipo_habitacion`,`fecha_in`,`fecha_out`, `first`,`lastname`,`mail`,`state`,`phone`,`basic`,`infierno`,`duckies`,`flotada`,`kayak`) VALUES ('$orden_pedido', '$id_pedido', '$monto_pedido', '$codigo_pedido', '$fecha_pedido', '$tipo_pago', '', '$cantidad_cuota', '$ultimos_digitos', '', '$number_night', '$number_room','$tipo_hab', '$fechain', '$fechaout', '$first', '$lastname', '$mail', '$state', '$phone','$basic','$infierno','$duckies','$flotada','$kayak')");

?>

<form action="<?php echo $result->urlRedirection  ?>" method="POST" id="return-form" >
    <input type="hidden" name="token_ws" value="<?php echo $tokenWs?>">
</form>

<script>
        //alert ("ok");
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
$sql=$otherdb->query("INSERT INTO `trans` (`orden_pedido`, `id_pedido`, `monto_pedido`, `codigo_pedido`, `fecha_pedido`, `tipo_pago`, `tipo_cuota`, `cantidad_cuota`, `ultimos_digitos`, `descripcion`,`number_night`,`number_room`,`tipo_habitacion`,`fecha_in`,`fecha_out`, `first`,`lastname`,`mail`,`state`,`phone`,`basic`,`infierno`,`duckies`,`flotada`,`kayak`) VALUES ('$orden_pedido', '$id_pedido', '$monto_pedido', '$codigo_pedido', '$fecha_pedido', '$tipo_pago', '', '$cantidad_cuota', '$ultimos_digitos', '', '$number_night', '$number_room','$tipo_hab', '$fechain', '$fechaout', '$first', '$lastname', '$mail', '$state', '$phone','$basic','$infierno','$duckies','$flotada','$kayak')");

?>
<form action="<?php echo $result->urlRedirection  ?>" method="POST" id="return-form" >
    <input type="hidden" name="token_ws" value="<?php echo $tokenWs?>">
</form>

<script>
    document.getElementById('return-form').submit();
</script>
<?php endif;?>