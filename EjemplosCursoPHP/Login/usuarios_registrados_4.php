<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        tr,
        td {
            /* Define que la tabla, filas y celdas compartan el mismo estilo de borde */
            border-collapse: collapse;
            border: 2px solid red;
            /* Borde de 2px color rojo */
            margin: 2px;
            /* Espacio alrededor de las celdas */
            padding: 2px;
            /* Espacio interno en las celdas */
            text-align: center;
            /* Centra el texto en las celdas */
        }
    </style>
</head>

<body>

    <?php
    // Comenzamos o reanudamos la sesión existente
    session_start();

    // Verificamos si la sesión no está iniciada. Si el usuario no ha iniciado sesión, lo redirigimos al formulario de login
    if (!isset($_SESSION["usuario"])) {
        header("Location:login_3.php"); // Si no está logueado, redirige al formulario de login
    }

    // Si la sesión existe, mostramos el nombre del usuario
    echo "USUARIO: " . $_SESSION["usuario"] . "<br>";
    ?>

    <!-- Título principal de la página -->
    <h1>Bienvenidos Usuarios</h1>

    <!-- Contenido exclusivo para usuarios registrados -->
    <p>Esto es información solo para usuarios registrados</p>

    <!-- Enlaces para volver a la página anterior o cerrar sesión -->
    <p><a href="usuarios_registrados_1.php">VOLVER</a></p>
    <p><a href="cierre.php">CERRAR SESIÓN</a></p>

</body>

</html>