<?php
session_start();
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica si las credenciales son correctas
    $tipo_usuario = verificarUsuario($username, $password);

    if ($tipo_usuario) {
        // Guarda usuario y tipo en sesión y redirige al inicio
        $_SESSION['username'] = $username;
        $_SESSION['tipo_usuario'] = $tipo_usuario; // 'admin' o 'usuario'
        header("Location: index.php");
        exit();
    } else {
        // Mensaje de error: usuario no existe o contraseña incorrecta
        if (!usuarioExiste($username)) {
            $_SESSION['mensaje'] = "El usuario no existe.";
        } else {
            $_SESSION['mensaje'] = "Contraseña incorrecta.";
        }
        header("Location: login.php");
        exit();
    }
}
