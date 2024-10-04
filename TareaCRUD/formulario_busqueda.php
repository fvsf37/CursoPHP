<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Búsqueda de Productos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      padding: 0;
    }

    .container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .container h1 {
      margin-bottom: 20px;
      color: #333;
    }

    .form-container {
      margin-bottom: 20px;
    }

    .form-container input[type="text"] {
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .form-container input[type="submit"] {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-container input[type="submit"]:hover {
      background-color: #0056b3;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table th,
    table td {
      padding: 10px;
      border: 1px solid #ddd;
    }

    table th {
      background-color: #007bff;
      color: white;
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
        echo '<p>No se encontraron resultados.</p>';
      }

      mysqli_close($conexion);
    }
    ?>

  </div>

</body>

</html>