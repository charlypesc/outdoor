<?php
	
	include "config_2.php";
	

	try{


			$base= new PDO ("mysql:host=$hosting; dbname=$databname", "$databuser","$databpass");
			
			$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$base->exec("SET CHARACTER SET UTF8");
			


	}catch(exception $e){
		die('Error' . $e->getMessage() );
		echo "Linea del error" . $e->getLine();



	}
	


?>