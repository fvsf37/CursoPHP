<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>
        /* Modo Oscuro */
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }

        /* Contenedor */
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #1e1e1e;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Título */
        h1 {
            text-align: center;
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Formulario */
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        /* Labels alineados */
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #e0e0e0;
        }

        /* Inputs */
        input[type="text"],
        input[type="number"] {
            width: 90%;
            /* Evita que toque los bordes */
            max-width: 500px;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 5px;
            font-size: 16px;
            background: #2a2a2a;
            color: #e0e0e0;
            display: block;
            margin: 0 auto;
        }

        /* Resaltar los inputs al hacer foco */
        input:focus {
            outline: none;
            border-color: #0d6efd;
        }

        /* Botón de Guardar */
        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-primary {
            background-color: #0d6efd;
            color: white;
            width: 90%;
            /* Evita que toque los bordes */
            max-width: 500px;
            text-align: center;
            display: block;
            border: none;
            font-size: 16px;
            margin: 10px auto;
        }

        .btn-primary:hover {
            background-color: #0a58ca;
            transform: scale(1.05);
        }

        /* Botón de Volver */
        .btn-back {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #0d6efd;
            font-size: 16px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-back:hover {
            text-decoration: underline;
            color: #0a58ca;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
            }

            input[type="text"],
            input[type="number"],
            .btn-primary {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Editar Producto</h1>

        <form action="<?= base_url('producto/update/' . $producto['id']) ?>" method="POST">
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" name="codigo" id="codigo" value="<?= $producto['codigo'] ?>" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion" value="<?= $producto['descripcion'] ?>" required>
            </div>

            <div class="form-group">
                <label for="precioVenta">Precio Venta:</label>
                <input type="number" name="precioVenta" id="precioVenta" step="0.01"
                    value="<?= $producto['precioVenta'] ?>" required>
            </div>

            <div class="form-group">
                <label for="precioCompra">Precio Compra:</label>
                <input type="number" name="precioCompra" id="precioCompra" step="0.01"
                    value="<?= $producto['precioCompra'] ?>" required>
            </div>

            <div class="form-group">
                <label for="existencias">Existencias:</label>
                <input type="number" name="existencias" id="existencias" value="<?= $producto['existencias'] ?>"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">✅ Guardar Cambios</button>
        </form>

        <a href="<?= base_url('producto') ?>" class="btn-back">⬅ Volver a la lista</a>
    </div>

</body>

</html>