<?php
// Conexión a la base de datos (reemplaza con tus propios detalles)
$host = "localhost:3307";
$usuario = "root";
$contrasena = "";
$base_datos = "veterinaria";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar datos del formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["usuario"];
    $password = $_POST["contrasena"];

    // Verificar si el usuario existe en la base de datos
    $sql = "SELECT * FROM registro WHERE usuario = '$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // El usuario existe, ahora verifica la contraseña
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        if (password_verify($password, $hashed_password)) {
            // Contraseña válida, iniciar sesión
            session_start();
            $_SESSION["usuario"] = $usuario;
            echo "Inicio de sesión exitoso. Bienvenido, " . $username . "!";
            // Redirigir a la página de implemantacion después del inicio de sesión
            header("Location:http://127.0.0.1:5000");
            exit();
        } else {
            echo "Contraseña incorrecta. Inténtalo de nuevo.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}

$conn->close();
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

    <title>CANI-CARE</title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500|Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
          <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
              <a class="navbar-brand" href="index.php">
                <img src="images/logo.jpeg" alt="">
                <span>
                  CANI-CARE
                </span>
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>



              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
                  <ul class="navbar-nav  ">

                    <li class="nav-item">
                      <a class="nav-link" href="service.html">SERVICIOS</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="clinic.html"> CLÍNICA</a>
                    </li>

                  </ul>
                  <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                    <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                  </form>
                </div>
                <div class="quote_btn-container  d-flex justify-content-center">
                  <a href="">
                    Contactanos: +593 98765435
                  </a>
                </div>
              </div>
            </nav>
          </div>
        </header>
        <!-- end header section -->

        <!-- slider section -->
    <section class=" slider_section position-relative">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4 offset-md-2">
                  <div class="slider_detail-box">



                    <section class="map_section">
            <div id="map" class="h-100 w-100 ">
            </div>

            <div class="form_container ">
                <div class="row">
                    <div class="col-md-8 col-sm-10 offset-md-4">
                        <form action="inicio.php" method="Post">
                            <div class="text-center">
                                <h3>
                                    Inicio Sesion
                                </h3>
                            </div>
                            <div>
                                <input type="text" name="usuario" placeholder="Usuario">
                            </div>
                            <div>
                                <input type="password" name="contrasena" placeholder="Contraseña" id="password" required>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="http://127.0.0.1:5000">
                                    <input type="submit" value="Iniciar">
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            </div>
        </section>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  <!-- end slider section -->
  </div>








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
                Ubicación
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
                +593 998765435
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
                canicon@gmail.com
              </p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- end info_section -->
    </div>


</body>