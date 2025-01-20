<!DOCTYPE html>
<html>

<head>
    <title>Lista de Productos</title>
</head>

<body>
    <h1>Lista de Productos</h1>

    <!-- Barra de búsqueda -->
    <form method="get" action="<?= site_url('productos') ?>">
        <input type="text" name="search" placeholder="Buscar..." value="<?= esc($search ?? '') ?>">
        <button type="submit">Buscar</button>
    </form>

    <!-- Selector de cantidad de productos por página -->
    <form method="get" action="<?= site_url('productos') ?>">
        <label for="perPage">Mostrar:</label>
        <select name="perPage" id="perPage" onchange="this.form.submit()">
            <option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5</option>
            <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
            <option value="20" <?= ($perPage == 20) ? 'selected' : '' ?>>20</option>
        </select>
    </form>

    <!-- Enlace para agregar producto -->
    <a href="<?= site_url('productos/agregar') ?>">Agregar Producto</a>

    <!-- Tabla de productos -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= esc($producto['id']) ?></td>
                        <td><?= esc($producto['nombre']) ?></td>
                        <td><?= esc($producto['descripcion']) ?></td>
                        <td><?= esc($producto['categoria']) ?></td>
                        <td><?= number_format($producto['precio'], 2) ?></td>
                        <td><?= esc($producto['stock']) ?></td>
                        <td>
                            <a href="<?= site_url('productos/editar/' . $producto['id']) ?>">Editar</a>
                            <a href="<?= site_url('productos/eliminar/' . $producto['id']) ?>"
                                onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No se encontraron productos.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Paginación -->
    <?= $pager->links('productos', 'default_full') ?>
</body>

</html>