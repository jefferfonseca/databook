<?php
session_start();
require_once 'cx.php';

if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario_id'] != 1) {
    header('Location: ../login.php');
    exit();
}

$id = intval($_GET['id'] ?? 0);
if ($id > 0) {
    // Generar contraseña aleatoria
    $nueva = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'), 0, 8);
    $hash = password_hash($nueva, PASSWORD_DEFAULT);

    $stmt = $conn->prepare('UPDATE usuario SET Contraseña = ? WHERE Id = ?');
    $stmt->execute([$hash, $id]);

    // Aquí podrías enviar un correo con $nueva al usuario.
    $_SESSION['flash'] = "Contraseña reiniciada. Nueva clave: $nueva";
}

header('Location: ../registro.php');
exit();
