<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registro de Usuario</title>
</head>
<body>

<h2>Registro de Usuario</h2>
<form action="register.php" method="post">
    <input type="text" name="username" placeholder="Nombre de usuario" required><br><br>
    <input type="password" name="password" placeholder="Contraseña" required><br><br>
    <label for="role">Rol:</label>
    <select name="role" required>
        <option value="user">Usuario</option>
        <option value="admin">Administrador</option>
    </select><br><br>
    <button type="submit">Registrar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibe los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Cifrar la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Conectar a la base de datos
        $base = new PDO("mysql:host=localhost; dbname=examenPHP", "root", "root");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insertar el usuario en la base de datos
        $sql = "INSERT INTO users (username, password_hash, role) VALUES (:username, :password_hash, :role)";
        $stmt = $base->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password_hash' => $password_hash,
            ':role' => $role
        ]);

        echo "Usuario registrado con éxito.";
    } catch (Exception $e) {
        // Si ocurre un error, muestra un mensaje
        echo "Error: " . $e->getMessage();
    }
}
?>

</body>
</html>
