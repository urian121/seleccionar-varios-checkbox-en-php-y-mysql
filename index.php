<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar múltiple CheckBox seleccionados con PHP y MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    <?php
    require_once("config/settingBD.php");
    require_once("functions/functions.php");
    $listDevs = getDevs($conexion);
    $listKills = getSkills($conexion);
    $listDevsSkills = getDevsSkills($conexion);
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <h4 class="text-center fw-bold border-bottom mb-4">Seleccione un Dev</h4>
                <ul class="list-group list-group-flush" id="devList">
                    <?php foreach ($listDevs as $index => $dev): ?>
                        <li class="list-group-item dev-item" id="<?= $dev["id_dev"]; ?>" data-id="<?= $dev["id_dev"]; ?>">
                            <label for="<?= $dev["id_dev"]; ?>" class="d-flex justify-content-between align-items-center cursor-pointer">
                                <span>
                                    <input class="custom_radio" type="radio" name="dev" id="dev_<?= $dev["id_dev"]; ?>" value="<?= $dev['id_dev'] ?>" style="cursor: pointer;">
                                    &nbsp; <?= $dev["name"]; ?>
                                </span>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="col-md-6">
                <h4 class="text-center fw-bold border-bottom mb-4">Habilidades</h4>
                <div class="form-group">
                    <div style="column-count: 3;" id="div_respuesta">
                        <?php foreach ($listKills as $skill): ?>
                            <label>
                                <input type="checkbox" name="id_habilidad[]" value="<?php echo $skill['id_habilidad']; ?>">
                                <?php echo $skill['skill']; ?>
                            </label>
                            <br>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="assets/js/home.js"></script>
</body>

</html>