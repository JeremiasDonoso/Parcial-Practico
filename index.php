<?php
require_once "clases/myConexionPDO.php";

$sql = new mod_db();

$paises = $sql->obtenerPaises();
$areas = $sql->obtenerAreasInteres();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Inscriptores iTECH</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body class="bg-light">

    <div class="container mt-5 mb-5">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h2 class="text-center mb-0">
                    Registro de Inscriptores iTECH
                </h2>
            </div>

            <div class="card-body">

                <form method="POST" action="guardar.php">

                    <!-- Documento -->
                    <div class="mb-3">
                        <label class="form-label">Documento de Identificación</label>
                        <input
                            type="text"
                            class="form-control"
                            name="documento"
                            placeholder="Ingrese el documento"
                            required>
                    </div>

                    <div class="row">

                        <!-- Nombre -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input
                                type="text"
                                class="form-control"
                                name="nombre"
                                required>
                        </div>

                        <!-- Apellido -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apellido</label>
                            <input
                                type="text"
                                class="form-control"
                                name="apellido"
                                required>
                        </div>

                    </div>

                    <div class="row">

                        <!-- Edad -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Edad</label>
                            <input
                                type="number"
                                class="form-control"
                                name="edad"
                                min="1"
                                max="120"
                                required>
                        </div>

                        <!-- Sexo -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Sexo
                            </label>

                            <select
                                class="form-select"
                                name="sexo"
                                required>

                                <option value="">Seleccione...</option>

                                <option value="Masculino">
                                    Masculino
                                </option>

                                <option value="Femenino">
                                    Femenino
                                </option>

                                <option value="Otro">
                                    Otro
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <!-- País -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                País de Residencia
                            </label>

                            <select
                                class="form-select"
                                name="pais_residencia_id"
                                required>

                                <option value="">
                                    Seleccione...
                                </option>

                                <?php foreach($paises as $pais){ ?>

                                    <option value="<?= $pais["id"] ?>">

                                        <?= $pais["nombre"] ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <!-- Nacionalidad -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Nacionalidad
                            </label>

                            <select
                                class="form-select"
                                name="nacionalidad_id"
                                required>

                                <option value="">
                                    Seleccione...
                                </option>

                                <?php foreach($paises as $pais){ ?>

                                    <option value="<?= $pais["id"] ?>">

                                        <?= $pais["nombre"] ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <!-- Correo -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Correo Electrónico
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                name="correo"
                                required>

                        </div>

                        <!-- Celular -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Celular
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="celular"
                                required>

                        </div>

                    </div>

                    <!-- Temas -->

                    <div class="mb-3">

                        <label class="form-label">

                            Tema Tecnológico que le gustaría aprender

                        </label>

                        <div class="row">

                            <?php foreach($areas as $area){ ?>

                                <div class="col-md-4 mb-2">

                                    <div class="form-check">

                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="temas[]"
                                            value="<?= $area["id"] ?>">

                                        <label class="form-check-label">

                                            <?= $area["nombre"] ?>

                                        </label>

                                    </div>

                                </div>

                            <?php } ?>

                        </div>

                    </div>

                    <!-- Observaciones -->

                    <div class="mb-3">

                        <label class="form-label">

                            Observaciones

                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            name="observaciones"></textarea>

                    </div>

                    <div class="d-grid gap-2">

                        <button
                            type="submit"
                            class="btn btn-success btn-lg">

                            Guardar Inscriptor

                        </button>

                        <a
                            href="reporte.php"
                            class="btn btn-primary btn-lg">

                            Ver Reporte

                        </a>

                    </div>

                </form>

            </div>

            <div class="card-footer text-center">

                © <?= date("Y") ?> iTECH. All rights reserved.

            </div>

        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>