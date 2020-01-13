<?php
	include_once('conexion.php');
  include_once('functions.php');
	class Product extends Model{
		public $code;
		public $product;
		public $description;
		public $price;
    public $froom;
    public $too;
    public $hab_3;

		public function __construct(){ 
      parent::__construct(); 
    } 
/* Respecto a extraChoose se llama a esta función desde action_page para realizar la busqueda necesaria del codigo de habitacion y la demás info relacionado al 
codigo de habitacion que viajo por post y que se debe reflejar en el detalle de pago */    
public function extraRoom($code_room){

  
    $superoom="";
    $extrachoose= $this->db->query("SELECT * FROM `rooms` where `tipo`=$code_room");
    foreach ($extrachoose->fetch_all(MYSQLI_ASSOC) as $key) {
      

      $choose_number=$key['tipo']; 
      $choose_nombre=$key['room'];
      $choose_desc=$key['descripcion'];
      $choose_value=$key['valor'];
    
    }

      $superoom .="
                <button id='butRoom' class='collapsible'><i class='fas fa-bed'> </i> Habitacion</button>
                  <div id='contentRoom' class='content'>
                <table>
                  <tr>
                    <td>Valor Habitación</td>
                    <td>: $".formateonumero($choose_value)."</td>
                  </tr>
                  <tr>
                    <td>Tipo Habitación</td>
                    <td>: $choose_nombre</td>
                  </tr>
                
        ";

      return $superoom;

}
/* Respecto a extraChoose se llama a esta función desde action_page para realizar la busqueda necesaria del codigo de habitacion y la demás info relacionado al 
codigo de extra ya elegido que viajo por post y que se debe reflejar en el detalle de pago */
public function extraChoose($code){
    $superextra="";
    $extrachoose= $this->db->query("SELECT * FROM `extras` where `code`=$code");


    foreach ($extrachoose->fetch_all(MYSQLI_ASSOC) as $key) {
      


      $choose_nombre=$key['nombre'];
      $choose_desc="";//$key['descripcion'];
    }

      $superextra .="<h5> $choose_nombre</h5><p>$choose_desc</p>
                
        ";

    return $superextra;

}
/* Respecto a rooms, se encarga de generar la vista para el previo filtro que realiza get_products, recibe 2 valores que son el numero de habitacion y el 
numero de días para asi poder generar la vista con esas 2 variables. Ambas vistas para las habitaciones son similares.  */
public function rooms($rooms,$days_in) {

  $roommates_free=$rooms;
  $diff_days=$days_in;

  $roommates_free_query = $this->db->query("SELECT * FROM `rooms` where `tipo`=$roommates_free");
                              //print_r($standard_free_query);
                              //print_r($s);

                               foreach ($roommates_free_query->fetch_all(MYSQLI_ASSOC) as $key) {
                                
                                $roommates_free_t=$key['tipo'];
                                $roommates_free_d=$key['descripcion'];
                                $roommates_free_v=$key['valor'];
                                $roommates_free_r=$key['room'];
                                $roommates_free_f1=$key['foto_1'];
                                $roommates_free_f2=$key['foto_2'];
                                $roommates_free_f3=$key['foto_3'];
                                 }

                                  print_r($roommates_free_r);
                                  $roommates_free_p="";
                                  $roommates_free_p .= ' <div class="wrap_room">  
                                                            <div class="room_foto">
                                                              <div id="carouselExampleControls_'.$roommates_free.'" class="carousel slide" data-ride="carousel">
                                                                <div class="carousel-inner">
                                                                  <div class="carousel-item active">
                                                                    <img src="../img/img_hostal_s_r/'.$roommates_free_f1.'" class="d-block w-100" alt="...">
                                                                  </div>
                                                                  <div class="carousel-item">
                                                                    <img src="../img/img_hostal_s_r/'.$roommates_free_f2.'" class="d-block w-100" alt="...">
                                                                  </div>
                                                                  <div class="carousel-item">
                                                                    <img src="../img/img_hostal_s_r/'.$roommates_free_f3.'" class="d-block w-100" alt="...">
                                                                  </div>
                                                                </div>
                                                                <a class="carousel-control-prev" href="#carouselExampleControls_'.$roommates_free.' " role="button" data-slide="prev">
                                                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                  <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carouselExampleControls_'.$roommates_free.'" role="button" data-slide="next">
                                                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                  <span class="sr-only">Next</span>
                                                                </a>
                                                              </div>   
                                                            </div>                            

                                                            <div class="room_detail">
                                                              <h4>Codigo de Habitación '.$roommates_free.'</h4>
                                                              
                                                                <div class="room_noches_total">
                                                                  <h4>Total noches: </h4>
                                                                  <p> '.$diff_days.'</p>
                                                                  <input type="hidden" name="night" value="'.$diff_days.'">
                                                                </div>
                                                                <h2>'.$roommates_free_r.'</h2>
                                                                <input type="hidden" name="tipo_hab" value="'.$roommates_free_r.'">
                                                                <p>'.$roommates_free_d.'</p>
                                                            </div>
                                                            <div class="room_valor">
                                                                <h4>Valor por noche</h4>
                                                                <h2>Precio</h2>
                                                                <p>$ '.$roommates_free_v.'</p>
                                                                <p>Agregar</p>
                                                                <input type="radio" id="price_btt" name="room" value="'.$roommates_free.'">
                                                                
                                                            </div>  
                                                          </div>


                                              ';      
                                              return $roommates_free_p;
}

/* Respecto a funcion extra, se solicita a "extra" si existen habitaciones, se cargaran los extras y se cargara el formulario previo a una evaluacion en
get_products que evaluará no tener respuestas false de search_hab_standard junto a search_hab_roommates, la vista que genera "extra" es diferente a la vista que 
genera   */
public function extra(){

                       $extras = $this->db->query("SELECT * FROM `extras`");
                       $ex = "";
                       $exheader ="";
                       $exheader .="
                                <br>
                       ";


                       foreach ($extras->fetch_all(MYSQLI_ASSOC) as $key) {

                          $total_extras=$key['precio_peso'];
                          $ruta=$key['ruta_multimedia'];
                          
                          $ex .= '
                                 <div class="wrap_extra">  
                                          <div class="room_foto">
                                            '.$ruta.'
                                           </div>
                                          <div class="room_detail">
                                                    <h4>Codigo de extra '.$key['code'].'</h4>
                                                    <div class="room_noches_total">
                                                      <input type="hidden" name="code_ex_'.$key['code'].'" value="'.$key['precio_peso'].'">
                                                    </div>
                                                    <h2>'.$key['nombre'].'</h2>
                                                    <p>'.$key['descripcion'].'</p>
                                          </div>
                                          <div class="room_valor">
                                              <h2>Precio</h2>
                                              <p>$ '.$key['precio_peso'].'</p>
                                              <input type="number" onChange="val_'.$key['code'].'();"  id="c_'.$key['code'].'" name="cant_ex_'.$key['code'].'" value="0" min="0" max="'.$key['max'].'">
                                              <input type="hidden" id="ch_'.$key['code'].'" onClick="val_'.$key['code'].'();" name="price_ex_'.$key['code'].'" value="'.$total_extras.'"disabled >
                                          </div>
                                  </div>
                              

                                
                          ';


                       }


                        echo $ex;
                        echo "<br>";
                        echo '
                      <div class="form-row form_reserv">
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom01">Nombre/First name</label>
                          <input type="text" name="first" class="form-control" id="validationCustom01" placeholder="Nombre / First name" value="" pattern="[A-Za-z ]+" required>
                          <div class="valid-feedback">
                            ¡Bien!
                          </div>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom02">Apellido/Last name</label>
                          <input type="text" name="lastname" class="form-control" id="validationCustom02" placeholder="Apellido / Last name" value="" pattern="[A-Za-z ]+" required>
                          <div class="valid-feedback">
                            ¡Bien!
                          </div>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                        <label for="exampleFormControlInput1">Mail/Email address</label>
                        <input type="email" name="mail" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
                      </div>
                      </div>
                      <div class="form-row  form_reserv">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom03">Ciudad/City</label>
                          <input type="text" name="city" class="form-control" id="validationCustom03" placeholder="Ciudad / City" pattern="[A-Za-z ]+" required>
                          <div class="invalid-feedback">
                            Por favor provee una ciudad válida / Please provide a valid city.
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationCustom04">Estado / State</label>
                          <input type="text" name="state"class="form-control" id="validationCustom04" placeholder="Estado / State" pattern="[A-Za-z ]+" required>
                          <div class="invalid-feedback">
                            Por favor provee un estado válido / Please provide a valid state.
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationCustom05">País / Country</label>
                          
                          <select name="country" id="validationCustom05" class="form-control" required>
                                <option value=""></option>
                                <option value="Afganistán ">Afganistán </option>
                                <option value="Akrotiri ">Akrotiri </option>
                                <option value="Albania ">Albania </option>
                                <option value="Alemania ">Alemania </option>
                                <option value="Andorra ">Andorra </option>
                                <option value="Angola ">Angola </option>
                                <option value="Anguila ">Anguila </option>
                                <option value="Antártida ">Antártida </option>
                                <option value="Antigua y Barbuda ">Antigua y Barbuda </option>
                                <option value="Antillas Neerlandesas ">Antillas Neerlandesas </option>
                                <option value="Arabia Saudí ">Arabia Saudí </option>
                                <option value="Arctic Ocean ">Arctic Ocean </option>
                                <option value="Argelia ">Argelia </option>
                                <option value="Argentina ">Argentina </option>
                                <option value="Armenia ">Armenia </option>
                                <option value="Aruba ">Aruba </option>
                                <option value="Ashmore andCartier Islands ">Ashmore andCartier Islands </option>
                                <option value="Atlantic Ocean ">Atlantic Ocean </option>
                                <option value="Australia ">Australia </option>
                                <option value="Austria ">Austria </option>
                                <option value="Azerbaiyán ">Azerbaiyán </option>
                                <option value="Bahamas ">Bahamas </option>
                                <option value="Bahráin ">Bahráin </option>
                                <option value="Bangladesh ">Bangladesh </option>
                                <option value="Barbados ">Barbados </option>
                                <option value="Bélgica ">Bélgica </option>
                                <option value="Belice ">Belice </option>
                                <option value="Benín ">Benín </option>
                                <option value="Bermudas ">Bermudas </option>
                                <option value="Bielorrusia ">Bielorrusia </option>
                                <option value="Birmania Myanmar ">Birmania Myanmar </option>
                                <option value="Bolivia ">Bolivia </option>
                                <option value="Bosnia y Hercegovina ">Bosnia y Hercegovina </option>
                                <option value="Botsuana ">Botsuana </option>
                                <option value="Brasil ">Brasil </option>
                                <option value="Brunéi ">Brunéi </option>
                                <option value="Bulgaria ">Bulgaria </option>
                                <option value="Burkina Faso ">Burkina Faso </option>
                                <option value="Burundi ">Burundi </option>
                                <option value="Bután ">Bután </option>
                                <option value="Cabo Verde ">Cabo Verde </option>
                                <option value="Camboya ">Camboya </option>
                                <option value="Camerún ">Camerún </option>
                                <option value="Canadá ">Canadá </option>
                                <option value="Chad ">Chad </option>
                                <option value="Chile ">Chile </option>
                                <option value="China ">China </option>
                                <option value="Chipre ">Chipre </option>
                                <option value="Clipperton Island ">Clipperton Island </option>
                                <option value="Colombia ">Colombia </option>
                                <option value="Comoras ">Comoras </option>
                                <option value="Congo ">Congo </option>
                                <option value="Coral Sea Islands ">Coral Sea Islands </option>
                                <option value="Corea del Norte ">Corea del Norte </option>
                                <option value="Corea del Sur ">Corea del Sur </option>
                                <option value="Costa de Marfil ">Costa de Marfil </option>
                                <option value="Costa Rica ">Costa Rica </option>
                                <option value="Croacia ">Croacia </option>
                                <option value="Cuba ">Cuba </option>
                                <option value="Dhekelia ">Dhekelia </option>
                                <option value="Dinamarca ">Dinamarca </option>
                                <option value="Dominica ">Dominica </option>
                                <option value="Ecuador ">Ecuador </option>
                                <option value="Egipto ">Egipto </option>
                                <option value="El Salvador ">El Salvador </option>
                                <option value="El Vaticano ">El Vaticano </option>
                                <option value="Emiratos Árabes Unidos ">Emiratos Árabes Unidos </option>
                                <option value="Eritrea ">Eritrea </option>
                                <option value="Eslovaquia ">Eslovaquia </option>
                                <option value="Eslovenia ">Eslovenia </option>
                                <option value="España ">España </option>
                                <option value="Estados Unidos ">Estados Unidos </option>
                                <option value="Estonia ">Estonia </option>
                                <option value="Etiopía ">Etiopía </option>
                                <option value="Filipinas ">Filipinas </option>
                                <option value="Finlandia ">Finlandia </option>
                                <option value="Fiyi ">Fiyi </option>
                                <option value="Francia ">Francia </option>
                                <option value="Gabón ">Gabón </option>
                                <option value="Gambia ">Gambia </option>
                                <option value="Gaza Strip ">Gaza Strip </option>
                                <option value="Georgia ">Georgia </option>
                                <option value="Ghana ">Ghana </option>
                                <option value="Gibraltar ">Gibraltar </option>
                                <option value="Granada ">Granada </option>
                                <option value="Grecia ">Grecia </option>
                                <option value="Groenlandia ">Groenlandia </option>
                                <option value="Guam ">Guam </option>
                                <option value="Guatemala ">Guatemala </option>
                                <option value="Guernsey ">Guernsey </option>
                                <option value="Guinea ">Guinea </option>
                                <option value="Guinea Ecuatorial ">Guinea Ecuatorial </option>
                                <option value="Guinea-Bissau ">Guinea-Bissau </option>
                                <option value="Guyana ">Guyana </option>
                                <option value="Haití ">Haití </option>
                                <option value="Honduras ">Honduras </option>
                                <option value="Hong Kong ">Hong Kong </option>
                                <option value="Hungría ">Hungría </option>
                                <option value="India ">India </option>
                                <option value="Indian Ocean ">Indian Ocean </option>
                                <option value="Indonesia ">Indonesia </option>
                                <option value="Irán ">Irán </option>
                                <option value="Iraq ">Iraq </option>
                                <option value="Irlanda ">Irlanda </option>
                                <option value="Isla Bouvet ">Isla Bouvet </option>
                                <option value="Isla Christmas ">Isla Christmas </option>
                                <option value="Isla Norfolk ">Isla Norfolk </option>
                                <option value="Islandia ">Islandia </option>
                                <option value="Islas Caimán ">Islas Caimán </option>
                                <option value="Islas Cocos ">Islas Cocos </option>
                                <option value="Islas Cook ">Islas Cook </option>
                                <option value="Islas Feroe ">Islas Feroe </option>
                                <option value="Islas Georgia del Sur y Sandwich del Sur ">Islas Georgia del Sur y Sandwich del Sur </option>
                                <option value="Islas Heard y McDonald ">Islas Heard y McDonald </option>
                                <option value="Islas Malvinas ">Islas Malvinas </option>
                                <option value="Islas Marianas del Norte ">Islas Marianas del Norte </option>
                                <option value="IslasMarshall ">IslasMarshall </option>
                                <option value="Islas Pitcairn ">Islas Pitcairn </option>
                                <option value="Islas Salomón ">Islas Salomón </option>
                                <option value="Islas Turcas y Caicos ">Islas Turcas y Caicos </option>
                                <option value="Islas Vírgenes Americanas ">Islas Vírgenes Americanas </option>
                                <option value="Islas Vírgenes Británicas ">Islas Vírgenes Británicas </option>
                                <option value="Israel ">Israel </option>
                                <option value="Italia ">Italia </option>
                                <option value="Jamaica ">Jamaica </option>
                                <option value="Jan Mayen ">Jan Mayen </option>
                                <option value="Japón ">Japón </option>
                                <option value="Jersey ">Jersey </option>
                                <option value="Jordania ">Jordania </option>
                                <option value="Kazajistán ">Kazajistán </option>
                                <option value="Kenia ">Kenia </option>
                                <option value="Kirguizistán ">Kirguizistán </option>
                                <option value="Kiribati ">Kiribati </option>
                                <option value="Kuwait ">Kuwait </option>
                                <option value="Laos ">Laos </option>
                                <option value="Lesoto ">Lesoto </option>
                                <option value="Letonia ">Letonia </option>
                                <option value="Líbano ">Líbano </option>
                                <option value="Liberia ">Liberia </option>
                                <option value="Libia ">Libia </option>
                                <option value="Liechtenstein ">Liechtenstein </option>
                                <option value="Lituania ">Lituania </option>
                                <option value="Luxemburgo ">Luxemburgo </option>
                                <option value="Macao ">Macao </option>
                                <option value="Macedonia ">Macedonia </option>
                                <option value="Madagascar ">Madagascar </option>
                                <option value="Malasia ">Malasia </option>
                                <option value="Malaui ">Malaui </option>
                                <option value="Maldivas ">Maldivas </option>
                                <option value="Malí ">Malí </option>
                                <option value="Malta ">Malta </option>
                                <option value="Man, Isle of ">Man, Isle of </option>
                                <option value="Marruecos ">Marruecos </option>
                                <option value="Mauricio ">Mauricio </option>
                                <option value="Mauritania ">Mauritania </option>
                                <option value="Mayotte ">Mayotte </option>
                                <option value="México ">México </option>
                                <option value="Micronesia ">Micronesia </option>
                                <option value="Moldavia ">Moldavia </option>
                                <option value="Mónaco ">Mónaco </option>
                                <option value="Mongolia ">Mongolia </option>
                                <option value="Montserrat ">Montserrat </option>
                                <option value="Mozambique ">Mozambique </option>
                                <option value="Namibia ">Namibia </option>
                                <option value="Nauru ">Nauru </option>
                                <option value="Navassa Island ">Navassa Island </option>
                                <option value="Nepal ">Nepal </option>
                                <option value="Nicaragua ">Nicaragua </option>
                                <option value="Níger ">Níger </option>
                                <option value="Nigeria ">Nigeria </option>
                                <option value="Niue ">Niue </option>
                                <option value="Noruega ">Noruega </option>
                                <option value="Nueva Caledonia ">Nueva Caledonia </option>
                                <option value="Nueva Zelanda ">Nueva Zelanda </option>
                                <option value="Omán ">Omán </option>
                                <option value="Pacific Ocean ">Pacific Ocean </option>
                                <option value="Países Bajos ">Países Bajos </option>
                                <option value="Pakistán ">Pakistán </option>
                                <option value="Palaos ">Palaos </option>
                                <option value="Panamá ">Panamá </option>
                                <option value="Papúa-Nueva Guinea ">Papúa-Nueva Guinea </option>
                                <option value="Paracel Islands ">Paracel Islands </option>
                                <option value="Paraguay ">Paraguay </option>
                                <option value="Perú ">Perú </option>
                                <option value="Polinesia Francesa ">Polinesia Francesa </option>
                                <option value="Polonia ">Polonia </option>
                                <option value="Portugal ">Portugal </option>
                                <option value="Puerto Rico ">Puerto Rico </option>
                                <option value="Qatar ">Qatar </option>
                                <option value="Reino Unido ">Reino Unido </option>
                                <option value="República Centroafricana ">República Centroafricana </option>
                                <option value="República Checa ">República Checa </option>
                                <option value="República Democrática del Congo ">República Democrática del Congo </option>
                                <option value="República Dominicana ">República Dominicana </option>
                                <option value="Ruanda ">Ruanda </option>
                                <option value="Rumania ">Rumania </option>
                                <option value="Rusia ">Rusia </option>
                                <option value="Sáhara Occidental ">Sáhara Occidental </option>
                                <option value="Samoa ">Samoa </option>
                                <option value="Samoa Americana ">Samoa Americana </option>
                                <option value="San Cristóbal y Nieves ">San Cristóbal y Nieves </option>
                                <option value="San Marino ">San Marino </option>
                                <option value="San Pedro y Miquelón ">San Pedro y Miquelón </option>
                                <option value="San Vicente y las Granadinas ">San Vicente y las Granadinas </option>
                                <option value="Santa Helena ">Santa Helena </option>
                                <option value="Santa Lucía ">Santa Lucía </option>
                                <option value="Santo Tomé y Príncipe ">Santo Tomé y Príncipe </option>
                                <option value="Senegal ">Senegal </option>
                                <option value="Seychelles ">Seychelles </option>
                                <option value="Sierra Leona ">Sierra Leona </option>
                                <option value="Singapur ">Singapur </option>
                                <option value="Siria ">Siria </option>
                                <option value="Somalia ">Somalia </option>
                                <option value="Southern Ocean ">Southern Ocean </option>
                                <option value="Spratly Islands ">Spratly Islands </option>
                                <option value="Sri Lanka ">Sri Lanka </option>
                                <option value="Suazilandia ">Suazilandia </option>
                                <option value="Sudáfrica ">Sudáfrica </option>
                                <option value="Sudán ">Sudán </option>
                                <option value="Suecia ">Suecia </option>
                                <option value="Suiza ">Suiza </option>
                                <option value="Surinam ">Surinam </option>
                                <option value="Svalbard y Jan Mayen ">Svalbard y Jan Mayen </option>
                                <option value="Tailandia ">Tailandia </option>
                                <option value="Taiwán ">Taiwán </option>
                                <option value="Tanzania ">Tanzania </option>
                                <option value="Tayikistán ">Tayikistán </option>
                                <option value="TerritorioBritánicodel Océano Indico ">TerritorioBritánicodel Océano Indico </option>
                                <option value="Territorios Australes Franceses ">Territorios Australes Franceses </option>
                                <option value="Timor Oriental ">Timor Oriental </option>
                                <option value="Togo ">Togo </option>
                                <option value="Tokelau ">Tokelau </option>
                                <option value="Tonga ">Tonga </option>
                                <option value="Trinidad y Tobago ">Trinidad y Tobago </option>
                                <option value="Túnez ">Túnez </option>
                                <option value="Turkmenistán ">Turkmenistán </option>
                                <option value="Turquía ">Turquía </option>
                                <option value="Tuvalu ">Tuvalu </option>
                                <option value="Ucrania ">Ucrania </option>
                                <option value="Uganda ">Uganda </option>
                                <option value="Unión Europea ">Unión Europea </option>
                                <option value="Uruguay ">Uruguay </option>
                                <option value="Uzbekistán ">Uzbekistán </option>
                                <option value="Vanuatu ">Vanuatu </option>
                                <option value="Venezuela ">Venezuela </option>
                                <option value="Vietnam ">Vietnam </option>
                                <option value="Wake Island ">Wake Island </option>
                                <option value="Wallis y Futuna ">Wallis y Futuna </option>
                                <option value="West Bank ">West Bank </option>
                                <option value="World ">World </option>
                                <option value="Yemen ">Yemen </option>
                                <option value="Yibuti ">Yibuti </option>
                                <option value="Zambia ">Zambia </option>
                                <option value="Zimbabue ">Zimbabue </option>

                          </select>
                          <div class="invalid-feedback">
                            Eligue un país valido / Choose a valid  country
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-row form_reserv ">
                        <div class="col-md-3 mb-3">
                        <label for="validationCustom04">Telefono / Phone</label>
                        <input type="text" name="phone" class="form-control" id="validationCustom07" placeholder="Ejemplo: 56962388xx" minlength="5" maxlength="15" pattern="[0-9 ]+" required>
                        <div class="invalid-feedback">
                          Por favor provee un número válido / Please provide a valid state.
                        </div>
                      </div>
                      </div>
                      <div class="form-group form_reserv">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                          <label class="form-check-label" for="invalidCheck">
                            Acepto términos y condiciones / Agree to terms and conditions
                          </label>
                          <div class="invalid-feedback">
                            Debes estar de acuerdo a los terminos / You must agree before submitting.
                          </div>
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target=".bd-example-modal-xl">Terminos y Condiciones</button>

                          <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                                <div class="container mt-3">
                                  <h3>TERMINOS Y CONDICIONES OUTDOOR PATAGONIA</h3>
                                  <p>CHECK-IN/CHECK-OUT<br>
                                  Check-in u hora de entrada es a más tardar a las 10:00 p.m.<br>
                                  Check-out u hora de salida es a las 11:00 a.m.<br>
                                  Salidas después de las 11:00 a.m. serán sujetos a un cargo del 50 %<br><br>
                                  <p/>
                                  <h4>Políticas de cancelación de reservas</h4>
                                  <p>Para cualquier solicitud de anulación o cancelación de una reserva efectuada por el “beneficiario”, se entenderá que la reserva está anulada una vez que el correo oficial de Outdoor Patagonia (reservas@outdoorpatagonia.cl)  envíe la confirmación oficial de anulación vía correo electrónico con el código correspondiente para tal efecto. Cancelaciones sin código y email de respaldo no serán válidas.</p>
                                  <h4>Confirmación</h4>
                                  <p>Para confirmar una reserva, una tarjeta de crédito válida es necesaria. Si no puede entregar o no dispone una de una TC, es posible realizar un depósito o transferencia por el total de la reserva. Se considerará confirmada la reserva luego del pago del 50% del total de la estadía y extras.</p>
                                  <h4>Prepago</h4>
                                  <p>Las reservas deben ser pre-pagadas a más tardar 15 días antes de la llegada. Se aceptará 50% de la reserva a la tarjeta de crédito entregada. Restando el 50% pagando en counter<br>
                                  Las reservas deben ser pre-pagadas a más tardar 15 días antes de la llegada. Se aceptará 50% de la reserva a la tarjeta de crédito entregada. Restando el 50% pagando en counter.<br>
                                  Políticas de anulación Individuales: Temporada (Diciembre a Abril):<br>
                                  </p>
                                  <h4>No Show</h4>
                                  <p>Cobro No Show. En caso que el pasajero NO se presente el día confirmado en su reserva, se cobrará como multa el 100% de la reserva pre-pagado, el cual no será devuelto al pasajero.
                                  Anulaciones por condiciones climáticas o desastres naturales</p>
                                  <p>En caso de cancelaciones de reserva por condiciones climáticas o desastres naturales, se les dará solo la opción de cambiar la fecha sin cobro adicional dentro de los tres meses siguientes a la fecha de entrada.</p>
                                  <p>No se permite ingresar al Hotel con lo siguiente:</p>
                                  <p>Mascotas, alimentos y bebidas alcohólicas.</p>
                                  <p>Almohadas, sábanas, edredones u otras vestiduras de cama.</p>
                                  <p>Aparatos eléctricos y/o equipo para calentar y/o cocinar.</p>
                                  <p>Hotel Mousai se reserva el derecho de eliminar y/o confiscar cualquiera de los artículos mencionados si se encuentra dentro de cualquier habitación de manera inmediata sin previo aviso y de cobrarle por los costos incurridos para tomar esa medida.</p>
                                  <p>Comportamiento del Huésped Se espera que se comporte de una manera ordenada y aceptable en todo momento y no perturbar el goce de los demás Huéspedes. Nos reservamos el derecho de terminar inmediatamente su reserva y la reserva de los miembros de su grupo si llegáramos (actuando razonablemente) a considerar su conducta como una infracción de esta cláusula.</p>
                                  <p>Las conductas que consideramos razonablemente inapropiadas incluyen, pero no se limitan a:
                                      Niveles inapropiados de ruido o disturbios.</p>
                                  <p>Cualquier comportamiento que parezca ofensivo a otros Huéspedes o colaboradores.</p>
                                  <p>En todo momento actuaremos razonable al tomar cualquier determinación en virtud de la presente cláusula.</p>
                                  <p>En caso de que cancelemos su reserva, usted será obligado a abandonar su alojamiento inmediatamente. Será responsable de cualquier daño o pérdida causado por usted o un miembro de su grupo. El pago total por cualquier daño o pérdida debe ser pagado antes de su partida. Si usted no puede hacer el pago, usted será responsable del cumplimiento de cualquier reclamo (incluyendo costos legales) realizadas con posterioridad en contra de nosotros como resultado de sus acciones junto con todos los gastos en los que incurrimos en la búsqueda de cualquier demanda en su contra.</p>
                                  <p>Nuestras obligaciones hacia usted culminan cuando la reserva se termina. No tendremos ninguna obligación con el reembolso para el alojamiento perdido y no somos responsables por los gastos o costos incurridos como resultado de la terminación.
                                  </p>


                                  <h3>Habitacion Standard</h3>
                                  <p>Habitación doble con baño privado, desayuno Patagónico incluido. </p>
                                  <p>Incluimos camas KING muy confortables  para proporcionarle al cliente comodidad y bienestar en su estadía. Nuestras habitaciones Standard están equipadas con señal de internet  de última generación, calefacción, servicios de  de ropa blanca, baños de última línea y  ropa de cama de 300 hilos, diseñadas rústicamente con retoques propicios para dar un ambiente agradable y acogedor al aventurero que nos visita.</p>
                                  <p>En nuestro Hostal encontrarás complementos como servicio de Restaurant con una carta que nos entrega un menú amplio y variado, adecuado para todo tipo de gustos, preferencias y dietas. Servicios de excursiones de aventura, para que puedas programar tu viaje de la mejor manera.
                                      Habitaciones matrimoniales con baño privado para dos personas, desayuno incluido.
                                      Consulta por capacidad extra en cada habitación.
                                  </p>
                                  <h3>Roommate</h3>
                                  <p>Habitaciones privadas con baños compartidos <br>
                                      2  personas todas las habitaciones tendrán capacidad para dos <br>
                                      2  personas <br>
                                      2  personas <br>
                                      </p>
                                  <p>Todas nuestras habitaciones privadas singles contemplan espacios cómodos y confortables para hacerle pasar al pasajero una agradable estadía en nuestras instalaciones. Nuestros espacios comunes son el patio, la sala de estar constituidos por cómodos muebles. Incluimos en nuestro Hostal servicios de restaurant el cuya contempla una variada carta adecuada para todo tipo de gustos, preferencias y dietas, haciendo así un lugar completo donde no necesitas trasladarte mucho para conseguir  lo necesario para tu visita. Reserva con nosotros paquetes de aventuras donde podemos ayudarte a planear unos días maravillosos llenos de  experiencias inolvidables.</p>
                                  <p>
                                      Nuestras habitaciones privadas comparten dos baños los cuales están equipados con lo necesario para proporcionarle al turista  confort y bienestar. La ropa de cama es de 300 hilos al igual que las toallas y demás cosas que se le proporciona al pasajero para su estadía.</p>


                                  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                               ';
                        echo '<input type="submit" class="btn btn-success btn-lg" name="nextpay"  id="env" value="Pagar Reserva"><br><br>';
}
  
/*respecto a search_hab_standard -> realiza la busqueda de la habitacion roomates, trae un objeto-tipo-consulta-sql- desde get_products, 
genera un array en columna, realiza la busqueda dentro del array ya ordenado y retorna un valor  false o una variable con el numero de habitacion 
disponible.*/
public function search_hab_standard($array_aux_standard){
    $s="<br><br><br>";
    $h_101='101';
    $h_102="102";
    $h_103='103';
    $v_101='';
    $v_102='';
    $v_103='';
    $i=0;
    $arrayauxiliar=array();  
    while($array=$array_aux_standard->fetch_ALL()){

                $claves = array_keys($array);
                
                foreach ($claves as $clave){

                    $arrayauxiliar[]=$array[$clave];
               
                }
                $i++;
              }

              $col=array_column($arrayauxiliar, '0');
              
           
                

              if(!in_array($h_101, $col)){

               return $h_101;

              }elseif(!in_array($h_102, $col)){
                return $h_102;
                
              }elseif(!in_array($h_103, $col)){
                
                return $h_103;
                
              } return false;
}


/*respecto a search_hab_roomates -> realiza la busqueda de la habitacion roomates, trae un objeto-tipo-consulta-sql- desde get_products, 
genera un array en columna, realiza la busqueda dentro del array ya ordenado, retorna un valor ya false o una variable con el numero de habitacion 
disponible*/
public function search_hab_roommates($array_aux){

  
    $s="<br><br><br>";
    $h_104='104';
    $h_105="105";
    $h_106='106';
    $v_104='';
    $v_105='';
    $v_106='';
    $i=0;
    $arrayauxiliar_s=array();  
    while($array=$array_aux->fetch_ALL()){

                $claves = array_keys($array);
                
                foreach ($claves as $clave){

                    $arrayauxiliar_s[]=$array[$clave];
               
                }
                $i++;
              }

              
              $col=array_column($arrayauxiliar_s, '0');
              

              if(!in_array($h_104, $col)){

               return $h_104;

              }elseif(!in_array($h_105, $col)){
                return $h_105;
                
              }elseif(!in_array($h_106, $col)){
                
                return $h_106;
                
              } return false;
}

/* respecto a get_products Realiza la consulta principal con metodo CAST. realiza una primero consulta por categoria y pasa esa consulta a
las funciones respectivas.posterior a eso realiza un evaluacion al retornar el valor de la funcion de busqueda en array, finalmente despues de esa
evaluacion se pasa a la funcion "rooms" que se encarga de generar la vista para la o las habitaciones desocupads. Por otro lado si los retornos 
de las funciones son false arrojara una respuesta de "no hay habitaciones disponibles" */
public function get_products(){ 


     $s="<br>";
                    //recepcion de consulta de fecha y formateo de fecha

                    $fechain= $_POST['start'];
                    $fechaout=$_POST['end'];

                    

                    $resin = new Datetime($fechain);


                    $checkin = $resin->format('Y-m-d');

                    $resout = new datetime($fechaout);  
                    $checkout = $resout->format('Y-m-d');

                    $froom = $checkin;
                    $too= $checkout; 
                        
                    //se realiza el calculo de cantidad de dias que se consultan
                    $diff = $resin->diff($resout);
                    $sql_1=$this->db->query("SELECT codigo from test where (CAST(froom AS DATE)  between '$froom' and  '$too' )or ( CAST(too AS DATE)  between '$froom' and '$too')or ((CAST(froom AS DATE)<'$froom')and(CAST(too AS DATE)> '$froom'))or((CAST(too AS DATE)>'$too')and(CAST(froom AS DATE)< '$too'))");
                   
                     $sql_2=$this->db->query("SELECT codigo from test where (CAST(froom AS DATE)  between '$froom' and  '$too' )or ( CAST(too AS DATE)  between '$froom' and '$too')or ((CAST(froom AS DATE)<'$froom')and(CAST(too AS DATE)> '$froom'))or((CAST(too AS DATE)>'$too')and(CAST(froom AS DATE)< '$too'))");
                    $dif_days=$diff->days;

                                      echo "<h2>Disponibilidad entre: ".$froom." y ".$too.".</h2>";
                                      echo "<input type='hidden' name='fechain' value=' ".$froom." '>";
                                      echo "<input type='hidden' name='fechaout'  value='".$too."'>";                     
                    


                  
                  $standard_free=$this->search_hab_standard($sql_1);
                  $roommates_free=$this->search_hab_roommates($sql_2);                        
                
                

                  if ($standard_free===false) {
                    
                    
                  }
                  else{
                    
                      echo $this->rooms($standard_free,$dif_days);
                   
                  }
                  if ($roommates_free===false) {
                    
                    
                  }
                  else{

                      echo $this->rooms($roommates_free,$dif_days);
                   
                  }

                
                  if ($standard_free or $roommates_free) {
                    echo $this->extra();
                    }  
                    else{
                      echo "<br><br>no tenemos habitaciones disponibles en esta fecha";
                    }


} //fin de la funcion
      

} //fin de la construccion

    