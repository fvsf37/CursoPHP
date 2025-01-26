<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <!-- Archivos CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/general.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/add.css') ?>">
</head>

<body>
    <!-- Contenedor específico para agregar -->
    <div class="container-add">
        <h1 class="add-title">Agregar Producto</h1>

        <!-- Mostrar errores de validación -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Formulario para agregar producto -->
        <form action="<?= base_url('productos/agregar') ?>" method="post" class="form-add">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?= old('nombre') ?>"
                    placeholder="Nombre del producto" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" placeholder="Descripción del producto"
                    required><?= old('descripcion') ?></textarea>
            </div>

            <div class="form-group">
                <label for="categoria">Categoría</label>
                <input type="text" id="categoria" name="categoria" value="<?= old('categoria') ?>"
                    placeholder="Categoría del producto" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" step="0.01" value="<?= old('precio') ?>"
                    placeholder="Precio del producto" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" value="<?= old('stock') ?>"
                    placeholder="Cantidad disponible" required>
            </div>

            <div class="form-group">
                <label for="id_productor">ID del Productor (opcional)</label>
                <input type="number" id="id_productor" name="id_productor" value="<?= old('id_productor') ?>"
                    placeholder="ID del productor">
            </div>

            <!-- Botones de acción -->
            <div class="form-buttons">
                <button type="submit" class="button-main button-add">Agregar Producto</button>
                <a href="<?= base_url('productos') ?>" class="button-main button-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>