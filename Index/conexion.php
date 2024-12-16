<?php

$host = "localhost";
$User = "root";
$pass = "";

$db = "iniciosesiondb";

$conexion = mysqli_connect($host, $User, $pass, $db);

if (!$conexion) {

    echo "Error al conectar a la base de datos";
}

?>