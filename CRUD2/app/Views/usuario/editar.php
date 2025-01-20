<!DOCTYPE html>
<html>

<head>
    <title>Editar Producto</title>
</head>

<body>
    <h1>Editar Producto</h1>
    <form method="post" action="<?= site_url('productos/editar/' . $producto['id']) ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= esc($producto['nombre']) ?>" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion"><?= esc($producto['descripcion']) ?></textarea><br><br>

        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" id="categoria" value="<?= esc($producto['categoria']) ?>" required><br><br>

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" id="precio" value="<?= esc($producto['precio']) ?>"
            required><br><br>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="<?= esc($producto['stock']) ?>" required><br><br>

        <label for="id_productor">ID Productor:</label>
        <input type="number" name="id_productor" id="id_productor"
            value="<?= esc($producto['id_productor']) ?>"><br><br>

        <button type="submit">Actualizar</button>
        <a href="<?= site_url('productos') ?>">Cancelar</a>
    </form>
</body>

</html>