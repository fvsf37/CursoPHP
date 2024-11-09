<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Conectar a la base de datos
        $base = new PDO("mysql:host=localhost; dbname=examenPHP", "root", "root");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar y ejecutar la consulta
        $sql = "SELECT id, password_hash, role FROM users WHERE username = :username";
        $stmt = $base->prepare($sql);
        $stmt->execute([':username' => $username]);

        // Verificar si se encontró el usuario
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar la contraseña usando password_verify
            if (password_verify($password, $user['password_hash'])) {
                // Iniciar la sesión con los datos del usuario
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];

                // Redirigir a la página de bienvenida
                header("Location: /admin/welcome.php");
                exit;
            } else {
                // Contraseña incorrecta
                $error = "Contraseña incorrecta";
            }
        } else {
            // Usuario no encontrado
            $error = "Usuario no encontrado";
        }
    } catch (Exception $e) {
        // Mostrar un mensaje de error si hay problemas con la base de datos
        $error = "Error de conexión: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<div class="login-container">
    <h2>Inicio de sesión</h2>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar sesión</button>
    </form>
    <?php
    // Mostrar mensaje de error si existe
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>
</div>
</body>
</html>
