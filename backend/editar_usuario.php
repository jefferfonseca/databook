<?php
session_start();
require_once 'cx.php';

// Sólo admin
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario_id'] != 1) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // 1. Traer datos
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare('SELECT Nombre, Correo, Telefono, tipo_usuario_id FROM usuario WHERE Id = ?');
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        die('Usuario no encontrado');
    }
    // Aquí incluirías tu HTML con formulario precargado usando $user...
    // Asegúrate de poner un <input type="hidden" name="id" value="<?= $id ">
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 2. Procesar actualización vía AJAX JSON
    header('Content-Type: application/json');
    try {
        $id = intval($_POST['id']);
        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $telefono = trim($_POST['telefono']);
        $nuevoPassword = $_POST['contraseña'] ?? '';
        $tipoUsuario = intval($_POST['tipo_usuario']);

        // Validaciones básicas...
        if (empty($nombre) || empty($correo) || empty($tipoUsuario)) {
            throw new Exception('Faltan campos obligatorios.');
        }

        // Construir SQL dinámico
        $params = [$nombre, $correo, $telefono, $tipoUsuario];
        $sql = 'UPDATE usuario SET Nombre = ?, Correo = ?, Telefono = ?, tipo_usuario_id = ?';
        if (!empty($nuevoPassword)) {
            $hash = password_hash($nuevoPassword, PASSWORD_DEFAULT);
            $sql .= ', Contraseña = ?';
            $params[] = $hash;
        }
        $sql .= ' WHERE Id = ?';
        $params[] = $id;

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        echo json_encode(['success' => true, 'message' => 'Usuario actualizado correctamente.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit();
}
