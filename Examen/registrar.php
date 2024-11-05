<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Cifra la contraseña con el coste predeterminado
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserta el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (nombreusuario, password, tipo) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $tipo_usuario);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Si el registro es exitoso, muestra un alert personalizado y redirige de inmediato
        echo "<script>
                alert('Registro exitoso. Serás redirigido al inicio de sesión.');
                window.location.href = 'login.php';
              </script>";
    } else {
        // En caso de error en el registro
        echo "<script>
                alert('Error en el registro. Inténtalo de nuevo.');
                window.location.href = 'registrar.php';
              </script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
