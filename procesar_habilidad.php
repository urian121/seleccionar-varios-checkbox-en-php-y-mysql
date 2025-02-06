<?php
require_once("config/settingBD.php");
require_once("functions/functions.php");

$id_dev = $_POST['id_dev'];
$id_habilidad  = $_POST['id_habilidad'];

$query = "SELECT * FROM tbl_habilidades_dev WHERE id_dev='$id_dev' AND id_habilidad='$id_habilidad'";
$result = $conexion->query($query);

if ($result->num_rows > 0) {
    $deleteResult = $conexion->query("DELETE FROM tbl_habilidades_dev WHERE id_dev='$id_dev' AND id_habilidad='$id_habilidad'");
    $response['mensaje'] = $deleteResult ? "Habilidad eliminada" : "Error al eliminar la habilidad: " . $conexion->error;
} else {
    $insertResult = $conexion->query("INSERT INTO tbl_habilidades_dev (id_dev, id_habilidad) VALUES ('$id_dev', '$id_habilidad')");
    $response['mensaje'] = $insertResult ? "Habilidad asignada" : "Error al asignar la habilidad: " . $conexion->error;
}

echo json_encode($response);
