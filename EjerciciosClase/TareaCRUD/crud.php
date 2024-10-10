<?php
session_start();

// Parámetros de conexión
$db_host = "localhost";
$db_usuario = "root";
$db_nombre = "prueba";
$db_contra = "";

// Conexión a la base de datos
$conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "Fallo al conectar con la base de datos";
    exit();
}

// Seleccionar la base de datos
mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

// Establecer juego de caracteres
mysqli_set_charset($conexion, "utf8");

// Insertar producto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear'])) {
    $codigo = $_POST['codigo'];
    $seccion = $_POST['seccion'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $fecha = $_POST['fecha'];
    $importado = $_POST['importado'];
    $pais = $_POST['pais'];

    $insertar = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) 
                 VALUES ('$codigo', '$seccion', '$nombre', '$precio', '$fecha', '$importado', '$pais')";

    if (mysqli_query($conexion, $insertar)) {
        $_SESSION['mensaje'] = "Producto insertado correctamente";
        $_SESSION['tipo_mensaje'] = "exito";
    } else {
        $_SESSION['mensaje'] = "Error al insertar el producto: " . mysqli_error($conexion);
        $_SESSION['tipo_mensaje'] = "error";
    }
}

// Eliminar producto
if (isset($_GET['eliminar'])) {
    $codigo = $_GET['eliminar'];
    $eliminar = "DELETE FROM productos WHERE CODIGOARTICULO='$codigo'";

    if (mysqli_query($conexion, $eliminar)) {
        $_SESSION['mensaje'] = "Producto eliminado correctamente";
        $_SESSION['tipo_mensaje'] = "exito";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el producto: " . mysqli_error($conexion);
        $_SESSION['tipo_mensaje'] = "error";
    }
}

// Leer productos
$consulta = "SELECT * FROM productos";

// Verificar si se ha ingresado un término de búsqueda
if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
    $buscar = $_GET['buscar'];
    $consulta .= " WHERE CODIGOARTICULO LIKE '%$buscar%' OR NOMBREARTICULO LIKE '%$buscar%'";
}

$resultados = mysqli_query($conexion, $consulta);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Productos</title>
    <!-- Llamar al archivo CSS externo -->
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <!-- Mensajes de éxito o error -->
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert <?php echo $_SESSION['tipo_mensaje']; ?>">
            <?php echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipo_mensaje']); ?>
        </div>
    <?php endif; ?>

    <header>
        <h1>Gestión de Productos</h1>
        <a href="#formulario">Agregar Producto</a>
    </header>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="">
        <input type="text" name="buscar" placeholder="Buscar por código o nombre" required>
        <input type="submit" value="Buscar">
    </form>

    <!-- Tabla de productos -->
    <table>
        <tr>
            <th>Código</th>
            <th>Sección</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Fecha</th>
            <th>Importado</th>
            <th>País</th>
            <th>Acciones</th>
        </tr>
        <?php while ($producto = mysqli_fetch_assoc($resultados)): ?>
            <tr>
                <td><?php echo $producto['CODIGOARTICULO']; ?></td>
                <td><?php echo $producto['SECCION']; ?></td>
                <td><?php echo $producto['NOMBREARTICULO']; ?></td>
                <td><?php echo $producto['PRECIO']; ?></td>
                <td><?php echo $producto['FECHA']; ?></td>
                <td><?php echo $producto['IMPORTADO']; ?></td>
                <td><?php echo $producto['PAISDEORIGEN']; ?></td>
                <td class="actions">
                    <a href="?editar=<?php echo $producto['CODIGOARTICULO']; ?>">Modificar</a>
                    <a href="?eliminar=<?php echo $producto['CODIGOARTICULO']; ?>"
                        onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Formulario para agregar producto -->
    <form id="formulario" method="POST" action="">
        <h2>Agregar Producto</h2>
        <input type="text" name="codigo" placeholder="Código" required>
        <input type="text" name="seccion" placeholder="Sección" required>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="number" name="precio" placeholder="Precio" step="0.01" required>
        <input type="date" name="fecha" required>
        <select name="importado" required>
            <option value="">Importado</option>
            <option value="Sí">Sí</option>
            <option value="No">No</option>
        </select>
        <input type="text" name="pais" placeholder="País de origen" required>
        <input type="submit" name="crear" value="Agregar Producto">
    </form>

    <!-- Script para ocultar el mensaje después de 3 segundos -->
    <script>
        window.onload = function () {
            const alertBox = document.querySelector('.alert');
            if (alertBox) {
                alertBox.style.display = 'block'; // Mostramos el mensaje
                setTimeout(function () {
                    alertBox.style.display = 'none'; // Ocultamos después de 3 segundos
                }, 3000);
            }
        };
    </script>

</body>

</html>