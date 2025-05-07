<?php
// backend/user_action.php
header('Content-Type: application/json');
require_once __DIR__ . '/cx.php';
$response = ['success' => false, 'message' => 'Error desconocido'];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        $nombre = htmlspecialchars(trim($_POST['nombre']));
        $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
        $telefono = trim($_POST['telefono']);
        $tipo_usuario = intval($_POST['tipo_usuario']);
        $contrasena = $_POST['contraseña'] ?? '';

        // Validación de campos esenciales
        if (empty($nombre) || !filter_var($correo, FILTER_VALIDATE_EMAIL) || empty($tipo_usuario)) {
            throw new Exception('Campos incompletos o inválidos.');
        }

        if ($id) {
            // Actualización de usuario existente
            $sql = 'UPDATE usuario SET Nombre = ?, Correo = ?, Telefono = ?, tipo_usuario_id = ?';
            $params = [$nombre, $correo, $telefono, $tipo_usuario];

            // Si se proporcionó nueva contraseña, hashearla y agregar al SQL
            if (!empty($contrasena)) {
                $params[] = password_hash($contrasena, PASSWORD_DEFAULT);
                $sql .= ', Contraseña = ?';
            }

            $sql .= ' WHERE Id = ?';
            $params[] = intval($id);

            $stmt = $conn->prepare($sql);
            $stmt->execute($params);

            $response = ['success' => true, 'message' => 'Usuario actualizado correctamente.'];

        } else {
            // Inserción de nuevo usuario
            $stmt = $conn->prepare('SELECT COUNT(*) FROM usuario WHERE Correo = ?');
            $stmt->execute([$correo]);
            if ($stmt->fetchColumn() > 0) {
                throw new Exception('Correo ya registrado.');
            }

            // Hashear contraseña
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                'INSERT INTO usuario (Nombre, Correo, Contraseña, Telefono, tipo_usuario_id) VALUES (?, ?, ?, ?, ?)'
            );
            $stmt->execute([$nombre, $correo, $hash, $telefono, $tipo_usuario]);

            $response = ['success' => true, 'message' => 'Usuario registrado correctamente.'];
        }
    } else {
        throw new Exception('Método de solicitud no permitido.');
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
