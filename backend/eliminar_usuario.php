<?php
session_start();
require_once __DIR__ . '/cx.php';



$id = intval($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare('DELETE FROM usuario WHERE Id = ?');
    $stmt->execute([$id]);
}

// Redirigir con mensaje en session
$_SESSION['flash'] = 'Usuario eliminado correctamente.';
header('Location: ../registro.php');
exit();
