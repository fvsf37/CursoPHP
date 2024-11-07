<?php
include_once 'db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Función para verificar credenciales y obtener tipo de usuario
function verificarUsuario($username, $password)
{
    global $conexion;
    $query = "SELECT tipo FROM usuarios WHERE nombreusuario = ? AND password = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc()['tipo']; // Retorna 'admin' o 'usuario'
    } else {
        return null; // Si no hay coincidencia, retorna null
    }
}


// Función para iniciar sesión
function iniciarSesion($username, $password)
{
    $tipo_usuario = verificarUsuario($username, $password);

    if ($tipo_usuario) {
        // Credenciales válidas, guarda la información en la sesión
        $_SESSION['username'] = $username;
        $_SESSION['tipo_usuario'] = $tipo_usuario; // 'admin' o 'usuario'
        return true;
    } else {
        return false;
    }
}

// Función para verificar si el usuario existe en la base de datos
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


// Función para cerrar sesión
function cerrarSesion()
{
    session_start();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>