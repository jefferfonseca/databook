<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DataBook</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo.ico" />

    <!--Import Google Icon Font-->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />

    <!-- Compiled and minified CSS -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body class="contenido">
    <header>
      <nav class="nav-wrapper light-blue darken-4">
        <div class="nav-wrapper">
          <a href="#!" class="brand-logo"
            ><img src="assets/images/logo_pro.png" width="85px"
          /></a>
          <span class="nav-title center-align">DATABOOK</span>
          <ul class="right hide-on-med-and-down">
            <li><a href="index.html">Inicio</a></li>
            <li>
              <a href="tecnicos.html">Técnicos</a>
            </li>
            <li><a href="nosotros.html">Sobre nosotros</a></li>
            <li><a href="interés.html">Libros de interés</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <main>
      <h1 class="center-align">Técnico laboral en Asistente Administrativo</h1>
      <p>
        El técnico laboral en asistente administrativo está en la capacidad de
        gestionar información brindando solución a las necesidades
        organizacionales con ética, eficiencia, calidad humana e innovación en
        las áreas de procesos administrativos contables, producción documental,
        análisis estadísticos y recursos humanos.
      </p>
      <div class="container">
        <ul class="collapsible popout">
          <li>
            <div class="collapsible-header">
              <i class="material-icons">filter_drama</i>Legislación Comercial y
              Laboral
            </div>
            <div class="collapsible-body">
              <span> 
                <ul class="collapsible popout">
                  <li>
                    <div class="collapsible-header">
                      <i class="material-icons">filter_drama</i>Legislación Comercial y Laboral
                    </div>
                    <div class="collapsible-body">
                      <ul class="collapsible">
                        <?php
                          $folder = 'assets/tecnicos/';
                          $files = is_dir($folder) ? scandir($folder) : [];
                
                          $groups = [
                              'Libros' => ['pdf', 'epub', 'docx'],
                              'Videos' => ['mp4', 'avi', 'mov'],
                              'Audios' => ['mp3', 'wav', 'ogg'],
                          ];
                
                          $categorized = [
                              'Libros' => [],
                              'Videos' => [],
                              'Audios' => [],
                          ];
                
                          foreach ($files as $file) {
                              if ($file === '.' || $file === '..') continue;
                
                              $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                              $matched = false;
                
                              foreach ($groups as $category => $extensions) {
                                  if (in_array($ext, $extensions)) {
                                      $categorized[$category][] = $file;
                                      $matched = true;
                                      break;
                                  }
                              }
                
                              if (!$matched) {
                                  $categorized['Otros'][] = $file;
                              }
                          }
                
                          foreach ($categorized as $category => $items) {
                              echo '<li>';
                              echo '<div class="collapsible-header">';
                              echo '<span class="material-symbols-outlined">folder</span>';
                              echo "<span class='titlulo-recursos'>$category</span>";
                              echo '</div>';
                              echo '<div class="collapsible-body"><div class="cards-container">';
                
                              if (count($items) === 0) {
                                  echo "<p>No hay archivos en esta categoría.</p>";
                              }
                
                              foreach ($items as $file) {
                                  $encodedFile = urlencode($file);
                                  $safeFile = htmlspecialchars($file, ENT_QUOTES);
                                  $path = $folder . $encodedFile;
                
                                  echo <<<HTML
                                  <div class="cards">
                                    <img src="assets/images/pdf.png" alt="Archivo" style="width: 100%" />
                                    <div class="opciones">
                                      <a href="$path" target="_blank"><button>Abrir</button></a>
                                      <a href="$path" download><button>Descargar</button></a>
                                    </div>
                                    <div class="cards-body">
                                      <h4>$safeFile</h4>
                                    </div>
                                  </div>
                                  HTML;
                              }
                
                              echo '</div></div></li>';
                          }
                        ?>
                      </ul>
                    </div>
                  </li>
                </ul>
                
              </span>
            </div>
          </li>
        </ul>
      </div>
    </main>
    <!--pie de pagina-->
    <footer class="page-footer grey darken-3">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">......</h5>
          </div>
          <div class="col l4 offset-l2 s12 center">
            <h5 class="white-text">Contáctanos:</h5>
            <a href="https://www.facebook.com/share/1HC8LmKRYK/"
              ><i class="icon fab fa-facebook-f"></i>
            </a>
            <a
              href="https://www.instagram.com/cenistunja_?igsh=MXV0eWowNnBleTlnZw=="
              ><i class="icon fab fa-instagram"></i
            ></a>
            <h6>Cel: (+57) 315 363 0071</h6>
          </div>
        </div>
      </div>
      <div class="footer-copyright grey darken-4">
        <div class="container">
          © 2025 MARI
          <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
      </div>
    </footer>

    <!-- Importa jQuery y Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Inicialización del Dropdown -->
    <script>
      $(document).ready(function () {
        $(".carousel").carousel();
      });
      $(".carousel.carousel-slider").carousel({
        fullWidth: true,
        indicators: true,
        setInterval: 3000,
        duration: 500,
      });
      $(document).ready(function () {
        $(".collapsible").collapsible();
      });
    </script>
  </body>
</html>
