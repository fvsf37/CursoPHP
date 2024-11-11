<?php
include_once 'db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica credenciales y obtiene el tipo de usuario
function verificarUsuario($username, $password)
{
    global $conexion;
    $query = "SELECT tipo FROM usuarios WHERE nombreusuario = ? AND password = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc()['tipo']; // Devuelve 'admin' o 'usuario'
    } else {
        return null; // Retorna null si no hay coincidencia
    }
}

// Inicia sesión si las credenciales son válidas
function iniciarSesion($username, $password)
{
    $tipo_usuario = verificarUsuario($username, $password);

    if ($tipo_usuario) {
        // Guarda usuario y tipo en sesión
        $_SESSION['username'] = $username;
        $_SESSION['tipo_usuario'] = $tipo_usuario; // 'admin' o 'usuario'
        return true;
    } else {
        return false;
    }
}

// Verifica si el usuario existe en la base de datos
function usuarioExiste($username)
{
    global $conexion;
    $query = "SELECT 1 FROM usuarios WHERE nombreusuario = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return mysqli_num_rows($result) > 0;
}

// Cierra la sesión y redirige a la página de inicio de sesión
function cerrarSesion()
{
    session_start();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>