<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Búsqueda de Productos</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f0f4f8;
      color: #333;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      font-size: 24px;
      color: #333;
      margin-bottom: 20px;
    }

    form {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    input[type="text"] {
      padding: 10px;
      width: 300px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-right: 10px;
    }

    input[type="submit"] {
      background-color: #00796b;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #004d40;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
      padding: 15px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #00796b;
      color: white;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    tr:nth-child(even) td {
      background-color: #f1f1f1;
    }

    td {
      background-color: #fafafa;
    }

    .no-results {
      text-align: center;
      margin-top: 20px;
      font-size: 16px;
      color: #f44336;
    }
  </style>
</head>

<body>

  <div class="container">
    <h1>BÚSQUEDA DE PRODUCTOS</h1>
    <div class="form-container">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        <input type="text" id="buscar" name="buscar" placeholder="Buscar..." />
        <input type="submit" name="enviando" value="Buscar" />
      </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["buscar"])) {
      $busqueda = $_GET["buscar"];
      require("datos_conexion.php");

      $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

      if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit();
      }

      mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");
      mysqli_set_charset($conexion, "utf8");

      $consulta = "SELECT * FROM productos WHERE 
        CODIGOARTICULO LIKE '%$busqueda%' OR 
        SECCION LIKE '%$busqueda%' OR 
        NOMBREARTICULO LIKE '%$busqueda%' OR 
        PRECIO LIKE '%$busqueda%' OR 
        FECHA LIKE '%$busqueda%' OR 
        IMPORTADO LIKE '%$busqueda%' OR 
        PAISDEORIGEN LIKE '%$busqueda%'";

      $resultados = mysqli_query($conexion, $consulta);

      if (mysqli_num_rows($resultados) > 0) {
        echo '<table>';
        echo '<tr><th>Código</th><th>Sección</th><th>Nombre</th><th>Precio</th><th>Fecha</th><th>Importado</th><th>País</th></tr>';

        while ($fila = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
          echo '<tr>';
          echo '<td>' . $fila['CODIGOARTICULO'] . '</td>';
          echo '<td>' . $fila['SECCION'] . '</td>';
          echo '<td>' . $fila['NOMBREARTICULO'] . '</td>';
          echo '<td>' . $fila['PRECIO'] . '</td>';
          echo '<td>' . $fila['FECHA'] . '</td>';
          echo '<td>' . $fila['IMPORTADO'] . '</td>';
          echo '<td>' . $fila['PAISDEORIGEN'] . '</td>';
          echo '</tr>';
        }

        echo '</table>';
      } else {
        echo '<p class="no-results">No se encontraron resultados.</p>';
      }

      mysqli_close($conexion);
    }
    ?>
  </div>

</body>

</html>