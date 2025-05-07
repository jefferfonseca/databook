<?php
session_start();
require_once __DIR__ . '/cx.php';

if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario_id'] != 1) {
    header('Location: ../login.php');
    exit();
}

$id = intval($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare('DELETE FROM usuario WHERE Id = ?');
    $stmt->execute([$id]);
}

// Redirigir con mensaje en session
$_SESSION['flash'] = 'Usuario eliminado correctamente.';
header('Location: ../registro.php');
exit();
