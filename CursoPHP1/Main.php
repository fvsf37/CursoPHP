<?php 
include("Vehiculo.php");
 $renault = new Coche();
 $mazda = new Coche();
 $seat = new Coche();

 $mazda ->arrancar();
 $mazda ->girar();
 $mazda -> frenar();

 $mazda -> getRuedas();
 $mazda -> getMotor();
 $mazda -> establece_color("amarillo to feo");

 $mercedes = new Camion();
 $mercedes -> arrancar();
 $mercedes -> establece_color("rojo pene de perro")

?>