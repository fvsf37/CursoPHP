<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Insertar Registro</title>
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
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .form-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 400px;
      margin-bottom: 20px;
      text-align: center;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin: 10px 0 5px;
      color: #333;
      text-align: left;
    }

    input[type="text"] {
      width: 94%;
      padding: 10px;
      margin: 5px 0;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color: #007bff;
      color: white;
      padding: 10px;
      width: 100%;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
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
    <div class="form-container">
      <h1>INSERTAR REGISTRO</h1>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="cart">CODIGOARTICULO:</label>
        <input type="text" name="cart" id="cart" />

        <label for="secc">SECCION:</label>
        <input type="text" name="secc" id="secc" />

        <label for="nart">NOMBREARTICULO:</label>
        <input type="text" name="nart" id="nart" />

        <label for="pre">PRECIO:</label>
        <input type="text" name="pre" id="pre" />

        <label for="fech">FECHA:</label>
        <input type="text" name="fech" id="fech" />

        <label for="imp">IMPORTADO:</label>
        <input type="text" name="imp" id="imp" />

        <label for="porig">PAISDEORIGEN:</label>
        <input type="text" name="porig" id="porig" />

        <input type="submit" value="Insertar" />
      </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $codigoarticulo = $_POST["cart"];
      $seccion = $_POST["secc"];
      $nombrearticulo = $_POST["nart"];
      $precio = $_POST["pre"];
      $fecha = $_POST["fech"];
      $importado = $_POST["imp"];
      $paisdeorigen = $_POST["porig"];

      require("datos_conexion.php");

      $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

      if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit();
      }

      mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");
      mysqli_set_charset($conexion, "utf8");

      $consulta_comprobar = "SELECT CODIGOARTICULO FROM productos WHERE CODIGOARTICULO='$codigoarticulo'";
      $resultado_comprobar = mysqli_query($conexion, $consulta_comprobar);

      if (mysqli_num_rows($resultado_comprobar) > 0) {
        echo "<script>alert('El producto con el CODIGOARTICULO $codigoarticulo ya existe.');</script>";
      } else {
        $consulta = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES ('$codigoarticulo', '$seccion', '$nombrearticulo', '$precio',  '$fecha', '$importado', '$paisdeorigen')";
        $resultados = mysqli_query($conexion, $consulta);

        echo "<h2>Fila insertada:</h2>";
        echo "<table>";
        echo "<tr><th>Código</th><th>Sección</th><th>Nombre</th><th>Precio</th><th>Fecha</th><th>Importado</th><th>País</th></tr>";
        echo "<tr>";
        echo "<td>$codigoarticulo</td>";
        echo "<td>$seccion</td>";
        echo "<td>$nombrearticulo</td>";
        echo "<td>$precio</td>";
        echo "<td>$fecha</td>";
        echo "<td>$importado</td>";
        echo "<td>$paisdeorigen</td>";
        echo "</tr>";
        echo "</table>";
      }

      mysqli_close($conexion);
    }
    ?>

  </div>

</body>

</html>