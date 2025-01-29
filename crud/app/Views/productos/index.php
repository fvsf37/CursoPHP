<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <style>
        /* Estilos generales (Modo Oscuro) */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            /* Fondo oscuro */
            color: #e0e0e0;
            /* Texto en gris claro */
            margin: 0;
            padding: 0;
        }

        /* Contenedor principal */
        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: #1e1e1e;
            /* Fondo oscuro para el contenido */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Títulos */
        h1 {
            text-align: center;
            color: #ffffff;
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* Botón de Agregar */
        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            transition: 0.3s;
        }

        .btn-primary {
            background-color: #0d6efd;
            color: white;
            margin-bottom: 15px;
        }

        .btn-primary:hover {
            background-color: #0a58ca;
            transform: scale(1.05);
        }

        /* Tabla */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: #222;
            /* Fondo oscuro para la tabla */
            border-radius: 8px;
            overflow: hidden;
        }

        .table th,
        .table td {
            padding: 12px;
            border: 1px solid #333;
            text-align: center;
        }

        /* Cabecera de la tabla */
        .table th {
            background-color: #0d6efd;
            color: white;
            font-size: 16px;
            text-transform: uppercase;
        }

        /* Filas pares con efecto sutil */
        .table tr:nth-child(even) {
            background-color: #2a2a2a;
        }

        /* Efecto hover en filas */
        .table tr:hover {
            background-color: #383838;
            transition: background 0.3s;
        }

        /* Botones de Acción */
        .btn-edit {
            background-color: #ffc107;
            color: #222;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-delete:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            .table,
            .table th,
            .table td {
                font-size: 14px;
            }

            .btn {
                display: block;
                text-align: center;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Lista de Productos</h1>
        <a href="<?= base_url('producto/create') ?>" class="btn btn-primary">➕ Agregar Producto</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio Venta</th>
                    <th>Precio Compra</th>
                    <th>Existencias</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto['codigo'] ?></td>
                        <td><?= $producto['descripcion'] ?></td>
                        <td>$<?= number_format($producto['precioVenta'], 2) ?></td>
                        <td>$<?= number_format($producto['precioCompra'], 2) ?></td>
                        <td><?= $producto['existencias'] ?></td>
                        <td>
                            <a href="<?= base_url('producto/edit/' . $producto['id']) ?>" class="btn btn-edit">✏️ Editar</a>
                            <a href="<?= base_url('producto/delete/' . $producto['id']) ?>" class="btn btn-delete"
                                onclick="return confirm('¿Eliminar este producto?')">❌ Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>