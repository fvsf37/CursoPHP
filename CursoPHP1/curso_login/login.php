<?php
try{
    $user = $_POST["usuario"];
    $pass = $_POST["contrasena"];

    $conexion = new PDO('mysql:host=localhost; dbname=pruebas' , 'root', '');
    $conexion->setAttribute(PDO ::ATTR_ERRMODE, PDO ::ERRMODE_EXCEPTION);
    //$consulta = "SELECT * FROM usuarios_pass WHERE USUARIOS=".$user." and PASSWORD=".$pass."";
    $consulta = "SELECT * FROM usuarios_pass WHERE USUARIOS=:login AND PASSWORD=:pass";
    $resultado = $conexion->prepare($consulta);

    $resultado->bindValue(":login",$user);
    $resultado->bindValue(":pass", $pass);

    $resultado->execute();

    $numero_registro=$resultado->rowCount();

    if($numero_registro!=0){
        header("location:acceso.php");
    }else{
        header("location:formulario.php");
    }
}catch(Exception $e){

        echo "El error es: "  .$e->getMessage();
}
?>