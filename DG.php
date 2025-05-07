<?php
// Carpeta del técnico que quieres mostrar
$tecnico = 'Diseño Gráfico';
$rutaModulos = "assets/tecnicos/{$tecnico}/";
// Extensiones de libros
$extLibros = ['pdf', 'docx', 'pptx'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DataBook</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.ico" />

  <!-- Materialize CSS y tu CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body class="contenido">
  <header>
    <nav class="nav-wrapper">
      <div class="nav-inner">
        <!-- Zona izquierda: logo -->
        <div class="nav-left">
          <a href="#" class="brand-logo">
            <img src="assets/images/logo_pro.png" alt="Logo" />
          </a>
        </div>

        <!-- Zona central: título -->
        <div class="nav-center">
          <span class="nav-title">DATABOOK</span>
        </div>

        <!-- Zona derecha: menú -->
        <div class="nav-right">
          <a href="#" data-target="mobile-menu" class="sidenav-trigger">
            <i class="material-icons">menu</i>
          </a>
          <ul class="right hide-on-med-and-down nav-links">
            <li><a href="index.html">Inicio</a></li>
            <li class="active"><a href="tecnicos.html">Técnicos</a></li>
            <li><a href="nosotros.html">Sobre nosotros</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Sidenav para móvil -->
  <ul class="sidenav" id="mobile-menu">
    <li><a href="index.html">Inicio</a></li>
    <li class="active"><a href="tecnicos.html">Técnicos</a></li>
    <li><a href="nosotros.html">Sobre nosotros</a></li>
  </ul>

  <h1 class="center-align">Técnico Laboral en <?php echo $tecnico; ?></h1>
  <div class="container">
    <p class="descripcion">
      El técnico laboral en asistente administrativo está en la capacidad de
      gestionar información brindando solución a las necesidades
      organizacionales con ética, eficiencia, calidad humana e innovación en
      las áreas de procesos administrativos contables, producción documental,
      análisis estadísticos y recursos humanos.
    </p>
  </div>
  <main class="container">
    <!-- Inicio del collapsible dinámico -->
    <ul class="collapsible popout">
      <?php
      $modulos = is_dir($rutaModulos)
        ? array_filter(glob($rutaModulos . '*'), 'is_dir')
        : [];

      foreach ($modulos as $modPath):
        $modName = basename($modPath);
      ?>
        <li>
          <div class="collapsible-header">
            <i class="material-icons">folder</i>
            <?= htmlspecialchars($modName) ?>
          </div>
          <div class="collapsible-body">
            <ul class="collapsible popout">

              <!-- ——— Libros ——— -->
              <?php
              $libros = glob("$modPath/*.{" . implode(',', $extLibros) . "}", GLOB_BRACE);
              ?>
              <li>
                <div class="collapsible-header">
                  <i class="material-icons">menu_book</i> Libros
                </div>
                <div class="collapsible-body">
                  <?php if (empty($libros)): ?>
                    <p>No hay archivos en esta categoría.</p>
                  <?php else: ?>
                    <div class="row">
                      <?php foreach ($libros as $file):
                        $name = basename($file);
                        $url = $file;
                      ?>
                        <div class="col s12 m3 l4">
                          <span class="cards-container">
                            <div class="cards tecnicos">
                              <img src="assets/images/libros.jpg" alt="PDF" style="width:100%" />
                              <div class="opciones" style="margin-top: 0.5em;">
                                <a href="<?= $url ?>" target="_blank">Abrir</a>
                                <a href="<?= $url ?>" download>Descargar</a>
                              </div>
                              <div class="cards-body">
                                <h4 class="titlulo-recursos"><?= htmlspecialchars($name) ?></h4>
                              </div>
                            </div>
                            </a>
                          </span>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
              </li>

              <!-- ——— Videos ——— -->
              <?php
              $vidFile = "$modPath/videos.txt";
              $videos = (is_file($vidFile) && filesize($vidFile))
                ? file($vidFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
                : [];
              ?>
              <li>
                <div class="collapsible-header">
                  <i class="material-icons">ondemand_video</i> Videos
                </div>
                <div class="collapsible-body">
                  <?php if (empty($videos)): ?>
                    <p>No hay archivos en esta categoría.</p>
                  <?php else: ?>
                    <div class="row">
                      <?php foreach ($videos as $url):
                        $safeUrl = htmlspecialchars($url, ENT_QUOTES);
                        $filename = basename(parse_url($url, PHP_URL_PATH));
                      ?>
                        <div class="col s12 m3 l4">
                          <span class="cards-container">
                            <div class="cards tecnicos">
                              <img src="assets/images/videos.jpg" alt="Video" style="width:100%" />
                              <div class="opciones" style="margin-top: 0.5em;">
                                <a href="<?= $url ?>" target="_blank">Abrir</a>
                              </div>
                              <div class="cards-body">
                                <h4 class="titlulo-recursos"><?= htmlspecialchars($filename) ?></h4>
                              </div>
                            </div>
                            </a>
                          </span>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
              </li>

              <!-- ——— Audios ——— -->
              <?php
              $audFile = "$modPath/audios.txt";
              $audios = (is_file($audFile) && filesize($audFile))
                ? file($audFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
                : [];
              ?>
              <li>
                <div class="collapsible-header">
                  <i class="material-icons">headset</i> Audios
                </div>
                <div class="collapsible-body">
                  <?php if (empty($audios)): ?>
                    <p>No hay archivos en esta categoría.</p>
                  <?php else: ?>
                    <div class="row">
                      <?php foreach ($audios as $linea):
                        $partes = explode('|', $linea, 2);
                        $titulo = isset($partes[0]) ? trim($partes[0]) : 'Sin nombre';
                        $enlace = isset($partes[1]) ? trim($partes[1]) : '';
                        if (!$enlace)
                          continue;

                        $safeUrl = htmlspecialchars($enlace, ENT_QUOTES);
                        $isLocal = !preg_match('/^https?:\/\//', $enlace);
                      ?>
                        <div class="col s12 m3 l4">
                          <span class="cards-container">
                            <div class="cards tecnicos">
                              <img src="assets/images/audios.jpg" alt="Audio" style="width:100%" />
                              <div class="cards-body">
                                <h4 class="titlulo-recursos"><?= htmlspecialchars($titulo) ?></h4>
                                <?php if ($isLocal): ?>
                                  <audio controls style="width: 100%; margin-top: 10px;">
                                    <source src="<?= $safeUrl ?>" type="audio/mpeg">
                                    Tu navegador no soporta la reproducción de audio.
                                  </audio>
                                <?php else: ?>
                                  <div class="opciones" style="margin-top: 10px;">
                                    <a href="<?= $safeUrl ?>" target="_blank"
                                      rel="noopener noreferrer">Abrir</a>
                                  </div>
                                <?php endif; ?>
                              </div>
                            </div>
                          </span>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
              </li>


            </ul>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    <!-- Fin del collapsible dinámico -->

  </main>

  <!--pie de pagina-->
  <footer class="page-footer grey darken-3">
    <div class="row valign-wrapper">
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
      <div class="container center">Copyright © 2025 
<br><b>| Databook |</b> <br>Todos los derechos reservados.</div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <script>
    const carousel = document.querySelector(".carousel.carousel-slider");
    M.Carousel.init(carousel, {
      fullWidth: true,
      indicators: true,
    });

    setInterval(() => {
      const instance = M.Carousel.getInstance(carousel);
      instance.next();
    }, 3000);
  </script>
</body>

</html>


<!-- JS Materialize -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    M.Collapsible.init(elems);
  });
</script>
</body>

</html>