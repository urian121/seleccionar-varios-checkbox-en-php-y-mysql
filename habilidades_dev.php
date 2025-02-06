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

$idsHabilidadesDev = array_column($habilidades_dev, 'id_habilidad'); // Extrae solo los IDs de habilidades que tiene el dev

$counter = 0;
foreach ($habilidades_disponibles as $habilidad_disponible) :
    if ($counter % 3 === 0) : ?>
        <ul class="list-group list-group-flush">
        <?php endif; ?>

        <li id="li_habilidad_<?= $habilidad_disponible['id_habilidad'] ?>" class="list-group-item">
            <label for="habilidad_<?= $habilidad_disponible['id_habilidad'] ?>" style="cursor: pointer;">
                <input class="custom_checkbox" type="checkbox" name="habilidades[]"
                    id="habilidad_<?= $habilidad_disponible['id_habilidad'] ?>"
                    value="<?= $habilidad_disponible['id_habilidad'] ?>"
                    <?php if (in_array($habilidad_disponible['id_habilidad'], $idsHabilidadesDev)) echo 'checked'; ?> />
                <?= $habilidad_disponible['skill'] ?>
            </label>
        </li>

        <?php
        $counter++;
        if ($counter % 3 === 0) : ?>
        </ul>
    <?php endif;
    endforeach;

    if ($counter % 3 !== 0) : ?>
    </ul>
<?php endif; ?>