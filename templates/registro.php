<?php
$PDO = new PDO( 'mysql:host=localhost:3307;dbname=veterinaria;charset=UTF8','root','' );
$message='';


if (!empty($_POST['nombre'])&&!empty($_POST['apellido'])&&!empty($_POST['correo'])&&!empty($_POST['cedula'])&&!empty($_POST['usuario'])&&!empty($_POST['contraseña'])){
    $sql="Insert into registro(nombre,apellido,correo,cedula,usuario,password) values(:nombre,:apellido,:correo,:cedula,:usuario,:password)";
    $stmt=$PDO->prepare($sql);
    $stmt->bindParam(':nombre',$_POST['nombre']);
    $stmt->bindParam(':apellido',$_POST['apellido']);
    $stmt->bindParam(':correo',$_POST['correo']);
    $stmt->bindParam(':cedula',$_POST['cedula']);
    $stmt->bindParam(':usuario',$_POST['usuario']);
    $password=password_hash($_POST['contraseña'],PASSWORD_BCRYPT);
    $stmt->bindParam(':password',$password);
    if($stmt->execute()){
        $message='Successfully create new user';
    }else{
        $message='Sorry there must have beed an issue creating your acount';
    }
}



?> 

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>CANI-VET</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Dosis:400,500|Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>



<body class="sub_page">
    <?php
    if(!empty($message)):
    ?>
    <p>
    <?php
    $message
    ?>
    </p>
    <?php
    endif;
    ?>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <img src="images/logo.jpeg" alt="">
            <span>
              CANI-VET
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="service.html">SERVICIO </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pet.html">CANI-VET gallery </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="clinic.html"> clinic</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.html">Registrase</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="buy.html"> Buy now </a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
            <div class="quote_btn-container  d-flex justify-content-center">
              <a href="">
                Call: +01 1234567890
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

  </div>


  <!-- map section -->

  <section class="map_section">
    <div id="map" class="h-100 w-100 ">
    </div>

    <div class="form_container ">
      <div class="row">
        <div class="col-md-8 col-sm-10 offset-md-4">
          <form action="registro.php" method="Post">
            <div class="text-center">
              <h3>
                Registrase
              </h3>
            </div>
            <div>
              <input type="text" name="nombre" placeholder="Nombres" class="pt-3">
            </div>
            <div>
              <input type=" text" name="apellido" placeholder="Apellidos">
            </div>
            <div>
              <input type="email" name="correo" placeholder="Email">
            </div>
            <div>
              <input type="text" name="cedula" placeholder="Cedula">
            </div>
            <div>
              <input type="text" name="usuario" placeholder="Usuario">
            </div>
            <div>
              <input type="password" name="contraseña" placeholder="Contraseña">
            </div>
            <div class="d-flex justify-content-center">
              <input type="submit" value="Guardar">

            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
  </section>


  <!-- end map section -->

  <!-- info section -->
  <section class="info_section layout_padding2">
    <div class="container">
      <div class="info_items">
        <a href="">
          <div class="item ">
            <div class="img-box box-1">
              <img src="" alt="">
            </div>
            <div class="detail-box">
              <p>
                Location
              </p>
            </div>
          </div>
        </a>
        <a href="">
          <div class="item ">
            <div class="img-box box-2">
              <img src="" alt="">
            </div>
            <div class="detail-box">
              <p>
                +02 1234567890
              </p>
            </div>
          </div>
        </a>
        <a href="">
          <div class="item ">
            <div class="img-box box-3">
              <img src="" alt="">
            </div>
            <div class="detail-box">
              <p>
                demo@gmail.com
              </p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- end info_section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      &copy; 2019 All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

  <script>
    // This example adds a marker to indicate the position of Bondi Beach in Sydney,
    // Australia.
    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: {
          lat: 40.645037,
          lng: -73.880224
        },
      });

      var image = 'images/maps-and-flags.png';
      var beachMarker = new google.maps.Marker({
        position: {
          lat: 40.645037,
          lng: -73.880224
        },
        map: map,
        icon: image
      });
    }
  </script>
  <!-- google map js -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap">
  </script>
  <!-- end google map js -->
</body>

</html>