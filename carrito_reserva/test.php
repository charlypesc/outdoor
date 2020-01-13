<?php

include_once('clases/producto.php');
$product = new Product();

$aleatorio=strval(rand(1,30));

//  function oc($num){
    
    // $aleatorio=$num;
    $otherdb = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql=$otherdb->query("SELECT id FROM `transaccion_e`");
    $a=array();
    $i=0;
    while ($fila=mysqli_fetch_array($sql)){

            // $a=array(
                echo $fila['id']."<br>";
                
                
                
            // )
            // $v=strval(rand(1,30));
            // for ($i=$v; $i=!$f ; $i++) { 
                
            //     echo $f;
            //     return;

            // }
        
        }
 
// }
// var_dump($sql);
var_dump($fila);
print_r($a);
?>