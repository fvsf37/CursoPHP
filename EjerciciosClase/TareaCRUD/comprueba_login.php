<?php
include 'auth.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Llama a la función iniciarSesion de auth.php
    if (iniciarSesion($username, $password)) {
        // Si las credenciales son válidas, redirige a index.php
        header("Location: index.php");
        exit();
    } else {
        // Si las credenciales son incorrectas, redirige a login.php con un mensaje de error
        header("Location: login.php?error=1");
        exit();
    }
}
?>