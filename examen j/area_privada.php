<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>area_privada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        fieldset {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        legend {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }

        p {
            margin: 10px 0;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #28a745;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h2>Área privada</h2>
    <form action="blog_area_privada.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Blog</legend>
            <p>Título: <input type="text" name="titulo" id="titulo"></p>
            <p>Descripción<br><textarea id="descrip" name="descrip" rows="5" cols="33"></textarea></p>
            <p><input type="file" name="img" id="img"></p>
            <p><input type="submit" value="Guardar Blog"></p>
        </fieldset>
    </form>
</body>

</html>