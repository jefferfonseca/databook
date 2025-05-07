<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y Modificación de Usuarios</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Coolvetica';
            src: url('fonts/CoolveticaRg.otf') format('opentype');
        }

        body {
            font-family: 'Coolvetica', sans-serif;
        }
    </style>
</head>
<body class="grey lighten-4">
    <div class="container">
        <h4 class="center-align">Registro y Modificación de Usuarios</h4>
        <div class="card">
            <div class="card-content">
                <form action="backend/user_action.php" method="POST">
                    <div class="input-field">
                        <input type="text" name="nombre" id="nombre" required>
                        <label for="nombre">Nombre Completo</label>
                    </div>
                    <div class="input-field">
                        <input type="email" name="correo" id="correo" required>
                        <label for="correo">Correo Electrónico</label>
                    </div>
                    <div class="input-field">
                        <input type="password" name="contraseña" id="contraseña" required>
                        <label for="contraseña">Contraseña</label>
                    </div>
                    <div class="input-field">
                        <input type="tel" name="telefono" id="telefono">
                        <label for="telefono">Teléfono</label>
                    </div>
                    <div class="input-field">
                        <select name="tipo_usuario" required>
                            <option value="" disabled selected>Selecciona un Tipo de Usuario</option>
                            <option value="1">Administrador</option>
                            <option value="2">Estudiante</option>
                            <option value="3">Docente</option>
                        </select>
                        <label>Tipo de Usuario</label>
                    </div>
                    <button type="submit" class="btn blue waves-effect waves-light">Guardar Usuario</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            M.FormSelect.init(elems);
        });
    </script>
</body>
</html>
