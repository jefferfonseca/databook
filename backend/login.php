
<?php
// login.php
session_start();
include 'backend/cx.php'; // Conexión a tu base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $conn->prepare('SELECT * FROM usuario WHERE Correo = ?');
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Contraseña'])) {
        $_SESSION['user_id'] = $user['Id'];
        header('Location: dashboard.php');
        exit();
    } else {
        echo '<script>alert("Correo o contraseña incorrectos.");</script>';
    }
}
?>