<?php
include_once 'db.php';
function verificarUsuario($username, $password)
{
    global $conexion;
    $query = "SELECT password FROM usuarios_pass WHERE usuario = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Guarda el nombre de usuario en la sesión
            $_SESSION['username'] = $username;
            return true;
        }
    }
    return false;
}


// Función para verificar si el usuario existe en la base de datos
function usuarioExiste($username)
{
    global $conexion;
    $query = "SELECT 1 FROM usuarios_pass WHERE usuario = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return mysqli_num_rows($result) > 0;
}
