<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Cifra la contraseña con un coste de 13
    $hashed_password = password_hash($password, PASSWORD_DEFAULT, array("cost" => 13));

    // Inserta el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (nombreusuario, password, tipo) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $tipo_usuario);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Registro exitoso. <a href='login.php'>Inicia sesión aquí.</a>";
    } else {
        echo "Error en el registro.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>