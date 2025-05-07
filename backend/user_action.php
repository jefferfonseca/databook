<?php
session_start();
include 'backend/cx.php'; // Conexión a la base de datos

// Verificar si se trata de un registro o modificación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $telefono = $_POST['telefono'] ?? null;
    $tipo_usuario = $_POST['tipo_usuario'];

    try {
        // Verificar si es un usuario existente (modificación)
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $query = $conn->prepare("UPDATE usuario SET Nombre = ?, Correo = ?, Contraseña = ?, Telefono = ?, tipo_usuario_id = ? WHERE Id = ?");
            $query->execute([$nombre, $correo, $contraseña, $telefono, $tipo_usuario, $id]);
            $_SESSION['message'] = 'Usuario actualizado correctamente';
        } else { // Nuevo registro
            $query = $conn->prepare("INSERT INTO usuario (Nombre, Correo, Contraseña, Telefono, tipo_usuario_id) VALUES (?, ?, ?, ?, ?)");
            $query->execute([$nombre, $correo, $contraseña, $telefono, $tipo_usuario]);
            $_SESSION['message'] = 'Usuario registrado correctamente';
        }

        header('Location: registro_usuarios.php'); // Redirigir a la página de gestión de usuarios
        exit();

    } catch (Exception $e) {
        $_SESSION['message'] = 'Error: ' . $e->getMessage();
        header('Location: registro_usuarios.php');
        exit();
    }
}

?>
