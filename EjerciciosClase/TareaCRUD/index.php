<?php
include 'auth.php';
include 'db.php';

session_start();

// Verifica que el usuario haya iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Obtiene el tipo de usuario de la sesión
$tipo_usuario = $_SESSION['tipo_usuario'];

// Verifica si se ha solicitado editar un producto
$producto = null;
if (isset($_GET['editar'])) {
    $codigo = $_GET['editar'];
    $producto = obtenerProductoPorCodigo($codigo); // Función que obtiene el producto por su código
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Productos</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <header>
        <h1>Gestión de Productos</h1>
        <!-- Solo muestra el botón de agregar producto si el usuario es admin -->
        <?php if ($tipo_usuario == 'admin'): ?>
            <a href="#formulario-agregar" class="add-button">Agregar Producto</a>
        <?php endif; ?>
        <a href="logout.php" class="logout-button">Cerrar Sesión</a>
    </header>

    <!-- Mensaje de bienvenida según el tipo de usuario -->
    <?php if ($tipo_usuario == 'admin'): ?>
        <p>Bienvenido, administrador. Tienes acceso completo a todas las funcionalidades.</p>
    <?php else: ?>
        <p>Bienvenido, usuario. Tienes acceso limitado.</p>
    <?php endif; ?>

    <!-- Formulario de búsqueda avanzada (solo visible para admin) -->
    <?php if ($tipo_usuario == 'admin'): ?>
        <form method="GET" action="">
            <input type="text" name="buscar_codigo" placeholder="Buscar por código">
            <input type="text" name="buscar_nombre" placeholder="Buscar por nombre">
            <input type="text" name="buscar_seccion" placeholder="Buscar por sección">
            <input type="number" name="buscar_precio" placeholder="Buscar por precio" step="0.01">
            <select name="buscar_importado">
                <option value="">Importado</option>
                <option value="VERDADERO">Verdadero</option>
                <option value="FALSO">Falso</option>
            </select>
            <input type="text" name="buscar_pais" placeholder="Buscar por país">
            <input type="submit" value="Buscar">
        </form>
    <?php endif; ?>

    <!-- Tabla de productos (visible para todos los usuarios) -->
    <table>
        <tr>
            <th>Código</th>
            <th>Sección</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Fecha</th>
            <th>Importado</th>
            <th>País</th>
            <!-- Solo muestra las opciones de acciones si el usuario es admin -->
            <?php if ($tipo_usuario == 'admin'): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>
        <?php
        // Obtén los productos desde la base de datos
        $resultados = obtenerProductos();

        // Muestra los productos en la tabla
        while ($producto_item = mysqli_fetch_assoc($resultados)): ?>
            <tr>
                <td><?php echo $producto_item['CODIGOARTICULO']; ?></td>
                <td><?php echo $producto_item['SECCION']; ?></td>
                <td><?php echo $producto_item['NOMBREARTICULO']; ?></td>
                <td><?php echo $producto_item['PRECIO']; ?></td>
                <td><?php echo $producto_item['FECHA']; ?></td>
                <td><?php echo $producto_item['IMPORTADO']; ?></td>
                <td><?php echo $producto_item['PAISDEORIGEN']; ?></td>
                <!-- Solo muestra las acciones de modificar y eliminar si el usuario es admin -->
                <?php if ($tipo_usuario == 'admin'): ?>
                    <td class="actions">
                        <a href="?editar=<?php echo $producto_item['CODIGOARTICULO']; ?>#formulario-modificar">Modificar</a>
                        <a href="acciones.php?eliminar=<?php echo $producto_item['CODIGOARTICULO']; ?>"
                            onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Formularios de agregar y modificar producto (solo visibles para admin) -->
    <?php if ($tipo_usuario == 'admin'): ?>
        <div class="formularios-container">
            <!-- Formulario para agregar producto -->
            <form id="formulario-agregar" method="POST" action="acciones.php">
                <h2>Agregar Producto</h2>
                <input type="text" name="codigo" placeholder="Código" required>
                <input type="text" name="seccion" placeholder="Sección" required>
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="number" name="precio" placeholder="Precio" step="0.01" required>
                <input type="date" name="fecha" required>
                <select name="importado" required>
                    <option value="">Importado</option>
                    <option value="VERDADERO">Verdadero</option>
                    <option value="FALSO">Falso</option>
                </select>
                <input type="text" name="pais" placeholder="País de origen" required>
                <input type="submit" name="crear" value="Agregar Producto">
            </form>

            <!-- Formulario para modificar producto -->
            <form id="formulario-modificar" method="POST" action="acciones.php">
                <h2>Modificar Producto</h2>
                <input type="hidden" name="codigo_original"
                    value="<?php echo isset($producto) ? $producto['CODIGOARTICULO'] : ''; ?>">
                <input type="text" name="codigo" placeholder="Código"
                    value="<?php echo isset($producto) ? $producto['CODIGOARTICULO'] : ''; ?>" required>
                <input type="text" name="seccion" placeholder="Sección"
                    value="<?php echo isset($producto) ? $producto['SECCION'] : ''; ?>" required>
                <input type="text" name="nombre" placeholder="Nombre"
                    value="<?php echo isset($producto) ? $producto['NOMBREARTICULO'] : ''; ?>" required>
                <input type="number" name="precio" placeholder="Precio" step="0.01"
                    value="<?php echo isset($producto) ? $producto['PRECIO'] : ''; ?>" required>
                <input type="date" name="fecha" value="<?php echo isset($producto) ? $producto['FECHA'] : ''; ?>" required>
                <select name="importado" required>
                    <option value="">Importado</option>
                    <option value="VERDADERO" <?php echo (isset($producto) && $producto['IMPORTADO'] == "VERDADERO") ? 'selected' : ''; ?>>Verdadero</option>
                    <option value="FALSO" <?php echo (isset($producto) && $producto['IMPORTADO'] == "FALSO") ? 'selected' : ''; ?>>Falso</option>
                </select>
                <input type="text" name="pais" placeholder="País de origen"
                    value="<?php echo isset($producto) ? $producto['PAISDEORIGEN'] : ''; ?>" required>
                <input type="submit" name="actualizar" value="Actualizar Producto">
            </form>
        </div>
    <?php endif; ?>

    <footer>
        <p>Francisco Salapic Fernández</p>
    </footer>

</body>

</html>