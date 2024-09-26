<?php view('template/header'); ?>
<div>Indícame tu edad</div>
<?php
if( !empty($error) )
{
    echo '<div style="border: 1px solid red; background-color: ee0000; padding:10px;">'.$error.'</div>';
}
?>
<div>
    <form action="http://localhost/codeigniter4/public/formularios/edad" method="post">
        <label for="edad">Tu edad</label>
        <input type="text" name="edad" id="edad">
        <input type="submit" value="Enviar">
    </form>

</div>
<?php view('template/footer'); ?>