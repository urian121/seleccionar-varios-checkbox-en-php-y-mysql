<?php

function getDevs($conexion)
{
    $sql = "SELECT * FROM tbl_devs ORDER BY name DESC";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        return false;
    }
    return $resultado->fetch_all(MYSQLI_ASSOC);  // Esto devolverá los resultados como un array asociativo
}

function getSkills($conexion)
{
    $sql = "SELECT 
            id_habilidad, skill
        FROM tbl_habilidades ORDER BY skill ASC";
    $resultado = $conexion->query($sql);

    if (!$resultado) {
        return false;
    }
    return $resultado->fetch_all(MYSQLI_ASSOC);  // Esto devolverá los resultados como un array asociativo
}

function getDevsSkills($conexion)
{
    $sql = "SELECT d.name
            FROM tbl_devs AS d
            JOIN tbl_habilidades_dev AS hd ON d.id_dev = hd.id_skill_dev";
    $resultado = $conexion->query($sql);

    if (!$resultado) {
        return false;
    }
    return $resultado->fetch_all(MYSQLI_ASSOC);  // Esto devolverá los resultados como un array asociativo
}

function getHabilidadesDev($conexion, $id_dev)
{
    $sql = "SELECT h.id_habilidad, h.skill 
        FROM tbl_habilidades AS h
        JOIN tbl_habilidades_dev AS hd 
            ON h.id_habilidad = hd.id_habilidad 
        JOIN tbl_devs AS d 
            ON hd.id_dev = d.id_dev 
        WHERE d.id_dev = $id_dev";
    $resultado = $conexion->query($sql);

    if (!$resultado) {
        return false;
    }
    return $resultado->fetch_all(MYSQLI_ASSOC);  // Esto devolverá los resultados como un array asociativo

}
