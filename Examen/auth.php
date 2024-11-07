<?php
include_once 'db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function verificarUsuario($username, $password)
{
    global $conexion;
    echo "Inicio de la función verificarUsuario<br>"; // Línea de depuración

    $query = "SELECT password, tipo FROM usuarios WHERE nombreusuario = ?";
    $stmt = mysqli_prepare($conexion, $query);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . mysqli_error($conexion));
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $stored_password, $tipo_usuario);
    mysqli_stmt_fetch($stmt);

    echo "Hash guardado en la base de datos: " . $stored_password . "<br>"; // Línea de depuración
    echo "Contraseña ingresada: " . $password . "<br>"; // Línea de depuración

    mysqli_stmt_close($stmt);
    return null;
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