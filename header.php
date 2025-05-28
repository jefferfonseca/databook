<?php session_start(); error_reporting(0);
// 1. Comprobar sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}
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

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
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