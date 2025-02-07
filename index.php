<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar múltiple CheckBox seleccionados con JavaScript PHP y MySQL</title>
    <link rel="shortcut icon" href="https://www.urianviera.com/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    <?php
    require_once("config/settingBD.php");
    require_once("functions/functions.php");
    $listDevsSkills = getDevsSkills($conexion);
    $listKills = getSkills($conexion);
    ?>

    <div class="container mt-5">
        <h1 class="text-center mb-5 mt-4 border-bottom">
            Seleccionar y procesar múltiples CheckBox con <span style="color: #6e57c1;">JavaScript, PHP y MySQL</span>
        </h1>
        <div class="row justify-content-center mb-5">
            <div class="col-md-4">
                <h4 class="text-center fw-bold  mb-4 mt-5 mb-5">Lista de Devs 👨‍💻</h4>

                <ul class="list-group list-group-flush" id="devList">
                    <?php
                    foreach ($listDevsSkills as $dev): ?>
                        <li class="list-group-item dev-item" id="<?= $dev["id_dev"]; ?>" data-id="<?= $dev["id_dev"]; ?>">
                            <label for="<?= $dev["id_dev"]; ?>" class="d-flex justify-content-between align-items-center cursor-pointer">
                                <span>
                                    <input class="custom_radio" type="radio" name="dev" id="dev_<?= $dev["id_dev"]; ?>"
                                        value="<?= $dev['id_dev'] ?>" style="cursor: pointer;">
                                    &nbsp; <?= $dev["name"]; ?>
                                </span>
                                <span class="badge bg-primary" id="total_habilidades_<?php echo $dev['id_dev']; ?>"><?= $dev["habilidades"]; ?> habilidades</span>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="col-md-6 px-2">
                <h4 class="text-center fw-bold mb-4 mt-5 mb-5">Habilidades
                    <span class="float-end">
                        <button class="btn btn-primary btn-sm" id="seleccionarTodos" type="button" disabled>
                            <i class="bi bi-check2-square"></i>
                            Seleccionar Todos
                        </button>
                        <a href="./" class="btn btn-primary btn-sm"><i class="bi bi-arrow-clockwise"></i></a>
                    </span>
                </h4>
                <div class="form-group">
                    <div style="column-count: 3;" id="div_respuesta">
                        <?php foreach ($listKills as $skill): ?>
                            <label class="mb-3">
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
    <script type="module" src="assets/js/home.js"></script>
    <script type="module" src="assets/js/limpiar_checkbox_radios.js"></script>
    <script type="module" src="assets/js/seleccionar_todos.js"></script>
</body>

</html>