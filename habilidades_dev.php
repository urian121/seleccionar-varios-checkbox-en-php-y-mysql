<?php
require_once("config/settingBD.php");
require_once("functions/functions.php");

$id_dev = $_REQUEST['id_dev'] ?? null;
$habilidades_dev = getHabilidadesDev($conexion, $id_dev); // Lista de habilidades actuales del dev
$habilidades_disponibles = getSkills($conexion); // Obtén las habilidades disponibles

if (!$habilidades_disponibles) {
    echo "<p>No se encontraron habilidades disponibles.</p>";
    exit;
}

$idsHabilidadesDev = array_column($habilidades_dev, 'id_habilidad'); // Extrae los IDs de habilidades del dev

foreach ($habilidades_disponibles as $habilidad) :
?>
    <label class="mb-3">
        <input type="checkbox" name="habilidades[]" value="<?= $habilidad['id_habilidad']; ?>"
            <?= in_array($habilidad['id_habilidad'], $idsHabilidadesDev) ? 'checked' : ''; ?>>
        <?= $habilidad['skill']; ?>
    </label>
    <br>
<?php
endforeach;
?>