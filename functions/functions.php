<?php

/**
 * Función para obtener los devs de la base de datos con el total de habilidades
 */
function getDevsSkills($conexion)
{
    $sql =
        "SELECT
            d.id_dev,
            d.name,
            COUNT(hd.id_habilidad) AS habilidades
        FROM tbl_devs AS d
        LEFT JOIN tbl_habilidades_dev AS hd ON d.id_dev = hd.id_dev
        GROUP BY d.id_dev, d.name";
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
