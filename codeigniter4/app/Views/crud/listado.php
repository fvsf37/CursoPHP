<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Listado</title>
    <link rel="stylesheet" href="/css/crud.css" type="text/css" />
</head>
<body>

<?php echo view('crud/header', ['header_title' => 'Listado']); ?>

<main>
    <div id="search_bar">
        <form action="/crud" method="get">
            <input type="text" name="buscar" placeholder="buscar" />
        </form>
    </div>
    <div id="tabla_articulos">
        <table>
            <thead>
                <tr>
                    <th><a href="">Código</a></th>
                    <th><a href="">Descripción</a></th>
                    <th><a href="">P. Venta</a></th>
                    <th><a href="">P. Compra</a></th>
                    <th><a href="">Exis.</a></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php

if( !empty($productos) )
{
    foreach( $productos as $linea ) {
?>
                <tr>
                    <td><?php echo $linea['codigo']; ?></td>
                    <td class="left pl-20"><?php echo $linea['descripcion']; ?></td>
                    <td><?php echo str_replace('.', ',', $linea['precioVenta']); ?> €</td>
                    <td><?php echo str_replace('.', ',', $linea['precioCompra']); ?> €</td>
                    <td><?php echo $linea['existencias']; ?></td>
                    <td class="buttons"><a href><img src="/img/edit.svg" /></a> <a href><img src="/img/delete.svg" /></a></td>
                </tr>
<?php
    }
}

?>
            </tbody>
        </table>
    </div>
    <div id="paginacion">
        <div></div>
        <div><a href="" class="active">1</a><a href="">2</a><a href="">3</a><a href="">4</a></div>
        <div>
            <select id="registros_por_pagina">
                <option value="">10</option>
                <option value="">20</option>
                <option value="">50</option>
            </select>
            <label for="registros_por_pagina">Registros por página</label>
        </div>
    </div>
</main>

</body>
</html>
