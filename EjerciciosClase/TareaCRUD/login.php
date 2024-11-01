<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión o Registrarse</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <!-- Formulario de Iniciar Sesión -->
    <div class="login-container" id="login-form">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="comprueba_login.php">
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="Ingresar">
        </form>
        <!-- Botón para alternar a la vista de registro -->
        <button class="toggle-button" onclick="toggleForm()">¿No tienes cuenta? Regístrate</button>
    </div>

    <!-- Formulario de Registrarse -->
    <div class="register-container" id="register-form" style="display: none;">
        <h2>Registrarse</h2>
        <form method="POST" action="registrar.php">
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <label for="tipo_usuario">Tipo de Usuario:</label>
            <select name="tipo_usuario" required>
                <option value="usuario">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
            <input type="submit" value="Registrarse">
        </form>
        <!-- Botón para alternar a la vista de inicio de sesión -->
        <button class="toggle-button" onclick="toggleForm()">¿Ya tienes cuenta? Inicia sesión</button>
    </div>

    <!-- Script de JavaScript para alternar entre los formularios -->
    <script>
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            }
        }
    </script>

</body>

</html>