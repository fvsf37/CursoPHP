<!DOCTYPE html>
<html>

<head>
    <title>Agregar Producto</title>
</head>

<body>
    <h1>Agregar Producto</h1>
    <form method="post" action="<?= site_url('productos/agregar') ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion"></textarea><br><br>

        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" id="categoria" required><br><br>

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" id="precio" required><br><br>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="0" required><br><br>

        <label for="id_productor">ID Productor:</label>
        <input type="number" name="id_productor" id="id_productor"><br><br>

        <button type="submit">Guardar</button>
        <a href="<?= site_url('productos') ?>">Cancelar</a>
    </form>
</body>

</html>