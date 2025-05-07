<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Interfaz de Logeo Moderna">
    <title>Iniciar Sesión</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="contenido">
    <div class="logeo">
        <div class="formulario">
            <h3 class="center">Ingreso</h3>
            <form action="" method="POST">
                <div class="input-field">
                    <input type="email" name="email" id="email" required>
                    <label for="email">Correo Electrónico</label>
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Contraseña</label>
                </div>
                <button type="submit" class="btn waves-effect waves-light ">Iniciar Sesión</button>
            </form>
        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (sessionStorage.getItem('loginError')) {
                M.toast({
                    html: sessionStorage.getItem('loginError'),
                    classes: 'rounded red darken-1 white-text'
                });
                sessionStorage.removeItem('loginError');
            }
        });
    </script>
</body>

</html>

<?php
session_start();
include 'backend/cx.php'; // Conexión a tu base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $conn->prepare('SELECT * FROM usuario WHERE Correo = ?');
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['Contraseña'])) {

   // if ($user && password_verify($password, $user['Contraseña'])) {
        $_SESSION['user_id'] = $user['Id'];
        header('Location: index.html');
        exit();
    } else {
        echo '<script>sessionStorage.setItem("loginError", "Correo o contraseña incorrectos."); window.location.href = window.location.href;</script>';
    }
}
?>