<?php
include_once 'auth.php';
include_once 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Muestra un mensaje de sesión si existe y lo elimina después
if (isset($_SESSION['mensaje'])) {
    echo "<script>alert('{$_SESSION['mensaje']}');</script>";
    unset($_SESSION['mensaje']);
}

// Redirige al login si el usuario no ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Verifica si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Determina si el usuario es 'admin' o 'user'
$is_admin = ($_SESSION['username'] === 'admin');
$is_user = ($_SESSION['username'] === 'user');


// Obtiene el nombre de usuario de la sesión actual
$username = $_SESSION['username'];

// Configura la tabla activa como 'productos' por defecto
$tabla = 'productos';

// Captura criterio de búsqueda y valor desde la URL
$criterio = isset($_GET['criterio']) ? $_GET['criterio'] : null;
$valor = isset($_GET['valor']) ? $_GET['valor'] : "";

// Configura los criterios de búsqueda si existen
$criterios = ($criterio && $valor) ? [$criterio => $valor] : [];

// Obtiene datos de la tabla 'productos' según los criterios de búsqueda
$resultados = obtenerProductos($criterios);

// Muestra mensaje si no hay resultados
if (!mysqli_num_rows($resultados)) {
    $_SESSION['mensaje'] = "No se encontraron resultados para la búsqueda.";
    echo "<script>alert('{$_SESSION['mensaje']}');</script>";
    unset($_SESSION['mensaje']);
}

// Verifica si se ha solicitado editar un producto
$producto = null;
if (isset($_GET['editar'])) {
    // Solo el usuario "admin" puede editar
    if ($username === 'admin') {
        $id = $_GET['editar'];
        // Carga el producto según su id
        $producto = obtenerProductoPorId($id);
    } else {
        $_SESSION['mensaje'] = "No tienes permisos para editar productos.";
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario - Productos</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <header>
        <?php if ($_SESSION['username'] === 'admin'): ?>
            <div class="button-group">
                <a href="enviar_tabla.php" class="add-button">Enviar Tabla Completa</a>
            </div>
        <?php endif; ?>
        <h1>Bienvenido, <?php echo htmlspecialchars($username); ?></h1>
        <?php if ($username === 'admin'): ?>
            <p>CRUD ADMIN</p>
        <?php else: ?>
            <p>CRUD USER - Solo búsqueda</p>
        <?php endif; ?>
    </header>

    <!-- Barra de búsqueda avanzada -->
    <?php if ($is_admin || $is_user): ?>
        <form method="GET" action="index.php" class="barra-busqueda">
            <input type="hidden" name="tabla" value="productos">

            <!-- Menú desplegable para seleccionar criterio de búsqueda -->
            <select name="criterio" required>
                <option value="buscar_codigo">Buscar por código</option>
                <option value="buscar_descripcion">Buscar por descripción</option>
                <option value="buscar_precioVenta">Buscar por precio de venta</option>
                <option value="buscar_precioCompra">Buscar por precio de compra</option>
                <option value="buscar_existencias">Buscar por existencias</option>
            </select>

            <!-- Campo de entrada para el valor de búsqueda -->
            <input type="text" name="valor" placeholder="Ingrese el valor de búsqueda">

            <!-- Botón de búsqueda -->
            <input type="submit" value="Buscar">
        </form>
    <?php endif; ?>


    <!-- Contenedor de Tarjetas de Productos -->
    <div class="card-container">
        <?php while ($row = mysqli_fetch_assoc($resultados)): ?>
            <div class="product-card">
                <!-- Imagen del producto -->
                <div class="card-image">
                    <?php if (!empty($row['foto'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['foto']); ?>" alt="Imagen del producto"
                            class="thumbnail">
                    <?php else: ?>
                        <p>No Imagen</p>
                    <?php endif; ?>
                </div>

                <!-- Información del producto -->
                <div class="card-content">
                    <?php if (!is_null($row['codigo'])): ?>
                        <p><strong>Código:</strong> <?php echo htmlspecialchars($row['codigo']); ?></p>
                    <?php endif; ?>

                    <?php if (!is_null($row['descripcion'])): ?>
                        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($row['descripcion']); ?></p>
                    <?php endif; ?>

                    <?php if (!is_null($row['precioVenta'])): ?>
                        <p><strong>Precio de Venta:</strong> <?php echo htmlspecialchars($row['precioVenta']); ?> €</p>
                    <?php endif; ?>

                    <?php if (!is_null($row['precioCompra'])): ?>
                        <p><strong>Precio de Compra:</strong> <?php echo htmlspecialchars($row['precioCompra']); ?> €</p>
                    <?php endif; ?>

                    <?php if (!is_null($row['existencias'])): ?>
                        <p><strong>Existencias:</strong> <?php echo htmlspecialchars($row['existencias']); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Botones de acción -->
                <div class="card-actions">
                    <?php if ($_SESSION['username'] === 'admin'): ?>
                        <a href="?tabla=productos&editar=<?php echo urlencode($row['id']); ?>#formulario-modificar"
                            class="primary-action-button">Modificar</a>
                        <a href="acciones.php?eliminar=<?php echo urlencode($row['id']); ?>&tabla=productos"
                            onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');"
                            class="primary-action-button">Eliminar</a>
                        <!-- Formulario para subir imagen -->
                        <form method="post" action="subir_imagen.php" enctype="multipart/form-data" class="upload-form">
                            <input type="hidden" name="tabla" value="productos">
                            <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($row['codigo']); ?>">
                            <input type="file" name="imagen" id="file-input-<?php echo $row['codigo']; ?>"
                                style="display: none;" required>
                            <button type="button"
                                onclick="document.getElementById('file-input-<?php echo $row['codigo']; ?>').click();"
                                class="secondary-action-button">Elegir Imagen</button>
                            <button type="submit" class="secondary-action-button">Subir Imagen</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>


    <?php if ($_SESSION['username'] === 'admin'): ?>
        <div class="formularios-container">

            <!-- Formulario para agregar producto -->
            <form id="formulario-agregar" class="formulario-agregar" method="POST" action="acciones.php"
                enctype="multipart/form-data">
                <h2>Agregar Producto</h2>
                <input type="hidden" name="crear" value="1">
                <input type="text" name="codigo" placeholder="Código" required>
                <input type="text" name="descripcion" placeholder="Descripción" required>
                <input type="number" name="precioVenta" placeholder="Precio de Venta" step="0.01" required>
                <input type="number" name="precioCompra" placeholder="Precio de Compra" step="0.01" required>
                <input type="number" name="existencias" placeholder="Existencias" required>
                <input type="file" name="foto" accept="image/*">
                <button type="submit" class="submit-button">Agregar Producto</button>
            </form>


            <!-- Formulario para modificar producto -->
            <?php if ($producto !== null): ?>
                <form id="formulario-modificar" class="formulario-modificar" method="POST" action="acciones.php"
                    enctype="multipart/form-data">
                    <h2>Modificar Producto</h2>
                    <input type="hidden" name="tabla" value="productos">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">

                    <!-- Campos para modificar un producto -->
                    <input type="text" name="codigo" placeholder="Código"
                        value="<?php echo htmlspecialchars($producto['codigo']); ?>" required>
                    <input type="text" name="descripcion" placeholder="Descripción"
                        value="<?php echo htmlspecialchars($producto['descripcion']); ?>" required>
                    <input type="number" name="precioVenta" placeholder="Precio de Venta" step="0.01"
                        value="<?php echo htmlspecialchars($producto['precioVenta']); ?>" required>
                    <input type="number" name="precioCompra" placeholder="Precio de Compra" step="0.01"
                        value="<?php echo htmlspecialchars($producto['precioCompra']); ?>" required>
                    <input type="number" name="existencias" placeholder="Existencias"
                        value="<?php echo htmlspecialchars($producto['existencias']); ?>" required>
                    <input type="file" name="foto" accept="image/*">

                    <!-- Botón para actualizar el producto -->
                    <input type="submit" name="actualizar" class="submit-button" value="Actualizar Producto">
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <footer>
        <p>Francisco Salapic Fernández</p>
        <a href="logout.php" class="add-button">Cerrar Sesión</a>
    </footer>
</body>

</html>