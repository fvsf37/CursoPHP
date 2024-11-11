<?php
include_once 'db.php';

// Verifica si se ha enviado el formulario por método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $tipo_usuario = $_POST['tipo_usuario'];

  // Cifra la contraseña usando el método predeterminado
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Inserta el usuario en la base de datos
  $query = "INSERT INTO usuarios (nombreusuario, password, tipo) VALUES (?, ?, ?)";
  $stmt = mysqli_prepare($conexion, $query);
  mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $tipo_usuario);
  $result = mysqli_stmt_execute($stmt);

  if ($result) {
    // Alerta y redirección en caso de registro exitoso
    echo "<script>
                alert('Registro exitoso. Serás redirigido al inicio de sesión.');
                window.location.href = 'login.php';
              </script>";
  } else {
    // Alerta y redirección en caso de error
    echo "<script>
                alert('Error en el registro. Inténtalo de nuevo.');
                window.location.href = 'registrar.php';
              </script>";
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conexion);
}
