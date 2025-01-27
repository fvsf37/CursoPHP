<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
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
        .add-product-container {
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
        .add-product-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #38a169;
            /* Verde */
            padding-bottom: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid #38a169;
        }

        /* Formulario */
        .add-product-form {
            margin-top: 20px;
        }

        /* Grupos de formulario */
        .add-product-group {
            margin-bottom: 20px;
        }

        /* Etiquetas de formulario */
        .add-product-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #ffffff;
        }

        /* Campos de entrada */
        .add-product-input,
        .add-product-textarea {
            width: 100%;
            padding: 12px;
            background: #2c2c2c;
            border: 1px solid #3a3a3a;
            border-radius: 6px;
            font-size: 14px;
            color: #ffffff;
        }

        .add-product-input:focus,
        .add-product-textarea:focus {
            border-color: #38a169;
            /* Verde */
            outline: none;
            box-shadow: 0 0 5px rgba(56, 161, 105, 0.5);
        }

        /* Botones */
        .add-product-actions {
            text-align: center;
        }

        .add-product-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        /* Botón para guardar */
        .add-product-btn-submit {
            background-color: #38a169;
            /* Verde */
            color: #ffffff;
        }

        .add-product-btn-submit:hover {
            background-color: #2f855a;
            transform: translateY(-2px);
        }

        /* Botón para cancelar */
        .add-product-btn-cancel {
            background-color: #e53e3e;
            /* Rojo */
            color: #ffffff;
            margin-left: 10px;
        }

        .add-product-btn-cancel:hover {
            background-color: #c53030;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="add-product-container">
        <h1 class="add-product-title">Agregar Producto</h1>

        <form method="post" action="<?= site_url('productos/agregar') ?>" class="add-product-form">
            <!-- Campo para el nombre del producto -->
            <div class="add-product-group">
                <label for="product-name" class="add-product-label">Nombre:</label>
                <input type="text" name="nombre" id="product-name" class="add-product-input"
                    placeholder="Nombre del producto" required>
            </div>

            <!-- Campo para la descripción del producto -->
            <div class="add-product-group">
                <label for="product-description" class="add-product-label">Descripción:</label>
                <textarea name="descripcion" id="product-description" class="add-product-textarea"
                    placeholder="Descripción del producto"></textarea>
            </div>

            <!-- Campo para la categoría del producto -->
            <div class="add-product-group">
                <label for="product-category" class="add-product-label">Categoría:</label>
                <input type="text" name="categoria" id="product-category" class="add-product-input"
                    placeholder="Categoría del producto" required>
            </div>

            <!-- Campo para el precio del producto -->
            <div class="add-product-group">
                <label for="product-price" class="add-product-label">Precio:</label>
                <input type="number" step="0.01" name="precio" id="product-price" class="add-product-input"
                    placeholder="Precio del producto" required>
            </div>

            <!-- Campo para el stock del producto -->
            <div class="add-product-group">
                <label for="product-stock" class="add-product-label">Stock:</label>
                <input type="number" name="stock" id="product-stock" class="add-product-input" value="0"
                    placeholder="Cantidad disponible" required>
            </div>

            <!-- Campo para el ID del productor -->
            <div class="add-product-group">
                <label for="product-producer-id" class="add-product-label">ID del Productor (opcional):</label>
                <input type="number" name="id_productor" id="product-producer-id" class="add-product-input"
                    placeholder="ID del productor">
            </div>

            <!-- Botones de acción -->
            <div class="add-product-actions text-center">
                <button type="submit" class="add-product-btn add-product-btn-submit">Agregar Producto</button>
                <a href="<?= site_url('productos') ?>" class="add-product-btn add-product-btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>