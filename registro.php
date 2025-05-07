<?php
session_start();

// 1. Comprobar sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}

// Flash message
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// 2. Conexión a la base de datos (ruta corregida)
require_once __DIR__ . '/backend/cx.php';

// 3. Obtener todos los usuarios
$stmt = $conn->prepare(
    'SELECT u.Id, u.Nombre, u.Correo, u.Telefono, tu.descripcion AS Tipo
     FROM usuario u
     JOIN tipo_usuario tu ON u.tipo_usuario_id = tu.Id
     ORDER BY u.Id'
);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y Gestión de Usuarios</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Coolvetica';
            src: url('fonts/CoolveticaRg.otf') format('opentype');
        }

        body {
            font-family: 'Coolvetica', sans-serif;
        }

        .container {
            margin-top: 40px;
            max-width: 900px;
        }

        table.striped tr:hover {
            background-color: #f1f1f1;
        }

        .action-btns .btn-small {
            margin-right: 4px;
        }
    </style>
</head>

<body class="grey lighten-4">

    <?php if ($flash): ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                M.toast({ html: <?= json_encode($flash) ?>, classes: 'green darken-2 white-text' });
            });
        </script>
    <?php endif; ?>

    <!-- Cerrar Sesión -->
    <form action="backend/logout.php" method="POST" style="display:inline;">
        <button type="submit" class="btn red darken-1 waves-effect waves-light right" style="margin:20px;">
            <i class="material-icons left">exit_to_app</i>Cerrar Sesión
        </button>
    </form>

    <div class="container">
        <h4 class="center-align">Registro y Gestión de Usuarios</h4>

        <!-- Formulario AJAX (registro/edición) -->
        <div class="card">
            <div class="card-content">
                <form id="registroForm" autocomplete="off">
                    <input type="hidden" name="id" id="user_id">

                    <div class="input-field">
                        <input type="text" name="nombre" id="nombre" required>
                        <label for="nombre">Nombre Completo</label>
                    </div>

                    <div class="input-field">
                        <input type="email" name="correo" id="correo" required>
                        <label for="correo">Correo Electrónico</label>
                    </div>

                    <div class="input-field">
                        <input type="password" name="contraseña" id="contraseña">
                        <label for="contraseña">Contraseña <small>(solo si deseas cambiar)</small></label>
                    </div>

                    <div class="input-field">
                        <input type="tel" name="telefono" id="telefono" pattern="[0-9]{7,15}"
                            title="Ingresa entre 7 y 15 dígitos">
                        <label for="telefono">Teléfono (opcional)</label>
                    </div>

                    <div class="input-field">
                        <select name="tipo_usuario" id="tipo_usuario" required>
                            <option value="" disabled selected>Selecciona un Tipo de Usuario</option>
                            <option value="1">Administrador</option>
                            <option value="2">Estudiante</option>
                            <option value="3">Docente</option>
                        </select>
                        <label for="tipo_usuario">Tipo de Usuario</label>
                    </div>

                    <div class="center-align">
                        <button type="submit" id="submitBtn" class="btn blue waves-effect waves-light">Guardar
                            Usuario</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de Usuarios Registrados -->
        <h5>Usuarios Registrados</h5>
        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($usuarios)): ?>
                    <tr>
                        <td colspan="6" class="center-align">No hay usuarios registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($usuarios as $u): ?>
                        <tr data-id="<?= $u['Id'] ?>">
                            <td><?= htmlspecialchars($u['Id']) ?></td>
                            <td class="td-nombre"><?= htmlspecialchars($u['Nombre']) ?></td>
                            <td class="td-correo"><?= htmlspecialchars($u['Correo']) ?></td>
                            <td class="td-telefono"><?= htmlspecialchars($u['Telefono']) ?></td>
                            <td class="td-tipo" data-tipo="<?= htmlspecialchars($u['Tipo']) ?>">
                                <?= htmlspecialchars($u['Tipo']) ?></td>
                            <td class="action-btns">
                                <!-- Editar -->
                                <button class="btn-small blue editBtn" title="Editar">
                                    <i class="material-icons">edit</i>
                                </button>
                                <!-- Eliminar -->
                                <button onclick="confirmarEliminacion(<?= $u['Id'] ?>)" class="btn-small red" title="Eliminar">
                                    <i class="material-icons">delete</i>
                                </button>
                                <!-- Reiniciar contraseña -->
                                <a href="backend/reset_password.php?id=<?= $u['Id'] ?>" class="btn-small orange"
                                    title="Reiniciar contraseña">
                                    <i class="material-icons">lock_reset</i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            M.FormSelect.init(document.querySelectorAll('select'));
            const form = document.getElementById('registroForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', async function (e) {
                e.preventDefault();
                const data = new FormData(form);
                const res = await fetch('backend/user_action.php', { method: 'POST', body: data });
                const json = await res.json();
                if (json.success) {
                    M.toast({ html: json.message, classes: 'green darken-2 white-text' });
                    form.reset();
                    submitBtn.textContent = 'Guardar Usuario';
                    M.FormSelect.init(document.querySelectorAll('select'));
                    setTimeout(() => location.reload(), 1000);
                } else {
                    M.toast({ html: json.message, classes: 'red darken-2 white-text' });
                }
            });

            document.querySelectorAll('.editBtn').forEach(btn => btn.addEventListener('click', function () {
                const row = this.closest('tr');
                document.getElementById('user_id').value = row.dataset.id;
                document.getElementById('nombre').value = row.querySelector('.td-nombre').textContent;
                document.getElementById('correo').value = row.querySelector('.td-correo').textContent;
                document.getElementById('telefono').value = row.querySelector('.td-telefono').textContent;
                const tipoText = row.querySelector('.td-tipo').dataset.tipo;
                Array.from(document.getElementById('tipo_usuario').options)
                    .find(o => o.text === tipoText).selected = true;
                M.updateTextFields();
                M.FormSelect.init(document.querySelectorAll('select'));
                submitBtn.textContent = 'Actualizar Usuario';
            }));
        });

        function confirmarEliminacion(id) {
            if (confirm('¿Eliminar usuario?')) {
                window.location.href = `backend/eliminar_usuario.php?id=${id}`;
            }
        }
    </script>
</body>

</html>
