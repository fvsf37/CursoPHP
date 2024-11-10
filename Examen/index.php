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

// Obtiene el tipo de usuario de la sesión actual
$tipo_usuario = $_SESSION['tipo_usuario'];

// Determina la tabla activa, 'productos' por defecto
$tabla = isset($_GET['tabla']) && $_GET['tabla'] == 'libros' ? 'libros' : 'productos';

// Captura criterio de búsqueda y valor desde la URL
$criterio = isset($_GET['criterio']) ? $_GET['criterio'] : null;
$valor = isset($_GET['valor']) ? $_GET['valor'] : "";

// Configura los criterios de búsqueda si existen
$criterios = ($criterio && $valor) ? [$criterio => $valor] : [];

// Obtiene datos de la tabla seleccionada según los criterios de búsqueda
$resultados = ($tabla == 'productos') ? obtenerProductos($criterios) : obtenerLibros($criterios);

// Muestra mensaje si no hay resultados
if (!mysqli_num_rows($resultados)) {
    $_SESSION['mensaje'] = "No se encontraron resultados para la búsqueda.";
    echo "<script>alert('{$_SESSION['mensaje']}');</script>";
    unset($_SESSION['mensaje']);
}

// Verifica si se ha solicitado editar un producto o libro
$producto = null;
if (isset($_GET['editar']) && isset($_GET['tabla'])) {
    $codigo = $_GET['editar'];
    $tabla = $_GET['tabla'];

    if ($tabla == 'productos') {
        // Carga el producto según su código
        $producto = obtenerProductoPorCodigo($codigo);
    } elseif ($tabla == 'libros') {
        // Carga el libro según su ID
        $producto = obtenerLibroPorId($codigo);
    }
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
        <h1>Gestión de Inventario - Productos</h1>
        <div class="button-group">
            <a href="?tabla=productos" class="add-button">Ver Productos</a>
            <a href="?tabla=libros" class="add-button">Ver Libros</a>
            <?php if ($tipo_usuario == 'admin'): ?>
                <a href="#formulario-agregar" class="add-button">Agregar Producto</a>
                <button type="button" onclick="location.href='enviar_tabla.php?tabla=productos'" class="add-button">Enviar
                    Tabla</button>
            <?php endif; ?>
        </div>

    </header>

    <!-- Barra de búsqueda avanzada -->
    <?php if ($tipo_usuario == 'admin'): ?>
        <form method="GET" action="index.php" class="barra-busqueda">
            <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">

            <!-- Menú desplegable para seleccionar criterio de búsqueda -->
            <select name="criterio" required>
                <?php if ($tabla == 'productos'): ?>
                    <option value="buscar_codigo">Buscar por código</option>
                    <option value="buscar_nombre">Buscar por nombre</option>
                    <option value="buscar_seccion">Buscar por sección</option>
                    <option value="buscar_precio">Buscar por precio</option>
                    <option value="buscar_importado">Buscar por importado</option>
                    <option value="buscar_pais">Buscar por país</option>
                <?php elseif ($tabla == 'libros'): ?>
                    <option value="buscar_titulo">Buscar por título</option>
                    <option value="buscar_autor">Buscar por autor</option>
                    <option value="buscar_genero">Buscar por género</option>
                    <option value="buscar_anio">Buscar por año</option>
                    <option value="buscar_precio">Buscar por precio</option>
                    <option value="buscar_editorial">Buscar por editorial</option>
                <?php endif; ?>
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
            <div class="card-container">
                <?php while ($row = mysqli_fetch_assoc($resultados)): ?>
                    <div class="product-card">
                        <!-- Imagen del producto o libro -->
                        <div class="card-image">
                            <?php if (!empty($row['FOTO'])): ?>
                                <img src="/CURSOPHP/Examen/carpeta_imagenes_subidas/<?php echo htmlspecialchars($row['FOTO']); ?>"
                                    alt="Imagen" class="thumbnail">
                            <?php else: ?>
                                <p>No Imagen</p>
                            <?php endif; ?>
                        </div>

                        <!-- Información del producto o libro -->
                        <div class="card-content">
                            <?php if ($tabla == 'productos'): ?>
                                <!-- Verifica si el valor no es NULL antes de mostrarlo -->
                                <?php if (!is_null($row['CODIGOARTICULO'])): ?>
                                    <p><strong>Código:</strong> <?php echo htmlspecialchars($row['CODIGOARTICULO']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['SECCION'])): ?>
                                    <p><strong>Sección:</strong> <?php echo htmlspecialchars($row['SECCION']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['NOMBREARTICULO'])): ?>
                                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($row['NOMBREARTICULO']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['PRECIO'])): ?>
                                    <p><strong>Precio:</strong> <?php echo htmlspecialchars($row['PRECIO']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['FECHA'])): ?>
                                    <p><strong>Fecha:</strong> <?php echo htmlspecialchars($row['FECHA']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['IMPORTADO'])): ?>
                                    <p><strong>Importado:</strong> <?php echo htmlspecialchars($row['IMPORTADO']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['PAISDEORIGEN'])): ?>
                                    <p><strong>País:</strong> <?php echo htmlspecialchars($row['PAISDEORIGEN']); ?></p>
                                <?php endif; ?>
                            <?php elseif ($tabla == 'libros'): ?>
                                <!-- Para los libros, hacemos lo mismo -->
                                <?php if (!is_null($row['titulo'])): ?>
                                    <p><strong>Título:</strong> <?php echo htmlspecialchars($row['titulo']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['autor'])): ?>
                                    <p><strong>Autor:</strong> <?php echo htmlspecialchars($row['autor']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['genero'])): ?>
                                    <p><strong>Género:</strong> <?php echo htmlspecialchars($row['genero']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['anio_publicacion'])): ?>
                                    <p><strong>Año de Publicación:</strong> <?php echo htmlspecialchars($row['anio_publicacion']); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!is_null($row['precio'])): ?>
                                    <p><strong>Precio:</strong> <?php echo htmlspecialchars($row['precio']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['stock'])): ?>
                                    <p><strong>Stock:</strong> <?php echo htmlspecialchars($row['stock']); ?></p>
                                <?php endif; ?>

                                <?php if (!is_null($row['editorial'])): ?>
                                    <p><strong>Editorial:</strong> <?php echo htmlspecialchars($row['editorial']); ?></p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <!-- Botones de acción -->
                        <div class="card-actions">
                            <?php if ($tipo_usuario == 'admin'): ?>
                                <a href="?tabla=<?php echo $tabla; ?>&editar=<?php echo urlencode($row[$tabla == 'productos' ? 'CODIGOARTICULO' : 'id']); ?>#formulario-modificar"
                                    class="primary-action-button">Modificar</a>
                                <a href="acciones.php?eliminar=<?php echo urlencode($row[$tabla == 'productos' ? 'CODIGOARTICULO' : 'id']); ?>&tabla=<?php echo $tabla; ?>"
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este <?php echo $tabla == 'productos' ? 'producto' : 'libro'; ?>?');"
                                    class="primary-action-button">Eliminar</a>

                                <form method="post" action="subir_imagen.php" enctype="multipart/form-data" class="upload-form">
                                    <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">
                                    <input type="hidden" name="codigo"
                                        value="<?php echo htmlspecialchars($row[$tabla == 'productos' ? 'CODIGOARTICULO' : 'id']); ?>">
                                    <input type="file" name="imagen"
                                        id="file-input-<?php echo $row[$tabla == 'productos' ? 'CODIGOARTICULO' : 'id']; ?>"
                                        style="display: none;" required>
                                    <button type="button"
                                        onclick="document.getElementById('file-input-<?php echo $row[$tabla == 'productos' ? 'CODIGOARTICULO' : 'id']; ?>').click();"
                                        class="secondary-action-button">Elegir Imagen</button>
                                    <button type="submit" class="secondary-action-button">Subir Imagen</button>
                                </form>
                            <?php endif; ?>
                            <form method="post" action="enviar_registro.php" style="display:inline;">
                                <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">
                                <input type="hidden" name="codigo"
                                    value="<?php echo htmlspecialchars($row[$tabla == 'productos' ? 'CODIGOARTICULO' : 'id']); ?>">
                                <button type="submit" name="enviar_registro" class="secondary-action-button">Enviar
                                    Registro</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        <?php endwhile; ?>
    </div>

    <?php if ($tipo_usuario == 'admin'): ?>
        <div class="formularios-container">

            <!-- Formulario para agregar producto o libro -->
            <form id="formulario-agregar" class="formulario-agregar" method="POST" action="acciones.php"
                enctype="multipart/form-data">
                <h2>Agregar <?php echo $tabla == 'productos' ? 'Producto' : 'Libro'; ?></h2>
                <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">

                <?php if ($tabla == 'productos'): ?>
                    <!-- Campos para agregar un producto -->
                    <input type="text" name="codigo" placeholder="Código" required>
                    <input type="text" name="seccion" placeholder="Sección" required>
                    <input type="text" name="nombre" placeholder="Nombre" required>
                    <input type="number" name="precio" placeholder="Precio" step="0.01" required>
                    <input type="date" name="fecha">
                    <select name="importado" required>
                        <option value="">Importado</option>
                        <option value="VERDADERO">Verdadero</option>
                        <option value="FALSO">Falso</option>
                    </select>
                    <input type="text" name="pais" placeholder="País de origen" required>

                    <!-- Botón para elegir una imagen -->
                    <label for="file-input-agregar" class="upload-button-label">Elegir Imagen</label>
                    <input type="file" name="imagen" id="file-input-agregar" class="upload-button">

                    <!-- Botón para subir la imagen -->
                    <button type="submit" name="subir_imagen" class="upload-button">Subir Imagen</button>

                <?php elseif ($tabla == 'libros'): ?>
                    <!-- Campos para agregar un libro -->
                    <input type="text" name="titulo" placeholder="Título" required>
                    <input type="text" name="autor" placeholder="Autor" required>
                    <input type="text" name="genero" placeholder="Género" required>
                    <input type="number" name="anio_publicacion" placeholder="Año de Publicación">
                    <input type="number" name="precio" placeholder="Precio" step="0.01" required>
                    <input type="number" name="stock" placeholder="Stock" required>
                    <input type="text" name="editorial" placeholder="Editorial" required>

                    <!-- Botón para elegir una imagen -->
                    <label for="file-input-agregar" class="upload-button-label">Elegir Imagen</label>
                    <input type="file" name="imagen" id="file-input-agregar" class="upload-button">

                    <!-- Botón para subir la imagen -->
                    <button type="submit" name="subir_imagen" class="upload-button">Subir Imagen</button>

                <?php endif; ?>

                <!-- Botón verde para agregar el producto o libro -->
                <button type="submit" class="submit-button">Agregar
                    <?php echo $tabla == 'productos' ? 'Producto' : 'Libro'; ?></button>
            </form>

            <!-- Formulario para modificar producto o libro -->
            <?php if ($tipo_usuario == 'admin' && $producto !== null): ?>
                <form id="formulario-modificar" class="formulario-modificar" method="POST" action="acciones.php">
                    <h2>Modificar <?php echo $tabla == 'productos' ? 'Producto' : 'Libro'; ?></h2>
                    <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">
                    <input type="hidden" name="codigo_original"
                        value="<?php echo htmlspecialchars($producto['CODIGOARTICULO'] ?? $producto['id']); ?>">

                    <?php if ($tabla == 'productos'): ?>
                        <!-- Campos para modificar un producto -->
                        <input type="text" name="codigo" placeholder="Código"
                            value="<?php echo htmlspecialchars($producto['CODIGOARTICULO']); ?>" required>
                        <input type="text" name="seccion" placeholder="Sección"
                            value="<?php echo htmlspecialchars($producto['SECCION']); ?>" required>
                        <input type="text" name="nombre" placeholder="Nombre"
                            value="<?php echo htmlspecialchars($producto['NOMBREARTICULO']); ?>" required>
                        <input type="number" name="precio" placeholder="Precio" step="0.01"
                            value="<?php echo htmlspecialchars($producto['PRECIO']); ?>" required>
                        <input type="date" name="fecha" value="<?php echo htmlspecialchars($producto['FECHA']); ?>" required>
                        <select name="importado" required>
                            <option value="VERDADERO" <?php echo ($producto['IMPORTADO'] == "VERDADERO") ? 'selected' : ''; ?>>
                                Verdadero</option>
                            <option value="FALSO" <?php echo ($producto['IMPORTADO'] == "FALSO") ? 'selected' : ''; ?>>Falso</option>
                        </select>
                        <input type="text" name="pais" placeholder="País de origen"
                            value="<?php echo htmlspecialchars($producto['PAISDEORIGEN']); ?>" required>

                    <?php elseif ($tabla == 'libros'): ?>
                        <!-- Campos para modificar un libro -->
                        <input type="text" name="titulo" placeholder="Título"
                            value="<?php echo htmlspecialchars($producto['titulo']); ?>" required>
                        <input type="text" name="autor" placeholder="Autor"
                            value="<?php echo htmlspecialchars($producto['autor']); ?>" required>
                        <input type="text" name="genero" placeholder="Género"
                            value="<?php echo htmlspecialchars($producto['genero']); ?>" required>
                        <input type="number" name="anio_publicacion" placeholder="Año de Publicación"
                            value="<?php echo htmlspecialchars($producto['anio_publicacion']); ?>" required>
                        <input type="number" name="precio" placeholder="Precio" step="0.01"
                            value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
                        <input type="number" name="stock" placeholder="Stock"
                            value="<?php echo htmlspecialchars($producto['stock']); ?>" required>
                        <input type="text" name="editorial" placeholder="Editorial"
                            value="<?php echo htmlspecialchars($producto['editorial']); ?>" required>
                    <?php endif; ?>

                    <!-- Botón para actualizar el producto o libro -->
                    <input type="submit" name="actualizar" class="submit-button"
                        value="Actualizar <?php echo $tabla == 'productos' ? 'Producto' : 'Libro'; ?>">
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