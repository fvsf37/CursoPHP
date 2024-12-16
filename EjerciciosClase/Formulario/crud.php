<?php
session_start();

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Si no hay sesión iniciada, redirigimos al login
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <header>
        <a href="#formulario_agregar">Agregar Producto</a>
        <h1 class="titulo">Bienvenido, <?php echo $_SESSION['usuario']; ?></h1>
        <a href="logout.php">Cerrar Sesión</a>
    </header>

    <?php
    // Incluir la lógica del CRUD
    include 'crud_logic.php';
    ?>

    <!-- Aquí se incluirá la tabla de productos y formularios que genera crud_logic.php -->

    <footer>
        <p>Gestión de Productos © 2024</p>
    </footer>

</body>

</html>