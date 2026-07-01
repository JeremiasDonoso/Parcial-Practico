<?php

require_once "clases/myConexionPDO.php";
require_once "clases/Sanitizer.php";
require_once "clases/Validation.php";

$sql = new mod_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitización
    $_POST["nombre"] = Sanitizer::texto($_POST["nombre"]);
    $_POST["apellido"] = Sanitizer::texto($_POST["apellido"]);
    $_POST["documento"] = Sanitizer::documento($_POST["documento"]);
    $_POST["correo"] = Sanitizer::correo($_POST["correo"]);
    $_POST["celular"] = Sanitizer::celular($_POST["celular"]);
    $_POST["observaciones"] = Sanitizer::observaciones($_POST["observaciones"]);

    // Validaciones
    $errores = [];

    if (!Validation::requerido($_POST["nombre"])) {
        $errores[] = "El nombre es obligatorio.";
    }

    if (!Validation::requerido($_POST["apellido"])) {
        $errores[] = "El apellido es obligatorio.";
    }

    if (!Validation::documento($_POST["documento"])) {
        $errores[] = "El documento no tiene un formato válido.";
    }

    if ($sql->existeDocumento($_POST["documento"])) {
        $errores[] = "Ya existe un inscriptor con ese documento.";
    }

    if (!Validation::correo($_POST["correo"])) {
        $errores[] = "El correo electrónico no es válido.";
    }

    if (!Validation::edad($_POST["edad"])) {
        $errores[] = "La edad debe estar entre 1 y 120 años.";
    }

    if (!Validation::temas($_POST["temas"] ?? [])) {
        $errores[] = "Debe seleccionar al menos un tema tecnológico.";
    }

    if (!Validation::celular($_POST["celular"])) {
        $errores[] = "El celular debe contener exactamente 8 dígitos.";
    }

    if (!empty($errores)) {

        $mensaje = implode("<br>", $errores);

        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>

        <script>

        Swal.fire({
            icon: 'error',
            title: 'Errores encontrados',
            html: '$mensaje',
            confirmButtonText: 'Volver'
        }).then(() => {
            window.location = 'index.php';
        });

        </script>

        </body>
        </html>";

        exit;
    }

    $cadena =
    $_POST["nombre"] .
    $_POST["documento"] .
    $_POST["correo"] .
    $_POST["celular"] .
    $_POST["sexo"];

    $privateKey = openssl_pkey_get_private(
        file_get_contents(__DIR__ . "/private.pem")
    );

    openssl_sign($cadena, $firma, $privateKey, OPENSSL_ALGO_SHA256);

    $_POST["firma"] = base64_encode($firma);

    // Guardar
    if ($sql->guardarInscripcion($_POST)) {

        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>

        <script>

        Swal.fire({
            icon: 'success',
            title: 'Registro guardado',
            text: 'La inscripción fue registrada correctamente.',
            confirmButtonText: 'Ver reporte'
        }).then(() => {
            window.location = 'reporte.php';
        });

        </script>

        </body>
        </html>";

    } else {

        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>

        <script>

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No fue posible guardar la información.',
            confirmButtonText: 'Volver'
        }).then(() => {
            window.location = 'index.php';
        });

        </script>

        </body>
        </html>";

    }

}