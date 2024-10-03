<?php
// Parámetros de conexión
$db_host = "localhost";
$db_usuario = "root";
$db_contra = "";
$db_nombre = "pruebas";

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
    } else {
        $_SESSION['mensaje'] = "Error al insertar el producto: ";
    }
}

// Eliminar producto
if (isset($_GET['eliminar'])) {
    $codigo = $_GET['eliminar'];
    $eliminar = "DELETE FROM productos WHERE CODIGOARTICULO='$codigo'";

    if (mysqli_query($conexion, $eliminar)) {
        $_SESSION['mensaje'] = "Producto eliminado correctamente";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el producto: ";
    }
}

// Actualizar producto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])) {
    $codigo = $_POST['codigo'];
    $seccion = $_POST['seccion'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $fecha = $_POST['fecha'];
    $importado = $_POST['importado'];
    $pais = $_POST['pais'];

    $actualizar = "UPDATE productos SET SECCION='$seccion', NOMBREARTICULO='$nombre', PRECIO='$precio', 
                   FECHA='$fecha', IMPORTADO='$importado', PAISDEORIGEN='$pais' WHERE CODIGOARTICULO='$codigo'";

    if (mysqli_query($conexion, $actualizar)) {
        $_SESSION['mensaje'] = "Producto actualizado correctamente";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el producto: ";
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            /* Color de fondo suave */
        }

        h1 {
            color: #333;
            /* Tono oscuro para el título */
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #6200ea;
            /* Color de fondo del header */
            padding: 10px;
            color: white;
            /* Color de texto en el header */
        }

        header h1 {
            margin: 0;
        }

        header a {
            background-color: #03dac5;
            /* Color del botón de agregar */
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        header a:hover {
            background-color: #018786;
            /* Color del botón al pasar el mouse */
        }

        table {
            width: 80%;
            /* Cambiar a un ancho más estrecho */
            margin: 20px auto;
            /* Centrar la tabla */
            border-collapse: collapse;
            background-color: white;
            /* Color de fondo de la tabla */
            border-radius: 5px;
            /* Bordes redondeados para la tabla */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Sombra para efecto de profundidad */
        }

        th,
        td {
            border: 1px solid #ddd;
            /* Color de borde suave */
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #6200ea;
            /* Color de fondo para el encabezado de la tabla */
            color: white;
            /* Color de texto en el encabezado */
        }

        td {
            background-color: #f9f9f9;
            /* Color de fondo suave para las filas de la tabla */
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        footer {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            background-color: #6200ea;
            /* Color de fondo del footer */
            color: white;
            /* Color de texto en el footer */
        }

        form {
            margin-top: 20px;
            padding: 15px;
            background-color: white;
            /* Color de fondo del formulario */
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Sombra para el formulario */
            width: 80%;
            /* Cambiar a un ancho más estrecho */
            margin: 20px auto;
            /* Centrar el formulario */
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            /* Ancho del input */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            /* Color de borde para los inputs */
            border-radius: 5px;
            /* Bordes redondeados para los inputs */
        }

        input[type="submit"] {
            background-color: #6200ea;
            /* Color de fondo del botón de submit */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #3700b3;
            /* Color del botón al pasar el mouse */
        }

        .alert {
            padding: 15px;
            margin: 20px 0;
            background-color: #f44336;
            /* Color de fondo para el mensaje */
            color: white;
            /* Color del texto */
            border-radius: 5px;
            /* Bordes redondeados */
            text-align: center;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_SESSION['mensaje'])) {
        echo '<div class="alert">' . $_SESSION['mensaje'] . '</div>';
        unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
    }
    ?>

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
            <th class="actions">Acciones</th>
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
        <input type="date" name="fecha" placeholder="Fecha" required>
        <select name="importado" required>
            <option value="">Importado</option>
            <option value="Sí">Sí</option>
            <option value="No">No</option>
        </select>
        <input type="text" name="pais" placeholder="País de origen" required>
        <input type="submit" name="crear" value="Agregar Producto">
    </form>

    <footer>
        <p>Gestión de Productos</p>
    </footer>

</body>

</html>