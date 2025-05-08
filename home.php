<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="contenido">
    <div class="logeo">
        <div class="formulario">
           <div class="ing">
           <img src="assets/images/logo_pro.png" alt="Logo" width="200px" />
           <h3 class="center">Ingreso</h3>
           </div>
            <form action="backend/login.php" method="POST">
                <div class="input-field">
                    <input type="email" name="email" id="email" required>
                    <label for="email">Correo Electrónico</label>
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Contraseña</label>
                </div>
                <button type="submit" class="btn waves-effect waves-light">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const error = sessionStorage.getItem('loginError');
            if (error) {
                M.toast({
                    html: error,
                    classes: 'rounded red darken-1 white-text'
                });
                sessionStorage.removeItem('loginError');
            }
        });
    </script>
</body>

</html>