<?php
session_start();
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica si el usuario existe y la contraseña es correcta
    $tipo_usuario = verificarUsuario($username, $password);

    if ($tipo_usuario) {
        // Credenciales válidas
        $_SESSION['username'] = $username;
        $_SESSION['tipo_usuario'] = $tipo_usuario; // 'admin' o 'usuario'
        header("Location: index.php"); // Redirige al usuario al inicio
        exit();
    } else {
        // Verificar si el usuario existe
        if (!usuarioExiste($username)) {
            $_SESSION['mensaje'] = "El usuario no existe.";
        } else {
            $_SESSION['mensaje'] = "Contraseña incorrecta.";
        }
        header("Location: login.php");
        exit();
    }
}
