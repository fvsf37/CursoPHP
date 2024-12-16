<?php
// Constante para definir el host de la base de datos, en este caso "localhost", que significa que la base de datos está en el mismo servidor.
define('DB_HOST', 'localhost');

// Constante para definir el nombre de usuario de la base de datos, en este caso "root", que es el usuario predeterminado para servidores locales de MySQL.
define('DB_USUARIO', 'root');

// Constante para definir la contraseña del usuario de la base de datos, en este caso está vacía ('') ya que no se ha establecido una contraseña para el usuario "root" en este entorno.
define('DB_CONTRA', '');

// Constante para definir el nombre de la base de datos a la que se quiere conectar, en este caso la base de datos se llama "pruebas".
define('DB_NOMBRE', 'pruebas');

// Constante para definir el conjunto de caracteres a utilizar en la conexión con la base de datos, en este caso "utf8" para manejar correctamente caracteres especiales.
define('DB_CHARSET', 'utf8');
?>