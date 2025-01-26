<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <!-- Archivos CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/general.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
</head>

<body>
    <!-- Clase específica para la página principal -->
    <div class="container-main">
        <h1 class="main-title">Listado de Productos</h1>

        <!-- Mensajes de alerta -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <!-- Botón de agregar -->
        <div class="mb-10 text-center">
            <a href="<?= base_url('productos/agregar') ?>" class="button-main button-add">Agregar Producto</a>
        </div>

        <!-- Tabla de productos -->
        <?php if (isset($productos) && count($productos) > 0): ?>
            <table class="table-main">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= esc($producto['nombre']) ?></td>
                            <td><?= esc($producto['descripcion']) ?></td>
                            <td><?= esc($producto['categoria']) ?></td>
                            <td><?= esc(number_format($producto['precio'], 2)) ?></td>
                            <td><?= esc($producto['stock']) ?></td>
                            <td>
                                <a href="<?= base_url('productos/editar/' . $producto['id']) ?>"
                                    class="button-main button-warning">Editar</a>
                                <a href="<?= base_url('productos/eliminar/' . $producto['id']) ?>"
                                    class="button-main button-danger"
                                    onclick="return confirm('¿Está seguro de eliminar este producto?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="pagination-container">
                <?= $pager->links('productos', 'default_full') ?>
            </div>
        <?php else: ?>
            <p class="text-center">No hay productos disponibles.</p>
        <?php endif; ?>
    </div>
</body>

</html>