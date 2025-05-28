<?php session_start(); error_reporting(0);

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DATABOOK</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.ico" />

  <!-- Materialize CSS y tu CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body class="contenido">

  <!-- Navbar principal -->
  <nav class="">
    <div class="nav-wrapper ">
      <!-- Botón de Hamburguesa -->
      <a href="#" data-target="slide-out" class="sidenav-trigger left show-on-medium-and-down">
        <i class="material-icons">menu</i>
      </a>

      <!-- Logo -->
      <a href="index.php" class="brand-logo">
        <img src="assets/images/logo_pro.png" alt="Logo" style="height: 70px; margin-top:7px;">
      </a>

      <!-- Título centrado -->
      <span class="nav-title white-text">DATABOOK</span>

      <!-- Menú desktop -->
      <ul class="right hide-on-med-and-down">
        <li class="active"><a href="index.php">Inicio</a></li>
        <li class=""><a href="nosotros.php">Sobre Nosotros</a></li>
        <li class=""><a href="tecnicos.php">Técnicos</a></li>
        <?php
        // Asegúrate de haber hecho session_start() arriba del todo
        if (!isset($_SESSION['rol'])): ?>
          <!-- No hay sesión: mostramos solo Iniciar Sesión -->
          <li class="active">
            <a href="home.php">

              <i class="material-icons left">login</i>
              Iniciar Sesión
            </a>
          </li>

        <?php elseif ($_SESSION['rol'] == 1): ?>
          <!-- Usuario administrador -->
          <li><a href="registro.php">Usuarios</a></li>
          <li class="active">
            <a href="backend/logout.php">
              <i class="material-icons left">exit_to_app</i>
              Cerrar Sesión
            </a>
          </li>

        <?php else: ?>
          <!-- Usuario normal (logueado, pero no admin) -->
          <li class="active">
            <a href="backend/logout.php">
              <i class="material-icons left ">exit_to_app</i>
              Cerrar Sesión
            </a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </nav>

  <!-- Sidenav móvil -->
  <ul id="slide-out" class="sidenav">
    <li class="center">
      <img src="assets/images/logo_pro.png" alt="Logo" style="height: 80px; margin: 16px auto;">
    </li>
    <li class="center">
      <h5>DATABOOK</h5>
    </li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a href="index.php"><i class="material-icons">home</i>Inicio</a></li>
    <li><a href="nosotros.php"><i class="material-icons">info</i>Sobre Nosotros</a></li>
    <li><a href="tecnicos.php"><i class="material-icons">build</i>Técnicos</a></li>
    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
      <li><a href="registro.php"><i class="material-icons">people</i>Usuarios</a></li>
      <li><a href="logout.php"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
    <?php endif; ?>
  </ul>

  <h1 class="center titulo">¡Bienvenidos Comunidad Cenista!</h1>
  <main class="contenido">
    <div class="row valign-wrapper no-valign-mobile">
      <div class="col s12 m6">
        <div class="valign fondo">
          <p>
            Nos complace ofrecer acceso a una gran colección de recursos
            multimedia, diseñados para enriquecer la experiencia de
            aprendizaje. En este repositorio podrás encontrar:
          </p>
          <ul class="lista">
            <li>Videos educativos.</li>
            <li>Audios y podcasts.</li>
            <li>Libros.</li>
          </ul>
          <p>
            Todo el contenido está organizado por áreas temáticas, facilitando
            su búsqueda y acceso. En este espacio, buscamos promover el
            aprendizaje colaborativo, la innovación y la creatividad. Explora,
            aprende y comparte.
          </p>
        </div>
      </div>
      <div class="col s12 m6">
        <div class="carousel carousel-slider">
          <a class="carousel-item" href="#one!"><img src="assets/images/tecnicos/Aa.png" /></a>
          <a class="carousel-item" href="#two!"><img src="assets/images/tecnicos/API.png" /></a>
          <a class="carousel-item" href="#three!"><img src="assets/images/tecnicos/CF.png" /></a>
          <a class="carousel-item" href="#four!"><img src="assets/images/tecnicos/DG.png" /></a>
          <a class="carousel-item" href="#five!"><img src="assets/images/tecnicos/I.png" /></a>
          <a class="carousel-item" href="#one!"><img src="assets/images/tecnicos/MV.png" /></a>
          <a class="carousel-item" href="#three!"><img src="assets/images/tecnicos/S.png" /></a>
          <a class="carousel-item" href="#four!"><img src="assets/images/tecnicos/V.png" /></a>
        </div>
      </div>
    </div>
  </main>

  <!--pie de pagina-->
  <footer class="page-footer grey darken-3">
    <div class="row valign-wrapper no-valign-mobile">
      <div class="col s12 m5">
        <h5 class="white-text">Sede Centro</h5>

        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.2495717377706!2d-73.36888772271514!3d5.529946980140521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e6a7dd370d9df2f%3A0x8f347d9ae4bfe052!2sInstituto%20Cenis%20Tunja!5e0!3m2!1ses!2sco!4v1746559382054!5m2!1ses!2sco"
          width="100%" height="300" style="border: 0" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <div class="col s12 m5">
        <h5 class="white-text">Sede Las Américas</h5>

        <iframe
          src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3971.2751122815375!2d-73.36562661627082!3d5.526139612127951!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1zMTI1OSBDbC4gMTMswqBUdW5qYSwgQm95YWPDoQ!5e0!3m2!1ses!2sco!4v1746560054815!5m2!1ses!2sco"
          width="100%" height="300" style="border: 0" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col s12 m3 center">
        <h5 class="white-text">Contáctanos:</h5>
        <a href="https://www.facebook.com/share/1HC8LmKRYK/"><i class="icon fab fa-facebook-f"></i>
        </a>
        <a href="https://www.instagram.com/cenistunja_?igsh=MXV0eWowNnBleTlnZw=="><i
            class="icon fab fa-instagram"></i></a>
        <h6><b>Cel:</b> (+57) 315 363 0071</h6>
      </div>
    </div>
    <div class="footer-copyright grey darken-4">
      <div class="container center">
        Copyright © 2025 <br /><b>| DATABOOK |</b> <br />Todos los derechos
        reservados.
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    $(document).ready(function () {
      // Inicializar Carrusel
      $(".carousel.carousel-slider").carousel({
        fullWidth: true,
        indicators: true,
      });

      // Avanzar cada 3 segundos
      setInterval(function () {
        $(".carousel.carousel-slider").carousel("next");
      }, 3000);

      // Inicializa el sidenav
      $('.sidenav').sidenav({
        edge: 'left',
        draggable: true
      });

      // Cierra el sidenav al hacer clic en cualquier enlace
      $('.sidenav a').on('click', function () {
        var instance = M.Sidenav.getInstance($('.sidenav'));
        instance.close();
      });
    });
  </script>
</body>

</html>