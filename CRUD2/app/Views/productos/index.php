<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <style>
        /* General Styles */
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212;
            /* Fondo oscuro */
            margin: 0;
            padding: 0;
            color: #ffffff;
            /* Texto claro */
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Contenedor principal */
        .product-list-container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background: #1e1e1e;
            /* Fondo oscuro */
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Título principal */
        .product-list-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #ffffff;
            /* Blanco */
            padding-bottom: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid #ffffff;
        }

        /* Barra de búsqueda */
        .product-search-form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .product-search-input {
            width: 70%;
            padding: 12px;
            background: #2c2c2c;
            border: 1px solid #3a3a3a;
            border-radius: 6px;
            font-size: 14px;
            color: #ffffff;
        }

        .product-search-input:focus {
            border-color: #007bff;
            /* Azul */
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .product-search-btn {
            padding: 10px 20px;
            background-color: #007bff;
            /* Azul */
            color: #ffffff;
            font-size: 14px;
            font-weight: bold;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product-search-btn:hover {
            background-color: #0056b3;
        }

        /* Selector de paginación */
        .product-pagination-form {
            margin-bottom: 20px;
        }

        .product-pagination-label {
            margin-right: 10px;
            font-weight: bold;
        }

        .product-pagination-select {
            padding: 10px;
            background: #2c2c2c;
            color: #ffffff;
            border: 1px solid #3a3a3a;
            border-radius: 6px;
        }

        .product-pagination-select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Enlace para agregar producto */
        .product-add-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .product-add-btn {
            padding: 12px 20px;
            background-color: #38a169;
            /* Verde */
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .product-add-btn:hover {
            background-color: #2f855a;
            transform: translateY(-2px);
        }

        /* Tabla */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #3a3a3a;
            padding: 14px;
            text-align: left;
            font-size: 14px;
            color: #ffffff;
        }

        .product-table th {
            background-color: #2a2a2a;
            font-weight: bold;
            text-transform: uppercase;
        }

        .product-table tr:nth-child(even) {
            background-color: #252525;
        }

        .product-table tr:hover {
            background-color: #383838;
        }

        .product-no-results {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #ff6b6b;
            /* Rojo */
        }

        /* Botones de acción */
        .product-action-btn {
            display: inline-block;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .product-edit-btn {
            background-color: #f4a261;
            /* Naranja */
            color: #212529;
        }

        .product-edit-btn:hover {
            background-color: #e76f51;
        }

        .product-delete-btn {
            background-color: #e53e3e;
            /* Rojo */
            color: #ffffff;
        }

        .product-delete-btn:hover {
            background-color: #c53030;
        }
    </style>
</head>

<body>
    <div class="product-list-container">
        <h1 class="product-list-title" style="color:white">Lista de Productos</h1>

        <!-- Barra de búsqueda -->
        <form method="get" action="<?= site_url('productos') ?>" class="product-search-form">
            <input type="text" name="search" placeholder="Buscar..." value="<?= esc($search ?? '') ?>"
                class="product-search-input">
            <button type="submit" class="product-search-btn">Buscar</button>
        </form>

        <!-- Selector de cantidad de productos por página -->
        <form method="get" action="<?= site_url('productos') ?>" class="product-pagination-form">
            <label for="perPage" class="product-pagination-label">Mostrar:</label>
            <select name="perPage" id="perPage" class="product-pagination-select" onchange="this.form.submit()">
                <option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5</option>
                <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
                <option value="20" <?= ($perPage == 20) ? 'selected' : '' ?>>20</option>
            </select>
        </form>

        <!-- Enlace para agregar producto -->
        <div class="product-add-container">
            <a href="<?= site_url('productos/agregar') ?>" class="product-add-btn">Agregar Producto</a>
        </div>

        <!-- Tabla de productos -->
        <table class="product-table">
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
                                <a href="<?= site_url('productos/editar/' . $producto['id']) ?>"
                                    class="product-action-btn product-edit-btn">Editar</a>
                                <a href="<?= site_url('productos/eliminar/' . $producto['id']) ?>"
                                    class="product-action-btn product-delete-btn"
                                    onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="product-no-results">No se encontraron productos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="product-pagination-container">
            <?= $pager->links('productos', 'default_full') ?>
        </div>
    </div>
</body>

</html>