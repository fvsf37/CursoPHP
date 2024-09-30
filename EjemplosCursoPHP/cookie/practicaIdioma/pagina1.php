<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

      <!--
        <?php
        /*
        if (empty($_COOKIE["idiomaSeleccionado"])){
            
            echo '<table align="center">
            <tr>
                <td align="center"><a href="creaCookie.php?idioma=es"><img src="img/espana.png" width=250px></a></td>
                <td align="center"><a href="creaCookie.php?idioma=en"><img src="img/ingles.png" width=250px></a></td>
            </tr>
    
            </table>';

        }else if ($_COOKIE['idiomaSeleccionado']=='es'){
            header("Location:espana.php");
        }else if ($_COOKIE['idiomaSeleccionado']=='en'){
            header("Location:ingles.php");
        }
        */
        ?>
      -->

        <?php
            if(isset($_COOKIE["idiomaSeleccionado"])){

                if ($_COOKIE['idiomaSeleccionado']=='es'){
                    header("Location:espana.php");
                }else if ($_COOKIE['idiomaSeleccionado']=='en'){
                    header("Location:ingles.php");
                }

            }
        ?>
        <table align="center">
            <tr>
                <td align="center"><a href="creaCookie.php?idioma=es"><img src="img/espana.png" width=250px></a></td>
                <td align="center"><a href="creaCookie.php?idioma=en"><img src="img/ingles.png" width=250px></a></td>
            </tr>
         </table>

</body>
</html>