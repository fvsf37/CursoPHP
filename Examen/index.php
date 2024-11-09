<?php
include_once 'auth.php';
include_once 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mensaje en sesión
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

// Determina la tabla a mostrar según el parámetro 'tabla' en la URL (por defecto, 'productos')
$tabla = isset($_GET['tabla']) && $_GET['tabla'] == 'libros' ? 'libros' : 'productos';

// Captura de criterios de búsqueda y obtención de datos según la tabla seleccionada
if ($tabla == 'productos') {
    $criterios = [
        'buscar_codigo' => isset($_GET['buscar_codigo']) ? $_GET['buscar_codigo'] : "",
        'buscar_nombre' => isset($_GET['buscar_nombre']) ? $_GET['buscar_nombre'] : "",
        'buscar_seccion' => isset($_GET['buscar_seccion']) ? $_GET['buscar_seccion'] : "",
        'buscar_precio' => isset($_GET['buscar_precio']) ? $_GET['buscar_precio'] : "",
        'buscar_importado' => isset($_GET['buscar_importado']) ? $_GET['buscar_importado'] : "",
        'buscar_pais' => isset($_GET['buscar_pais']) ? $_GET['buscar_pais'] : ""
    ];
    $resultados = obtenerProductos($criterios);
} else {
    $criterios = [
        'buscar_titulo' => isset($_GET['buscar_titulo']) ? $_GET['buscar_titulo'] : "",
        'buscar_autor' => isset($_GET['buscar_autor']) ? $_GET['buscar_autor'] : "",
        'buscar_genero' => isset($_GET['buscar_genero']) ? $_GET['buscar_genero'] : "",
        'buscar_anio' => isset($_GET['buscar_anio']) ? $_GET['buscar_anio'] : "",
        'buscar_precio' => isset($_GET['buscar_precio']) ? $_GET['buscar_precio'] : "",
        'buscar_editorial' => isset($_GET['buscar_editorial']) ? $_GET['buscar_editorial'] : ""
    ];
    $resultados = obtenerLibros($criterios);
}

// Mensaje si la búsqueda no tiene resultados
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
        // Carga el producto desde la base de datos
        $producto = obtenerProductoPorCodigo($codigo);
    } elseif ($tabla == 'libros') {
        // Carga el libro desde la base de datos
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

    <!-- Tabla de productos con botones de acción -->
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
        <?php while ($row = mysqli_fetch_assoc($resultados)): ?>
            <?php if ($tabla == 'productos'): ?>
                <?php if ($row['CODIGOARTICULO'] === null)
                    continue; ?>
                <!-- Código para la tabla de productos -->
                <tr>
                    <td><?php echo htmlspecialchars($row['CODIGOARTICULO']); ?></td>
                    <td><?php echo $row['SECCION'] !== null ? htmlspecialchars($row['SECCION']) : ''; ?></td>
                    <td><?php echo $row['NOMBREARTICULO'] !== null ? htmlspecialchars($row['NOMBREARTICULO']) : ''; ?></td>
                    <td><?php echo $row['PRECIO'] !== null ? htmlspecialchars($row['PRECIO']) : ''; ?></td>
                    <td><?php echo $row['FECHA'] !== null ? htmlspecialchars($row['FECHA']) : ''; ?></td>
                    <td><?php echo $row['IMPORTADO'] !== null ? htmlspecialchars($row['IMPORTADO']) : ''; ?></td>
                    <td><?php echo $row['PAISDEORIGEN'] !== null ? htmlspecialchars($row['PAISDEORIGEN']) : ''; ?></td>
                    <td class="actions">
                        <!-- Botón para enviar registro -->
                        <form method="post" action="enviar_registro.php" style="display:inline;">
                            <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">
                            <input type="hidden" name="codigo"
                                value="<?php echo htmlspecialchars($tabla == 'productos' ? $row['CODIGOARTICULO'] : $row['id']); ?>">
                            <button type="submit" name="enviar_registro" class="send-button">Enviar Registro</button>
                        </form>

                        <?php if ($tipo_usuario == 'admin'): ?>
                            <!-- Botón para modificar y eliminar -->
                            <a href="?tabla=<?php echo $tabla; ?>&editar=<?php echo urlencode($row['CODIGOARTICULO'] ?? $row['id']); ?>#formulario-modificar"
                                class="action-button">Modificar</a>
                            <a href="acciones.php?eliminar=<?php echo urlencode($row['CODIGOARTICULO'] ?? $row['id']); ?>&tabla=<?php echo $tabla; ?>"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este <?php echo $tabla; ?>?');"
                                class="action-button">Eliminar</a>

                            <!-- Botón de subir imagen -->
                            <form method="post" action="subir_imagen.php" enctype="multipart/form-data" class="upload-form">
                                <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">
                                <input type="hidden" name="codigo"
                                    value="<?php echo htmlspecialchars($tabla == 'productos' ? $row['CODIGOARTICULO'] : $row['id']); ?>">

                                <!-- Input de archivo oculto -->
                                <input type="file" name="imagen" id="file-input-<?php echo $row['CODIGOARTICULO'] ?? $row['id']; ?>"
                                    style="display: none;" required>

                                <!-- Botón que actúa como disparador del input de archivo -->
                                <button type="button"
                                    onclick="document.getElementById('file-input-<?php echo $row['CODIGOARTICULO'] ?? $row['id']; ?>').click();"
                                    class="upload-button">Elegir Imagen</button>

                                <!-- Botón de enviar -->
                                <button type="submit" class="upload-button">Subir Imagen</button>
                            </form>

                        <?php endif; ?>
                    </td>

                </tr>
            <?php elseif ($tabla == 'libros'): ?>
                <!-- Código para la tabla de libros -->
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo $row['titulo'] !== null ? htmlspecialchars($row['titulo']) : ''; ?></td>
                    <td><?php echo $row['autor'] !== null ? htmlspecialchars($row['autor']) : ''; ?></td>
                    <td><?php echo $row['genero'] !== null ? htmlspecialchars($row['genero']) : ''; ?></td>
                    <td><?php echo $row['anio_publicacion'] !== null ? htmlspecialchars($row['anio_publicacion']) : ''; ?></td>
                    <td><?php echo $row['precio'] !== null ? htmlspecialchars($row['precio']) : ''; ?></td>
                    <td><?php echo $row['stock'] !== null ? htmlspecialchars($row['stock']) : ''; ?></td>
                    <td><?php echo $row['editorial'] !== null ? htmlspecialchars($row['editorial']) : ''; ?></td>
                    <td class="actions">
                        <!-- Botones de acción para libros -->
                        <form method="post" action="enviar_registro.php" style="display:inline;">
                            <input type="hidden" name="tabla" value="libros">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button type="submit" name="enviar_registro" class="send-button">Enviar Registro</button>
                        </form>
                        <?php if ($tipo_usuario == 'admin'): ?>
                            <a href="?tabla=libros&editar=<?php echo urlencode($row['id']); ?>#formulario-modificar"
                                class="action-button">Modificar</a>
                            <a href="acciones.php?eliminar=<?php echo urlencode($row['id']); ?>&tabla=libros"
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?');"
                                class="action-button">Eliminar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endwhile; ?>

    </table>

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
                    <input type="date" name="fecha" required>
                    <select name="importado" required>
                        <option value="">Importado</option>
                        <option value="VERDADERO">Verdadero</option>
                        <option value="FALSO">Falso</option>
                    </select>
                    <input type="text" name="pais" placeholder="País de origen" required>

                    <!-- Botón para elegir una imagen -->
                    <label for="file-input" class="upload-button-label">Elegir Imagen</label>
                    <input type="file" name="imagen" id="file-input" class="upload-button" required>

                    <!-- Botón para subir la imagen -->
                    <button type="submit" class="upload-button">Subir Imagen</button>

                <?php elseif ($tabla == 'libros'): ?>
                    <!-- Campos para agregar un libro -->
                    <input type="text" name="titulo" placeholder="Título" required>
                    <input type="text" name="autor" placeholder="Autor" required>
                    <input type="text" name="genero" placeholder="Género" required>
                    <input type="number" name="anio_publicacion" placeholder="Año de Publicación" required>
                    <input type="number" name="precio" placeholder="Precio" step="0.01" required>
                    <input type="number" name="stock" placeholder="Stock" required>
                    <input type="text" name="editorial" placeholder="Editorial" required>

                    <!-- Botón para elegir una imagen -->
                    <label for="file-input" class="upload-button-label">Elegir Imagen</label>
                    <input type="file" name="imagen" id="file-input" class="upload-button" required>

                    <!-- Botón para subir la imagen -->
                    <button type="submit" class="upload-button">Subir Imagen</button>
                <?php endif; ?>

                <!-- Botón para agregar el producto o libro -->
                <input type="submit" name="crear"
                    value="Agregar <?php echo $tabla == 'productos' ? 'Producto' : 'Libro'; ?>">
            </form>

            <!-- Formulario para modificar producto o libro -->
            <?php if ($tipo_usuario == 'admin' && $producto !== null): ?>
                <form id="formulario-modificar" method="POST" action="acciones.php">
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

                    <input type="submit" name="actualizar"
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