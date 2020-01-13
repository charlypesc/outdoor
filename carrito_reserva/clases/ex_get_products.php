<?php
 

//- - - - - -  - -A l m a c e n a r  u n  A R R A Y - - - - - - - - - - 
/*
          $count_room_standard =$this->db->query("SELECT `tipo` FROM `rooms` ORDER BY `tipo` ASC");
          $i=0;
          while($array=$count_room_standard->fetch_ALL()){

            $claves = array_keys($array);

            foreach ($claves as $clave) {

                $arrayauxiliar[$i][$clave]=$array[$clave];

            }
            $i++;
          }

          
          $p= reset($arrayauxiliar[0]);
          $p=$p[0];
          $f=end($arrayauxiliar[0]);
          $f=$f[0];

          print_r($s);
          print_r($p);
          print_r($s);
          print_r($f);
          print_r($s);
          //echo $p[0];
          //echo $f[0];


          foreach ($count_room_standard->fetch_all(MYSQLI_ASSOC) as $key) {
            $primer_hab_standard=$key['tipo'];
          }
          print_r($s);
           //print_r($primer_hab_standard);
           print_r($s);

*/       


 

          // - - - - - - - - Habitaciones Standards - - - - - -

 //consulta por primera habitacion matrimonial
          $p=" <- - - - - -fin de prueba - - - - ->";

          print_r($s);
          print_r($p);

          $sql_room_0 = $this->db->query("SELECT * FROM `test` WHERE froom between '$froom' And '$too' and codigo=101");
          $sql_room_1 = $this->db->query("SELECT * FROM `test` WHERE froom between '$froom' And '$too' and codigo=102");
          $sql_room_2 = $this->db->query("SELECT * FROM `test` WHERE froom between '$froom' And '$too' and codigo=103");
     

      if ($sql_room_0->num_rows>=1) {
          $room_0=5;
          echo"<br> room 1 ocupada";
          }else{
                $room_0=2;
                echo " <br>room 1 desocupada";
                }
      if ($sql_room_1->num_rows>=1) {
          $room_1=5;
          echo"<br> room 2 ocupada";
          }else{
              $room_1=2;      
              echo " <br>room 2 desocupada";
              }

      if ($sql_room_2->num_rows>=1) {
          $room_2=5;
          echo  " <br> room 3 ocupada";        
          }else{
                $room_2=2;      
                echo "<br>room 3 desocupada<br>";
                }

          $room_total="";      
          if($room_0+$room_1+$room_2>=15){
            $room_total=30;
            } 

            //habitacion 1  
            elseif($room_0<=2){
             
              
              $standard_0 = $this->db->query("SELECT * FROM `rooms`where tipo=101 ");
              foreach ($standard_0->fetch_all(MYSQLI_ASSOC) as $key){

              // --> Pendiente de aplicar
              }
              
            } 
            //habitacion 2
            elseif($room_1<=2){
             
              $standard_1 = $this->db->query("SELECT * FROM `rooms`where tipo=102 ");
              
              foreach ($standard_1->fetch_all(MYSQLI_ASSOC) as $key) {
                
              }
              // --> Pendiente de aplicar
            }
            
            //habitacion 3
            
            elseif($room_2<=2){
              echo "";
              $standard_2 = $this->db->query("SELECT * FROM `rooms`where tipo=103 ");
              //print_r($standard_1);
              $hab_3 = "";
                    foreach ($standard_2->fetch_all(MYSQLI_ASSOC) as $key) {
                         
                      $code = "'".$key['tipo']."'";
                      $total_noches = $key['valor']*$diff->days;
                      $hab_3 .= ' <div class="wrap_room">  
                                    <div class="room_foto">
                                        <i class="fas fa-camera"></i>
                                    </div>                            

                                    <div class="room_detail">
                                      <h4>Codigo de Habitación '.$key['tipo'].'</h4>
                                      <input type="hidden" name="room" value="'.$key['tipo'].'">
                                        <div class="room_noches_total">
                                          <h4>Total noches: </h4>
                                          <p>'.$diff->days.'</p>
                                          <input type="hidden" name="night" value="'.$diff->days.'"  id="'.$key['tipo'].'">
                                        </div>
                                        <h2>'.$key['room'].'</h2>
                                        <p>'.$key['descripcion'].'</p>
                                    </div>
                                    <div class="room_valor">
                                        <h4>Valor por noche</h4>
                                        <h2>Precio</h2>
                                        <p>$ '.$key['valor'].'</p>
                                        <p>Agregar</p>
                                        <input type="checkbox" name="price" value="'.$total_noches.'">
                                    </div>  
                                  </div>


                      ';      
                    //si el valor es menor a 15 
                    }

              echo $hab_3;

                    

              }//fin del elseif

//- - - - - - - R O O M M A T E S  - - - -  - - - -

//consultas a habitaciones y codigo

      $sql_room_3 = $this->db->query("SELECT * FROM `test` WHERE froom between '$froom' And '$too' and codigo=104");
      $sql_room_4 = $this->db->query("SELECT * FROM `test` WHERE froom between '$froom' And '$too' and codigo=105");
      $sql_room_5 = $this->db->query("SELECT * FROM `test` WHERE froom between '$froom' And '$too' and codigo=106");

      

      if ($sql_room_3->num_rows>=1) {
          $room_3=5;
          echo"<br> roomates 4 ocupada";
          }else{
                $room_3=2;
                echo " <br>roommates 4 desocupada";
                }

      if ($sql_room_4->num_rows>=1) {
          $room_4=5;
          echo"<br> roommates 5 ocupada";
          }else{
              $room_4=2;      
              echo " <br>roomates 5 desocupada";
              }  

      if ($sql_room_5->num_rows>=1) {
          $room_5=5;
          echo "roommates 6 ocupada";        
          }else{
                $room_5=2;      
                echo "<br>roommates 6 desocupada<br>";
                }

         
          
          if($room_3+$room_4+$room_5>=15){

             echo "Todas las habitaciones roomates estan ocupadas";
            } 
            //habitacion 4  
            elseif($room_3<=2){
              
              $standard_3 = $this->db->query("SELECT * FROM `rooms`where tipo=104 ");
              foreach ($standard_3->fetch_all(MYSQLI_ASSOC) as $key){

                // --> Pendiente de aplicar
              }
              
            } 

            //habitacion 5
            
            elseif($room_4<=2){
              
              $standard_4 = $this->db->query("SELECT * FROM `rooms`where tipo=105 ");
              
              foreach ($standard_4->fetch_all(MYSQLI_ASSOC) as $key) {
              // --> Pendiente de aplicar  
              }
              
            }
            //habitacion 6
            

            elseif($room_5<=2){
            

              $standard_2 = $this->db->query("SELECT * FROM `rooms`where tipo=106 ");
              
                    foreach ($standard_2->fetch_all(MYSQLI_ASSOC) as $key) {
                      $hab_3="";           
                      $code = "'".$key['tipo']."'";
                      $total_noches = $key['valor']*$diff->days;
                                          $hab_3 .= ' <div class="wrap_room">  
                                    <div class="room_foto">
                                        <i class="fas fa-camera"></i>
                                    </div>                            
                                        <input type="hidden" name="noche_in" value="'.$froom.'" >
                                        <input type="hidden" name="noche_out" value="'.$too.'">
                                        <input type="hidden" name="dif_dias" value ="'.$diff->days.'">
                                    <div class="room_detail">
                                      <h4>Codigo de Habitación '.$key['tipo'].'</h4>
                                      <input type="hidden" name="room" value="'.$key['tipo'].'">
                                        <div class="room_noches_total">
                                          <h4>Total noches: </h4>
                                          <p>'.$diff->days.'</p>
                                          <input type="hidden" name="night" value="'.$diff->days.'"  id="'.$key['tipo'].'">
                                        </div>
                                        <h2>'.$key['room'].'</h2>
                                        <p>'.$key['descripcion'].'</p>
                                    </div>
                                    <div class="room_valor">
                                        <h4>Valor por noche</h4>
                                        <h2>Precio</h2>
                                        <p>$ '.$key['valor'].'</p>
                                        <p>Agregar</p>
                                        <input type="checkbox" name="price" value="'.$total_noches.'">
                                    </div>  
                                    
                                  </div>


                      ';      
                    //si el valor es menor a 15 
                    }   
              echo $hab_3;

                    

              } //fin del elseif
          print_r($room_0);
          print_r($s);
          print_r($room_1);
          print_r($s);
          print_r($room_2);
          print_r($s);
          print_r($room_3);
          print_r($s);
          print_r($room_4);
          print_r($s);
          print_r($room_5);
          print_r($s);

          ?>