<?php
include_once 'auth.php';
include_once 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensaje'])) {
    echo "<script>alert('{$_SESSION['mensaje']}');</script>";
    unset($_SESSION['mensaje']);
}

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

// Captura de los criterios de búsqueda desde $_GET
$criterios = [
    'buscar_codigo' => isset($_GET['buscar_codigo']) ? $_GET['buscar_codigo'] : "",
    'buscar_nombre' => isset($_GET['buscar_nombre']) ? $_GET['buscar_nombre'] : "",
    'buscar_seccion' => isset($_GET['buscar_seccion']) ? $_GET['buscar_seccion'] : "",
    'buscar_precio' => isset($_GET['buscar_precio']) ? $_GET['buscar_precio'] : "",
    'buscar_importado' => isset($_GET['buscar_importado']) ? $_GET['buscar_importado'] : "",
    'buscar_pais' => isset($_GET['buscar_pais']) ? $_GET['buscar_pais'] : ""
];

// Llama a la función obtenerProductos con los criterios de búsqueda
$resultados = obtenerProductos($criterios);

// Si la búsqueda no tiene resultados, se genera un mensaje en sesión
if (!mysqli_num_rows($resultados)) {
    $_SESSION['mensaje'] = "No se encontraron resultados para la búsqueda.";
}

// Mostrar mensaje de sesión si existe
if (isset($_SESSION['mensaje'])) {
    echo "<script>alert('{$_SESSION['mensaje']}');</script>";
    unset($_SESSION['mensaje']); // Elimina el mensaje después de mostrarlo
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
        <div class="button-group">
            <!-- Botón Agregar Producto -->
            <?php if ($tipo_usuario == 'admin'): ?>
                <a href="#formulario-agregar" class="add-button">Agregar Producto</a>
                <!-- Botón Enviar Toda la Tabla -->
                <button type="button" onclick="location.href='enviar_tabla.php'" class="add-button">Enviar Tabla</button>
            <?php endif; ?>
        </div>
    </header>

    <!-- Formulario de búsqueda avanzada (solo visible para admin) -->
    <?php if ($tipo_usuario == 'admin'): ?>
        <form method="GET" action="index.php">
            <input type="text" name="buscar_codigo" placeholder="Buscar por código"
                value="<?php echo htmlspecialchars($criterios['buscar_codigo']); ?>">
            <input type="text" name="buscar_nombre" placeholder="Buscar por nombre"
                value="<?php echo htmlspecialchars($criterios['buscar_nombre']); ?>">
            <input type="text" name="buscar_seccion" placeholder="Buscar por sección"
                value="<?php echo htmlspecialchars($criterios['buscar_seccion']); ?>">
            <input type="number" name="buscar_precio" placeholder="Buscar por precio" step="0.01"
                value="<?php echo htmlspecialchars($criterios['buscar_precio']); ?>">
            <select name="buscar_importado">
                <option value="">Importado</option>
                <option value="VERDADERO" <?php echo ($criterios['buscar_importado'] == "VERDADERO") ? 'selected' : ''; ?>>
                    Verdadero</option>
                <option value="FALSO" <?php echo ($criterios['buscar_importado'] == "FALSO") ? 'selected' : ''; ?>>Falso
                </option>
            </select>
            <input type="text" name="buscar_pais" placeholder="Buscar por país"
                value="<?php echo htmlspecialchars($criterios['buscar_pais']); ?>">
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
            <th>Acciones</th>
        </tr>
        <?php
        // Muestra los productos en la tabla
        while ($producto_item = mysqli_fetch_assoc($resultados)): ?>
            <tr>
                <td><?php echo htmlspecialchars($producto_item['CODIGOARTICULO']); ?></td>
                <td><?php echo htmlspecialchars($producto_item['SECCION']); ?></td>
                <td><?php echo htmlspecialchars($producto_item['NOMBREARTICULO']); ?></td>
                <td><?php echo htmlspecialchars($producto_item['PRECIO']); ?></td>
                <td><?php echo htmlspecialchars($producto_item['FECHA']); ?></td>
                <td><?php echo htmlspecialchars($producto_item['IMPORTADO']); ?></td>
                <td><?php echo htmlspecialchars($producto_item['PAISDEORIGEN']); ?></td>
                <td class="actions">
                    <!-- Botón para enviar solo este registro -->
                    <form method="post" action="enviar_registro.php" style="display:inline;">
                        <input type="hidden" name="codigo"
                            value="<?php echo htmlspecialchars($producto_item['CODIGOARTICULO']); ?>">
                        <button type="submit" name="enviar_registro" class="send-button">Enviar Registro</button>
                    </form>
                    <!-- Botones de modificar y eliminar si el usuario es admin -->
                    <?php if ($tipo_usuario == 'admin'): ?>
                        <a
                            href="?editar=<?php echo urlencode($producto_item['CODIGOARTICULO']); ?>#formulario-modificar">Modificar</a>
                        <a href="acciones.php?eliminar=<?php echo urlencode($producto_item['CODIGOARTICULO']); ?>"
                            onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                    <?php endif; ?>
                </td>
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
                    value="<?php echo isset($producto) ? htmlspecialchars($producto['CODIGOARTICULO']) : ''; ?>">
                <input type="text" name="codigo" placeholder="Código"
                    value="<?php echo isset($producto) ? htmlspecialchars($producto['CODIGOARTICULO']) : ''; ?>" required>
                <input type="text" name="seccion" placeholder="Sección"
                    value="<?php echo isset($producto) ? htmlspecialchars($producto['SECCION']) : ''; ?>" required>
                <input type="text" name="nombre" placeholder="Nombre"
                    value="<?php echo isset($producto) ? htmlspecialchars($producto['NOMBREARTICULO']) : ''; ?>" required>
                <input type="number" name="precio" placeholder="Precio" step="0.01"
                    value="<?php echo isset($producto) ? htmlspecialchars($producto['PRECIO']) : ''; ?>" required>
                <input type="date" name="fecha"
                    value="<?php echo isset($producto) ? htmlspecialchars($producto['FECHA']) : ''; ?>" required>
                <select name="importado" required>
                    <option value="">Importado</option>
                    <option value="VERDADERO" <?php echo (isset($producto) && $producto['IMPORTADO'] == "VERDADERO") ? 'selected' : ''; ?>>Verdadero</option>
                    <option value="FALSO" <?php echo (isset($producto) && $producto['IMPORTADO'] == "FALSO") ? 'selected' : ''; ?>>Falso</option>
                </select>
                <input type="text" name="pais" placeholder="País de origen"
                    value="<?php echo isset($producto) ? htmlspecialchars($producto['PAISDEORIGEN']) : ''; ?>" required>
                <input type="submit" name="actualizar" value="Actualizar Producto">
            </form>
        </div>
    <?php endif; ?>

    <footer>
        <p>Francisco Salapic Fernández</p>
        <a href="logout.php" class="add-button">Cerrar Sesión</a>
    </footer>

</body>

</html>