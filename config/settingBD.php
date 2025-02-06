<?php
$ModoProduccion = false;
if ($ModoProduccion) {
    $host = "xx.xx.xxx.xx";
    $usuario = "";
    $contrasena = "xxxxxxx";
    $base_de_datos = "bd_xyz";
} else {
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "bd_devs";
}

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
