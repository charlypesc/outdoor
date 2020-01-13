<?php

include "administracion/conexion.php";
include "administracion/config.php";

                  $id_aviso='1';
                  $sql_aviso="SELECT * FROM aviso WHERE id= $id_aviso";
                  $resultado=$base->prepare($sql_aviso);
                  $resultado->execute();

                  while($registrado=$resultado->fetch(PDO::FETCH_ASSOC)){

                    $aviso=$registrado['publicando_aviso'];
                    $aviso=rawurldecode(str_replace("%0D%0A","<br>",$aviso));


          }
              
?>

<html>
  <head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><meta http-equiv="Expires" content="-1">
<meta http-equiv="Last-Modified" content="-1">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta property="og:url" content="http://www.elibertad.cl"/>
<meta property="og:type" content="article" />
<meta property="og:title" content="Aviso a la comunidad y más"/>
<meta property="og:description" content="<?php echo $aviso;?> Más info en nuestra pagina oficial" />
<meta property="og:image" content="http://www.elibertad.cl/img/index/escuela1.jpg" />
<script src="/pace/pace.js"></script>
<link href="/pace/themes/pace-theme-loading-bar.css" rel="stylesheet" />
    <title>Escuela Libertad Puerto Montt</title>    
    <link rel="stylesheet" href="css/ini.css?030920189"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css"/>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/slide.js"></script>
    <script src="js/owl.carousel.min.js"> </script>
  </head>            
  <body id="portada">
    <?php

      // ----------Header----------------
      include "_header_index_principal.php";


    ?>


      <div id="slide">
        <div class="slideshow">
          <section class="progcontenedor">
            <nav class="menu__dos"><a href="electromecanica.html"><img src="img/nav2/02_electromecanica-1.png" alt=""/></a>                                              <a href="/madera.html"><img src="/img/nav2/01_madera.png" alt=""/></a>                                              <a href="/costura.html"><img src="/img/nav2/03_costura.png" alt=""/></a>                                              <a href=""></a></nav>
          </section>
          <ul class="slider">
          	<li><img src="ini/img/ini_18.jpg" alt=""/></li>
          	<li><img src="ini/img/ini_1_18.jpg" alt=""/></li>
            <li><img src="ini/img/orquesta_2018.jpg" alt=""/></li>
            <li><img src="ini/img/00_0.jpg" alt=""/></li>
            <li><img src="ini/img/00_2.jpg" alt=""/></li>
            <li><img src="ini/img/olimpiadas_copa_1.jpg" alt=""/></li>
            <li><img src="ini/img/01_0.jpg" alt=""/></li>
            <li><img src="ini/img/05_5.jpg" alt=""/></li>
            <div class="avisoi">
              <h1>Aviso a la Comunidad:</h1>
              <p>
<?php 
                  

                if($aviso==""){

                  echo "<style>body .wrap #slide .slideshow .avisoi{display:none;}</style>";

                }else{

                  echo "<style>body .wrap #slide .slideshow .avisoi{display:flex;}{display:flex;}</style>";
                  echo $aviso;

                }

                ?>

              </p>
            </div>
          </ul>                                                                    
          <ol class="pagination"></ol>                                                                    
          <div class="left"><span class="icon-chevron-left"></span></div>                                                                    
          <div class="right"><span class="icon-chevron-right"></span></div>
        </div>
      </div>
      <!-- FIN DE AVISO-->
      <!--Panel de Actividades-->

      <?php
            $idflip='1';
            $sqlflip="SELECT * FROM panelflip WHERE id= $idflip";
            $resultado_flip=$base->prepare($sqlflip);
            $resultado_flip->execute();

            while($registrado_flip=$resultado_flip->fetch(PDO::FETCH_ASSOC)){

            
            $flip=$registrado_flip['flip'];  
            $panel=$registrado_flip['panel'];
            $panel=rawurldecode(str_replace("%0D%0A","<br>",$panel));

            

            }
              
      ?>
<?php
      if($flip==""){

                  echo "<style>body #flip {display:none;}</style>";

                }else{

                  echo "<style>#flip{display:flex;}</style>";
                  

                }

?>
        
      <div id="flip">
        <button class="accordion"><?php echo $flip;?><i id="ic" class="fa fa-arrow-circle-down"></button></i>
        <div class="panel"><?php $panel=rawurldecode(str_replace("%0D%0A","<br>",$panel));  echo $panel; ?></div>
        
      </div>
<script language="javascript">
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            
            this.classList.toggle("active");

            
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
                document.getElementById("ic").className = "fa fa-arrow-circle-down";
            } else {
                panel.style.display = "block";
                document.getElementById("ic").className = "fa fa-arrow-circle-up";
            }
        });
    }
</script>

      <section id="contenedor2">
        <div class="bienvenidos">
          <div class="logo"><img src="img/logos/insignia.png" alt=""/></div>
          <div class="parr1">
            <p><span>&iexcl;Bienvenidos!</span><br/>Escuela Libertad te invita a formar parte de nuestra comunidad, en la escuela de las oportunidades contamos con programas propios, que permitir&aacute;n tener nociones b&aacute;sicas relacionadas al mundo laboral.</p>
          </div>
        </div>                                           
        <div class="mision">
          <div class="parr1">
            <p><span>Nuestra Misi&oacute;n:</span><br/>La Escuela Libertad tiene como misi&oacute;n formar estudiantes con valores, actitudes y esp&iacute;ritu de superaci&oacute;n, atendiendo la  diversidad, mediante el Proyecto Educativo Institucional que fomente la inclusividad y el desarrollo de actividades y habilidades curriculares</p><a href="/ProyectoEducativo.html">[Leer M&aacute;s]</a>
          </div>
        </div>
        <div class="google__map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2990.1507416605045!2d-72.94828638457203!3d-41.45764577925782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x96183b024d680e97%3A0xea1d309b64cf7210!2sEscuela+Libertad!5e0!3m2!1ses-419!2scl!4v1511476515429" width="300" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>	</div>
        <div class="anibal"><img src="ini/img/anibal.png" alt="anibal"/></div>
      </section>
      <div class="titu"><img class="barra_not" src="/img/pueblos_originarios/barra.gif" alt=""/>
        <h1>Noticias y Eventos:</h1>
      </div>
      <?php
            
                
              $registros=$base->query("SELECT * FROM carrusel ORDER BY id desc")->fetchAll(PDO::FETCH_OBJ);



      ?>
      <div class="owl-carousel">
      <?php foreach ($registros as $not): ?>
        <div>
          <h5><?php echo $not->fecha?></h5>
          <a href="administracion/not.php?id=<?php echo $not->id;?>"><img src="<?php echo $ruta_archivos_dos.$not->img_carrusel?>"/></a>
          <h2><a href="administracion/not.php?id=<?php echo $not->id;?>"><?php echo $not->encabezado_carrusel?></a></h2>
          <h3><?php echo $not->resena_carrusel?></h3>
        </div>
      <?php endforeach ?>
      </div>
    
      
      <!-- -------------------------------Fin de Noticias ---------------------------------------->

      
      <div class="titu"><img class="barra_not" src="/img/pueblos_originarios/barra.gif" alt=""/>
        <h1>Material Multimedia:</h1>
      </div>
      <section id="pueblosoriginarios">
        <div class="slider_po">
          <li>
            <div class="bannerdicc"><img class="fran" src="img/pueblos_originarios/fran.png" alt=""/><a href="PO/pueblos_originarios.html"><img class="titdicc" src="img/pueblos_originarios/cabecera_diccionario.png" alt=""/></a><img class="tomas" src="img/pueblos_originarios/tomy_aylin_juli.png" alt=""/><img class="michelle" src="img/pueblos_originarios/michelle.png" alt=""/></div>
          </li>
          <li>
            <div class="po">
              <h1>¡Conoce nuestro diccionario!</h1>
              <h2>¿Que zona quieres conocer?</h2>
            </div>
            <div class="menu__dos">
              <div class="norte_uno"><a href="../PO/Znorte.html">Zona Norte</a></div>
              <div class="central_dos"><a href="../PO/Zcentral.html">Zona Central</a></div>
              <div class="sur_tres"><a href="../PO/Zsur.html">Zona Sur</a></div>
            </div>
          </li>
        </div>
        <ol class="pagina">                                                                    </ol>
        <div class="left_po"><span class="icon-chevron-left"></span>                                                                    </div>
        <div class="right_po"><span class="icon-chevron-right"> </span></div>
      </section>
      <footer>
        <div class="direccion"><span class="icon-compass"></span>
          <p></p>
          <h1>Direccion: Iquique 230, Poblaci&oacute;n Libertad - Puerto Montt</h1>
        </div>                                                  
                                                          
        <div class="telefono"><span class="icon-phone"></span>
          <p></p>
          <h1>Telefono : 65 2 484525 </h1>
        </div>
        <div class="mail"><span class="icon-inbox"></span>
          <h1>libertad@escuelas.dempuertomontt.cl</h1>
        </div>                                                 
        <div class="face"><a href="https://www.facebook.com/esc.libertad.39"><span class="icon-facebook-official"></span></a></div><span class="icon-youtube-square"></span>
      </footer>
    </div>
  </body>
</html>
<script>
   $(document).ready(function(){
  $(".owl-carousel").owlCarousel({loop:true,nav:true,pagination:true,navigation:true,autoplay:false,autoplayTimeOut:10000,margin:10,});});
</script>