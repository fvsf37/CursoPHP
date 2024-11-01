<?php
include 'db.php';
session_start();

// Función para verificar las credenciales del usuario y obtener el tipo de usuario (admin o usuario)
function verificarUsuario($username, $password)
{
    global $conexion;
    $query = "SELECT password, tipo FROM usuarios WHERE nombreusuario = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verifica si la contraseña es cifrada (nueva) o en texto plano (antigua)
        if (password_verify($password, $stored_password) || $stored_password === $password) {
            return $row['tipo']; // Retorna 'admin' o 'usuario'
        }
    }
    return null; // Si no hay coincidencia, retorna null
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

// Función para cerrar sesión
function cerrarSesion()
{
    session_start();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>