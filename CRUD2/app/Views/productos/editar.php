<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
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
        .edit-product-container {
            width: 90%;
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: #1e1e1e;
            /* Fondo oscuro */
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Título principal */
        .edit-product-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #f4a261;
            /* Naranja */
            padding-bottom: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid #f4a261;
        }

        /* Formulario */
        .edit-product-form {
            margin-top: 20px;
        }

        /* Grupos de formulario */
        .edit-product-group {
            margin-bottom: 20px;
        }

        /* Etiquetas de formulario */
        .edit-product-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #ffffff;
        }

        /* Campos de entrada */
        .edit-product-input,
        .edit-product-textarea {
            width: 100%;
            padding: 12px;
            background: #2c2c2c;
            border: 1px solid #3a3a3a;
            border-radius: 6px;
            font-size: 14px;
            color: #ffffff;
        }

        .edit-product-input:focus,
        .edit-product-textarea:focus {
            border-color: #f4a261;
            /* Naranja */
            outline: none;
            box-shadow: 0 0 5px rgba(244, 162, 97, 0.5);
        }

        /* Botones */
        .edit-product-actions {
            text-align: center;
        }

        .edit-product-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        /* Botón para actualizar */
        .edit-product-btn-submit {
            background-color: #f4a261;
            /* Naranja */
            color: #ffffff;
        }

        .edit-product-btn-submit:hover {
            background-color: #e76f51;
            transform: translateY(-2px);
        }

        /* Botón para cancelar */
        .edit-product-btn-cancel {
            background-color: #e53e3e;
            /* Rojo */
            color: #ffffff;
            margin-left: 10px;
        }

        .edit-product-btn-cancel:hover {
            background-color: #c53030;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="edit-product-container">
        <h1 class="edit-product-title">Editar Producto</h1>

        <form method="post" action="<?= site_url('productos/editar/' . $producto['id']) ?>" class="edit-product-form">
            <!-- Grupo de formulario para el nombre -->
            <div class="edit-product-group">
                <label for="edit-product-name" class="edit-product-label">Nombre:</label>
                <input type="text" name="nombre" id="edit-product-name" class="edit-product-input"
                    value="<?= esc($producto['nombre']) ?>" required>
            </div>

            <!-- Grupo de formulario para la descripción -->
            <div class="edit-product-group">
                <label for="edit-product-description" class="edit-product-label">Descripción:</label>
                <textarea name="descripcion" id="edit-product-description"
                    class="edit-product-textarea"><?= esc($producto['descripcion']) ?></textarea>
            </div>

            <!-- Grupo de formulario para la categoría -->
            <div class="edit-product-group">
                <label for="edit-product-category" class="edit-product-label">Categoría:</label>
                <input type="text" name="categoria" id="edit-product-category" class="edit-product-input"
                    value="<?= esc($producto['categoria']) ?>" required>
            </div>

            <!-- Grupo de formulario para el precio -->
            <div class="edit-product-group">
                <label for="edit-product-price" class="edit-product-label">Precio:</label>
                <input type="number" step="0.01" name="precio" id="edit-product-price" class="edit-product-input"
                    value="<?= esc($producto['precio']) ?>" required>
            </div>

            <!-- Grupo de formulario para el stock -->
            <div class="edit-product-group">
                <label for="edit-product-stock" class="edit-product-label">Stock:</label>
                <input type="number" name="stock" id="edit-product-stock" class="edit-product-input"
                    value="<?= esc($producto['stock']) ?>" required>
            </div>

            <!-- Grupo de formulario para el ID Productor -->
            <div class="edit-product-group">
                <label for="edit-product-producer-id" class="edit-product-label">ID Productor:</label>
                <input type="number" name="id_productor" id="edit-product-producer-id" class="edit-product-input"
                    value="<?= esc($producto['id_productor']) ?>">
            </div>

            <!-- Botones de acción -->
            <div class="edit-product-actions">
                <button type="submit" class="edit-product-btn edit-product-btn-submit">Actualizar</button>
                <a href="<?= site_url('productos') ?>" class="edit-product-btn edit-product-btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>