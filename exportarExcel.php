<?php

require_once "vendor/autoload.php";
require_once "clases/myConexionPDO.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = new mod_db();
$con = $sql->getConexion();

$documento = new Spreadsheet();

$documento->getProperties()
    ->setCreator("iTECH")
    ->setLastModifiedBy("iTECH")
    ->setTitle("Reporte de Inscriptores")
    ->setDescription("Reporte generado desde MariaDB");

$hoja = $documento->getActiveSheet();
$hoja->setTitle("Inscriptores");

// Encabezados
$encabezado = [
    "ID",
    "Documento",
    "Nombre",
    "Apellido",
    "Edad",
    "Sexo",
    "Residencia",
    "Nacionalidad",
    "Correo",
    "Celular",
    "Temas",
    "Observaciones"
];

$hoja->fromArray($encabezado, null, "A1");

// Consulta
$consulta = "
SELECT
    i.id,
    i.documento,
    i.nombre,
    i.apellido,
    i.edad,
    i.sexo,
    pr.nombre AS residencia,
    pn.nombre AS nacionalidad,
    i.correo,
    i.celular,
    GROUP_CONCAT(a.nombre SEPARATOR ', ') AS temas,
    i.observaciones
FROM inscriptores i
INNER JOIN paises pr
    ON pr.id = i.pais_residencia_id
INNER JOIN paises pn
    ON pn.id = i.nacionalidad_id
LEFT JOIN inscriptor_temas it
    ON it.inscriptor_id = i.id
LEFT JOIN areas_interes a
    ON a.id = it.area_interes_id
GROUP BY i.id
ORDER BY i.id DESC
";

$sentencia = $con->prepare($consulta, [
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL
]);

$sentencia->execute();

$fila = 2;

while ($reg = $sentencia->fetch(PDO::FETCH_OBJ)) {

    $hoja->setCellValue("A".$fila, $reg->id);
    $hoja->setCellValue("B".$fila, $reg->documento);
    $hoja->setCellValue("C".$fila, $reg->nombre);
    $hoja->setCellValue("D".$fila, $reg->apellido);
    $hoja->setCellValue("E".$fila, $reg->edad);
    $hoja->setCellValue("F".$fila, $reg->sexo);
    $hoja->setCellValue("G".$fila, $reg->residencia);
    $hoja->setCellValue("H".$fila, $reg->nacionalidad);
    $hoja->setCellValue("I".$fila, $reg->correo);
    $hoja->setCellValue("J".$fila, $reg->celular);
    $hoja->setCellValue("K".$fila, $reg->temas);
    $hoja->setCellValue("L".$fila, $reg->observaciones);

    $fila++;
}

// Crear carpeta si no existe
if (!is_dir("reportes")) {
    mkdir("reportes", 0777, true);
}

$writer = new Xlsx($documento);

$archivo = "reportes/Reporte_Inscriptores.xlsx";

$writer->save($archivo);

// Descargar automáticamente
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=Reporte_Inscriptores.xlsx");
header("Cache-Control: max-age=0");

readfile($archivo);
exit;