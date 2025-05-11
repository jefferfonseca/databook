<?php
session_start();
require_once 'cx.php'; // Asegúrate de que $conn sea tu PDO

// 1. Habilitar excepciones en PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 2. Obtener y normalizar
    $email = isset($_POST['email']) ? strtolower(trim($_POST['email'])) : '';
    $password = $_POST['password'] ?? '';

    try {
        // 3. Preparar y ejecutar consulta, incluyendo tipo_usuario_id
        $stmt = $conn->prepare(
            'SELECT Id, Correo, `Contraseña`, tipo_usuario_id 
             FROM usuario 
             WHERE Correo = ?'
        );
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 4. Lógica de validación
        if (!$user) {
            $error = 'Usuario no encontrado.';
        } elseif (!password_verify($password, $user['Contraseña'])) {
            $error = 'Contraseña incorrecta.';
        } else {
            // Éxito: guardamos ID y tipo de usuario en la sesión
            $_SESSION['user_id'] = $user['Id'];
            $_SESSION['rol'] = $user['tipo_usuario_id'];

            // header('Location: ./../index.html');
            header('Location: ./../registro.php');
            exit();
        }

        // 5. Si llegamos aquí, hubo un error de credenciales
        echo "<script>
                sessionStorage.setItem('loginError', " . json_encode($error) . ");
                window.location.href = './../home.php';
              </script>";
        exit();
    } catch (PDOException $e) {
        // Error grave de base de datos
        error_log("Login error: " . $e->getMessage());
        echo "<script>
                sessionStorage.setItem('loginError', 'Error interno de servidor.');
                window.location.href = './../home.php';
              </script>";
        exit();
    }
} else {
    // No es POST: redirigir al home
    header('Location: ./../home.php');
    exit();
}
