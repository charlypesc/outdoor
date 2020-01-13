<?php 

// print_r($_POST);
// if(!isset($_POST["nextpay"])){
	
// 	header("location:../index.php");
// }	
		include_once('clases/producto.php');

		$product = new Product();
		
		session_start();



//inicio de calculo de valor por la habitacion escogida		
$number_night	= $_POST['night'];
$number_room 	= $_POST['room'];


$otherdb = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql=$otherdb->query("SELECT * FROM `rooms` where `tipo`=$number_room");
foreach ($sql->fetch_all(MYSQLI_ASSOC) as $key) {
      $choose_value=$key['valor'];
    }//-->FIN

//CALCULO DE VALOR POR HABITACIÓN

$valueroomtotal=$choose_value*$number_night;

//VARIABLES DE EXTRAS

$value_201		= $_POST['code_ex_201'];
$cant_201		= $_POST['cant_ex_201'];
$value_202		= $_POST['code_ex_202'];
$cant_202		= $_POST['cant_ex_202'];
$value_203		= $_POST['code_ex_203'];
$cant_203		= $_POST['cant_ex_203'];
$value_204		= $_POST['code_ex_204'];
$cant_204		= $_POST['cant_ex_204'];
$value_205		= $_POST['code_ex_205'];
$cant_205		= $_POST['cant_ex_205'];



$total_201 = $value_201*$cant_201;
$total_202 = $value_202*$cant_202;
$total_203 = $value_203*$cant_203;
$total_204 = $value_204*$cant_204;
$total_205 = $value_205*$cant_205;

$extra_201=201;
$extra_202=202;
$extra_203=203;
$extra_204=204;
$extra_205=205;

$oextra201 = new stdClass();
$oextra201->tipo="Basic Day";
$oextra201->valor=50000;
$oextra201->cantidad=$_POST['cant_ex_201'];

$oextra202 = new stdClass();
$oextra202->tipo="Infierno";
$oextra202->valor=70000;
$oextra202->cantidad=$_POST['cant_ex_202'];

$oextra203 = new stdClass();
$oextra203->tipo="Duckies";
$oextra203->valor=30000;
$oextra203->cantidad=$_POST['cant_ex_203'];

$oextra204 = new stdClass();
$oextra204->tipo="Flotada Familiar";
$oextra204->valor=20000;
$oextra204->cantidad=$_POST['cant_ex_204'];

$oextra205 = new stdClass();
$oextra205->tipo="Clases de Kayak";
$oextra205->valor=30000;
$oextra205->cantidad=$_POST['cant_ex_205'];

//formatea el numero a miles con puntos
function formateonumero($num){
	$new=number_format($num,'0', ',','.');
	return $new;
}

//chequea si el extra tiene cantidad mayor a 0 y lo agrega a la session. 

function check($ob){
	if($ob->cantidad > "0"){
		$_SESSION[$ob->tipo]=$ob->cantidad;

	}
};


?>

<!DOCTYPE html>
<html lang="en">


<?php include ("header.php");  ?>


<script>
		$(document).ready(function(){
	 	 $("#but").click(function(){
	    	$("#content").slideToggle();
	  		});
	 	 $("#butRoom").click(function(){
	    	$("#contentRoom").slideToggle();
	  		});
		});
	</script>
	<div class="wrap">
		<div class="">
		<h3 class="display-4">Detalle </h3>
		<div class="row bg-light ">
			<div class="col-6">
				<div class="col-sm">
					<h4>Contacto / Contact: </h4><span><?php echo $_POST['first']." ". $_POST['lastname'];  ?> </span>
				</div><br>
				<div class="col-sm">
					<h4>Teléfono / Phone</h4><span><?php echo $_POST['phone'];  ?> </span>
				</div><br>
				<div class="col-sm">
					<h4>Mail: </h4><span><?php echo $_POST['mail']; ?> </span>
				</div>
			</div>
			<div class="col-6">
				<div class="content-fluid">
				<h4>País / Country </h4><span><?php echo $_POST['country']; ?> </span><br>
				</div>
				<div class="content-fluid">
				<h4>Ciudad </h4><span><?php echo $_POST['city']; ?> </span><br>
				</div>
			</div>
		</div><br>
<?php
				

	echo $product->extraRoom($number_room);
	echo "
		
		<tr>
			<td>Numero de días</td>
			<td>: $number_night</td>	
		</tr>
		<tr>
			<td>Subtotal</td>
			<td>: $".formateonumero($valueroomtotal)."</td>
		</tr>
		</table>
		</div><br><br>

	 ";
	?>

	<?php


	if ($cant_201>0 || $cant_202>0 || $cant_203>0 || $cant_204>0 || $cant_205>0 ) {
		echo '<button id="but" class="collapsible"><i class="fas fa-bolt"></i> Extras</button>';
		
		echo'<div id="content" class="content">';
		echo '<p>
		<table>';  				
		
		
	}

	if ($cant_201>0) {
		$e_1= $product->extraChoose($extra_201);
		echo "
			<table>
			<tr>
				<th>$e_1</th>
			</tr>	
			<tr>
				<td>Cantidad de Personas</td>
				<td>: $cant_201</td>	
			</tr>
			<tr>
				<td>Subtotal</td>
				<td>: $ ".formateonumero($total_201)." + iva</td>
			</tr>
			</table>

		";
		
	}

	if ($cant_202>0) {
		$e_2= $product->extraChoose($extra_202);
		echo "
		<table>
			<tr>
				<th>$e_2</th>
			</tr>	
			<tr>
				<td>Cantidad de Personas</td>
				<td>: $cant_202</td>	
			</tr>
			<tr>
				<td>Subtotal</td>
				<td>: $  ".formateonumero($total_202)." + iva</td>
			</tr>
		</table>
		";	
	}

	if ($cant_203>0) {
		$e_3=$product->extraChoose($extra_203);
		echo "
			<table>
				<th>$e_3</th>
				</tr>	
				<tr>
					<td>Cantidad de Personas</td>
					<td>: $cant_203</td>	
				</tr>
				<tr>
					<td>Subtotal</td>
					<td>: $  ".formateonumero($total_203)." + iva</td>
				</tr>
			</table><br>

		";	
	}


	if ($cant_204>0) {
		$e_4=$product->extraChoose($extra_204);
		echo "
			<table>
				<tr>
					<th>$e_4</th>
				</tr>	
				<tr>
					<td>Cantidad de Personas</td>
					<td>: $cant_204</td>	
				</tr>
				<tr>
					<td>Subtotal</td>
					<td>: $  ".formateonumero($total_204)." + iva</td>
				</tr>
			</table>

		";	
	}


	if ($cant_205>0) {

		$e_5=$product->extraChoose($extra_205);
		echo "
		<table>
			<tr>
				<th>$e_5</th>
			</tr>	
			<tr>
				<td>Cantidad de Personas</td>
				<td>: $cant_205</td>	
			</tr>
			<tr>
				<td>Subtotal</td>
				<td>: $  ".formateonumero($total_205)." + iva</td>
			</tr>
		</table>
		";	

	}

			

echo '</table>';
echo	"</div>";


	
	//Se calculan todos los valores de los subtotales 
	$totaltotal=$total_201+$total_202+$total_203+$total_204+$total_205+$valueroomtotal;
	//Se calcula el impuesto
	$impuesto=$totaltotal*19/100;
	//se calcula el impuesto mas el total
	$ttotal=$impuesto+$totaltotal;
	//se calcula el valor de la reserva (50%)
	 
	$reserva= $ttotal/2;
	
	$reserva_r=round($reserva);
	print_r($reserva_r);
	$oc=strval(rand(1000000,4999999));
	$id_r=strval(rand(5000000, 9999999));
	

	echo "

<br>
<br>
<div class='container-fluid'>
	<div>
		<table >
			<tr class='pago'>
				<td>Subtotal</td>
				<td>$ ".number_format($totaltotal,'0', ',','.')."</td>
			</tr>
			<tr>
				<td>Impuesto(iva)</td>
				<td>$ ".number_format($impuesto,'0', ',','.')." </td>
			</tr>
			<tr>
				<th>Valor Total</th>
				<th>$ ".number_format($ttotal,'0', ',','.')."</th>

			</tr>	
		</table>
	</div>

</div>
	
	

		
	";


	echo '
			<br><h3 class="text-center">A pagar por reserva (CLP): $ '.formateonumero($reserva).' </h3>';	
?>

<?php



$_SESSION['oc_r']=$oc;
$_SESSION['id_r']=$id_r;
$_SESSION['number_night']=$number_night;
$_SESSION['number_room']=$number_room;
$_SESSION['type_room']=$_POST['tipo_hab'];
$_SESSION['fechain']=$_POST['fechain'];
$_SESSION['fechaout']=$_POST['fechaout'];
$_SESSION['first']=$_POST['first'];
$_SESSION['lastname']=$_POST['lastname'];
$_SESSION['mail']=$_POST['mail'];
$_SESSION['state']=$_POST['state'];
$_SESSION['phone']=$_POST['phone'];


	check($oextra201);
	check($oextra202);
	check($oextra203);
	check($oextra204);
	check($oextra205);


//$_SESSION['OB']=$oextra201;



require_once '../vendor/autoload.php';

use Transbank\Webpay\Webpay;
use Transbank\Webpay\Configuration;


//$transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
//				->getNormalTransaction();

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


//print_r($transaction);
$amount=$reserva_r;
// $sessionID ='sessionID';
$sessionID =$id_r;
$buyOrder = $oc;

$returnUrl='https://outdoorpatagonia.cl/carrito_reserva/return.php';
$finalUrl='https://outdoorpatagonia.cl/carrito_reserva/final.php';

$initResult = $transaction->initTransaction(
$amount, $sessionID, $buyOrder, $returnUrl, $finalUrl);


$formAction =$initResult->url;
$tokenWs = $initResult->token;



?>
		<form action="<?php echo $formAction ?>" method="POST" id="form1" >
			<input type="hidden" name="" value="<?php echo $reserva ?>">
			<input type="hidden" name="token_ws" value="<?php echo $tokenWs  ?>">
		</form>
		<div class="container-fluid">
			<div class="row justify-content-center" >
				<div class="mr-3"><button  class="btn btn-primary" onClick="javascript:history.go(-1)">Modificar reserva</button></div>
				<div><button id="botonEnviar" class="btn btn-success ">Ir a webpay</button></div>
				<!-- <div class="col"><img src="img/webpay.png" class="align-middle" alt="webpay" width="200px"></div>			 -->
			</div>
		</div>
			

	</div>
			






</div>
<script>
$( "#botonEnviar" ).click(function() {
        $( "#form1" ).submit();
        $( "#form2" ).submit();
});
</script>


					
</body>
</html>
