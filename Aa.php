<?php
// Carpeta del técnico que quieres mostrar
$tecnico = 'Asistente Administrativo';
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
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body class="contenido">
  <header>
    <nav class="nav-wrapper light-blue darken-4">
      <div class="nav-wrapper">
        <a href="#!" class="brand-logo">
          <img src="assets/images/logo_pro.png" width="85px" />
        </a>
        <span class="nav-title center-align">DATABOOK</span>
        <ul class="right hide-on-med-and-down">
          <li><a href="index.html">Inicio</a></li>
          <li><a href="tecnicos.html">Técnicos</a></li>
          <li><a href="nosotros.html">Sobre nosotros</a></li>
          <li><a href="interés.html">Libros de interés</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <main class="container">
    <h1 class="center-align">Técnico laboral en Asistente Administrativo</h1>
    <p>
      El técnico laboral en asistente administrativo está en la capacidad de
      gestionar información brindando solución a las necesidades organizacionales
      con ética, eficiencia, calidad humana e innovación en las áreas de procesos
      administrativos contables, producción documental, análisis estadísticos y
      recursos humanos.
    </p>

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
            <ul class="collapsible">

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
                            <a href="<?= $url ?>" target="_blank" rel="noopener noreferrer">
                              <div class="cards tecnicos">
                                <img src="assets/images/libros.jpg" alt="PDF" style="width:100%" />
                                <div class="opciones">
                                  <button>Abrir</button>
                                  <button>Descargar</button>
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
                            <a href="<?= $safeUrl ?>" target="_blank" rel="noopener noreferrer">
                              <div class="cards tecnicos">
                                <img src="assets/images/videos.jpg" alt="Video" style="width:100%" />
                                <div class="opciones">
                                  <button>Abrir</button>
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
                      <?php foreach ($audios as $url):
                        $safeUrl = htmlspecialchars($url, ENT_QUOTES);
                        $filename = basename(parse_url($url, PHP_URL_PATH));
                        ?>
                        <div class="col s12 m3 l4">
                          <span class="cards-container">
                            <div class="cards tecnicos">
                              <img src="assets/images/audios.jpg" alt="Audio" style="width:100%" />
                              <div class="cards-body">
                                <h4 class="titlulo-recursos"><?= htmlspecialchars($filename) ?></h4>
                                <audio controls style="width: 100%; margin-top: 10px;">
                                  <source src="<?= $safeUrl ?>" type="audio/mpeg">
                                  Tu navegador no soporta la reproducción de audio.
                                </audio>
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

  <footer class="page-footer grey darken-3">
    <!-- ... tu footer ... -->
  </footer>

  <!-- JS Materialize -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var elems = document.querySelectorAll('.collapsible');
      M.Collapsible.init(elems);
    });
  </script>
</body>

</html>