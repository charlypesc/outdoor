<?php
function buscaext ($code){

				  $code=$code;
				  print_r($code);
                  $sql_extra="SELECT * FROM extras WHERE code= $code";
                  $resultado=$base->prepare($sql_extra);
                  $resultado->execute();

                  while($registrado=$resultado->fetch(PDO::FETCH_ASSOC)){

                    $descripcion_extra=$registrado['nombre'];
                    
                    }

                    return $descripcion_extra;

}

 ?>