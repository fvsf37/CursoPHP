<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>

<body>
    <div class="container">
        <h1>Editar Producto</h1>

        <!-- Mostrar mensajes de error -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('errors') ?>
            </div>
        <?php endif; ?>

        <!-- Formulario para editar el producto -->
        <form action="<?= base_url('productos/editar/' . $producto['id']) ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= esc($producto['nombre']) ?>" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?= esc($producto['descripcion']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" value="<?= esc($producto['categoria']) ?>" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" value="<?= esc($producto['precio']) ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" value="<?= esc($producto['stock']) ?>" required>
            </div>

            <div class="form-group">
                <label for="id_productor">ID del Productor:</label>
                <input type="number" id="id_productor" name="id_productor"
                    value="<?= esc($producto['id_productor']) ?>">
            </div>

            <button type="submit" class="button">Guardar Cambios</button>
            <a href="<?= base_url('productos') ?>" class="button button-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>