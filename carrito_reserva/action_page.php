<?php 

// print_r($_POST);

// if(!isset($_POST["nextpay"])){
	
// 	header("location:../index.php");
// }	
		include_once('clases/producto.php');

		$product = new Product();
		
		session_start();

		
// capturo data que va a ser validada
		$first		=$_POST['first'];
		$lastname	=$_POST['lastname'];
		$mail		=$_POST['mail'];
		$state		=$_POST['state'];
		$phone		=$_POST['phone'];
//valido que los campos no vengan vacios

		if(!isset($_POST['first']) ||
 
		!isset($_POST['mail']) ||
		!isset($_POST['phone']) ||
		!isset($_POST['state']) ||
        !isset($_POST['lastname'])) {
 
        die('Lo sentimos pero parece haber un problema con los datos enviados.');
 
	}
//valida campo mail

	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
	if(!preg_match($email_exp,$mail)) {
   
		 die('La dirección de correo proporcionada no es válida.<br/>');
		
	}
//valida campo tipo string(texto)

$string_exp = "/^[A-Za-z .'-]+$/";
$inter = "/^[0-9.'-]+$/";
if(!preg_match($string_exp,$first)) {
  die('El formato del nombre no es válido <br>');
}
if(!preg_match($string_exp,$lastname)) {
  die( 'El formato Apellido/Lastname no es valido <br>');
}
if(!preg_match($string_exp,$state)) {
	die( 'El formato estado/state no es valido <br>');
  }
if(!preg_match($inter,$phone)) {
	die( 'El formato Telefono/Phone no es valido <br>');
  }



//inicio de calculo de valor por la habitacion escogida		
$number_night	= $_POST['night'];
$number_room 	= $_POST['room'];


$otherdb = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql=$otherdb->query("SELECT * FROM `rooms` where `tipo`=$number_room");
foreach ($sql->fetch_all(MYSQLI_ASSOC) as $key) {
	  $choose_value=$key['valor'];
	  $type_room=$key['room'];
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
				
//corresponde al menu desplegable en action_page

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
	//print_r($reserva_r);
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
$_SESSION['type_room']=$type_room;
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


$transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
				->getNormalTransaction();



//print_r($transaction);
$amount=$reserva_r;
// $sessionID ='sessionID';
$sessionID =$id_r;
$buyOrder = $oc;

$returnUrl='http://localhost/outdoor/carrito_reserva/return.php';
$finalUrl='http://localhost/outdoor/carrito_reserva/final.php';

$initResult = $transaction->initTransaction(
$amount, $sessionID, $buyOrder, $returnUrl, $finalUrl);


$formAction =$initResult->url;
$tokenWs = $initResult->token;

//print_r($initResult->url);

?>
		<form action="<?php echo $formAction ?>" method="POST" id="form1" >
			<input type="hidden" name="" value="<?php echo $reserva ?>">
			<input type="hidden" name="token_ws" value="<?php echo $tokenWs  ?>">
		</form>
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center" >
				<div class="mr-3"><button  class="btn btn-primary" onClick="javascript:history.go(-1)">Modificar reserva</button></div>
				<div><button id="botonEnviar" class="btn btn-success ">Ir a webpay</button></div>
				<div class="col"><img src="img/webpay.png" class="align-middle" alt="webpay" width="200px"></div>
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