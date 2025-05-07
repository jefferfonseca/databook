<?php
session_start();
// Limpiar todas las variables de sesión
$_SESSION = [];

// Destruir la sesión en el servidor
session_destroy();

// (Opcional) Borrar la cookie de sesión
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Redirigir al login o página pública
header('Location: login.php');
exit();
