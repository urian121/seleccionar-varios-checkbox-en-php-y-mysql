<?php
require_once("config/settingBD.php");
require_once("functions/functions.php");

$ACTION = $_POST['action'] ?? null;
$id_dev = $_POST['id_dev'] ?? null;
$habilidades = json_decode($_POST['id_habilidad'] ?? '[]', true);
$response = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($ACTION)) {
    if ($ACTION === 'agregar_habilidad') {

        $id_habilidad = $_POST['id_habilidad'] ?? null;

        if ($id_dev && $id_habilidad) {
            $query = "SELECT * FROM tbl_habilidades_dev WHERE id_dev='$id_dev' AND id_habilidad='$id_habilidad'";
            $result = $conexion->query($query);

            if ($result->num_rows > 0) {
                $deleteResult = $conexion->query("DELETE FROM tbl_habilidades_dev WHERE id_dev='$id_dev' AND id_habilidad='$id_habilidad'");
                $response['mensaje'] = $deleteResult ? "Habilidad eliminada" : "Error al eliminar la habilidad: " . $conexion->error;
            } else {
                $insertResult = $conexion->query("INSERT INTO tbl_habilidades_dev (id_dev, id_habilidad) VALUES ('$id_dev', '$id_habilidad')");
                $response['mensaje'] = $insertResult ? "Habilidad asignada" : "Error al asignar la habilidad: " . $conexion->error;
            }
        } else {
            $response['error'] = "Faltan datos (id_dev o id_habilidad).";
        }
    } else if ($ACTION === 'desmarcar_marcar_todos') {
        if (!is_array($habilidades)) {
            echo json_encode(['error' => 'Formato inválido para habilidades']);
            exit;
        }

        // Se eliminan todas las habilidades antes de agregar nuevas si $habilidades tiene elementos.
        $conexion->query("DELETE FROM tbl_habilidades_dev WHERE id_dev='$id_dev'");

        // Si el array de habilidades no está vacío, insertamos las nuevas habilidades
        if (!empty($habilidades)) {
            $values = [];
            foreach ($habilidades as $habilidad) {
                $values[] = "('$id_dev', '$habilidad')";
            }

            $query = "INSERT INTO tbl_habilidades_dev (id_dev, id_habilidad) VALUES " . implode(',', $values);
            $conexion->query($query);
        }

        echo json_encode([
            'mensaje' => empty($habilidades) ? 'Todas las habilidades eliminadas' : 'Habilidades actualizadas correctamente',
            'habilidades' => $habilidades
        ]);
    }
} else {
    $response['error'] = "Método no permitido o falta de acción.";
}

echo json_encode($response);
