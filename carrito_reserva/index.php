<?php  
session_start();
session_destroy();

if(!isset($_POST["searchres"])) : ?>

  <?php	
    // header("location:../index.php");

      include_once('clases/producto.php');

      $product = new Product();

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles_outdoor.css?234222">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="
    sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.cssS">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
      <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
      <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
    


    <title>Test</title>
  </head>
  <body class="bg-light">
    <div class="wrap_hostal_i">
      
      <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img src="../img/outdoor_logo_white.png" width="100" height="auto" class="d-inline-block align-top" alt=""></a>
        <div class="  d-flex justify-content-end " id="navbarTogglerDemo03">
          <ul class="navbar-nav navbar-expand  mr-auto mt-2 mt-lg-0 ">
            <li class="nav-item active ">
              <a class="nav-link" href="index.php"><i class="fas fa-home"></i> <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        </div>
      </nav>
      <section class="make">
        <img class="mr-4"src="../img/descarga.png" alt="">
        <h3>¡Reserva tu habitación y reserva tus extras</h3>
        <!-- <img src="../img/logo_transparente_negro.png" alt="no esta"> -->
      </section>
      <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../img/img_slide_hostal/01_slide.jpg"  class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/img_slide_hostal/03_slide.jpg"   class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/img_slide_hostal/04_slide.jpg"  class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="../img/img_slide_hostal/05_slide.jpg"  class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="../img/img_slide_hostal/06_slide.jpg"  class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div class="hostal_i">
              
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                <div id="sandbox-container">
                  <div class="input-daterange input-group" id="datepicker">
                    <div class="hostal_check" >
                      <div class="check_in"><input type="text" class="input-sm form-control checkin" name="start" autocomplete="off" value="Fecha Entrada" readonly /></div>
                      <div class="check_out"><input type="text" class="input-sm form-control checkout" name="end" autocomplete="off" readonly="on" value="Fecha Salida" /></div>
                      <button type="submit" name="searchres" class="btn_ser"> Buscar </button>
                    </div>

                    <script>
                      
                        $('#sandbox-container .input-daterange').datepicker({
                        language: "es",
                        startDate: '-0d',
                        changeMonth: true,
                        format:'yyyy-mm-dd',


                      });	

                      

                    </script>
                  </div>
                </div>
              </form>	
              </div>

      <script>
        $('.carousel').carousel({
            interval: 2000
      });
      </script>
      
    </div>
    </body>
    </html>

<?php else : ?>
  <?php	
    // header("location:../index.php");

      include_once('clases/producto.php');

      $product = new Product();

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles_outdoor.css?234222">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="
    sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.cssS">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
      <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
      <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
    


    <title>Test</title>
  </head>
  <body>
    <div class="wrap_hostal">
      
      <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img src="../img/outdoor_logo_white.png" width="100" height="auto" class="d-inline-block align-top" alt=""></a>
        <div class="  d-flex justify-content-end " id="navbarTogglerDemo03">
          <ul class="navbar-nav navbar-expand  mr-auto mt-2 mt-lg-0 ">
            <li class="nav-item active ">
              <a class="nav-link" href="index.php"><i class="fas fa-home"></i> <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        </div>
      </nav>
      <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../img/img_slide_hostal/01_slide.jpg"  class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/img_slide_hostal/03_slide.jpg"   class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../img/img_slide_hostal/04_slide.jpg"  class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="../img/img_slide_hostal/05_slide.jpg"  class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="../img/img_slide_hostal/06_slide.jpg"  class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div class="hostal">
              
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                <div id="sandbox-container">
                  <div class="input-daterange input-group" id="datepicker">
                    <div class="hostal_check" >
                      <div class="check_in"><input type="text" class="input-sm form-control checkin" name="start" autocomplete="off" value="<?php echo $_POST['start'] ?>" readonly /></div>
                      <div class="check_out"><input type="text" class="input-sm form-control checkout" name="end" autocomplete="off" readonly="on" value="<?php echo $_POST['end'] ?>" /></div>
                      <button type="submit" name="searchres" class="btn_ser"> Buscar </button>
                      <img class="ml-3"src="../trip.png" width="150" alt="">
                    </div>

                    <script>
                      
                        $('#sandbox-container .input-daterange').datepicker({
                        language: "es",
                        startDate: '-0d',
                        changeMonth: true,
                        format:'yyyy-mm-dd',


                      });	

                      

                    </script>
                  </div>
                </div>
              </form>	
              </div>

      <script>
        $('.carousel').carousel({
            interval: 2000
      });
      </script>
    <form action="action_page.php?" id="form_d" class="needs-validation" name="f" method="POST" novalidate >

        <?=$product->get_products();?>

        
    </form>
    </div>
    <script>
  //validacion
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      
      var forms = document.getElementsByClassName('needs-validation');
      
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  </script>
  <script type="text/javascript" src="js/functions.js"></script>
  </body>
  </html>
  <?php endif; ?>