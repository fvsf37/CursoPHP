<?php
session_start();
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (verificarUsuario($username, $password)) {
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['mensaje'] = "Usuario o contraseña incorrectos.";
        header("Location: login.php");
        exit();
    }
}
