<?php
require_once "vendor/autoload.php";
# Nuestra base de datos
require_once "clases/myConexionPDO.php";
$sql = new mod_db();

$con = $sql->getConexion(); 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

# Obtener base de datos
//$con = ConexionBD();

$documento = new Spreadsheet();
$documento
->getProperties()
->setCreator("Irina Fong")
->setLastModifiedBy('BaulPHP')
->setTitle('Archivo generado desde MySQL')
->setDescription('Colaboradores exportados desde MySQL');


$hojaDeProductos = $documento->getActiveSheet();
$hojaDeProductos->setTitle("Colaboradores");

# Encabezado de los productos
$encabezado = ["id", "Nombre", "Apellido", "Correo", "Cedula"];
# El último argumento es por defecto A1
$hojaDeProductos->fromArray($encabezado, null, 'A1');

$consulta = "select * from datospersonales";
$sentencia = $con->prepare($consulta, [
PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
]);
$sentencia->execute();
# Comenzamos en la fila 2
$numeroDeFila = 2;
while ($reg = $sentencia->fetchObject()) {
# Obtener registros de MySQL
$codigo = $reg->id;
$Nombre = $reg->Nombre;
$Apellido = $reg->Apellido;
$Email1 = $reg->Email1;
$Cedula = $reg->Cedula;
# Escribir registros en el documento
$hojaDeProductos->setCellValue('A'. $numeroDeFila, $codigo);;
$hojaDeProductos->setCellValue('B'. $numeroDeFila, $Nombre);
$hojaDeProductos->setCellValue('C'. $numeroDeFila, $Apellido);
$hojaDeProductos->setCellValue('D'. $numeroDeFila, $Email1);
$hojaDeProductos->setCellValue('E'. $numeroDeFila, $Cedula);
$numeroDeFila++;
}

# Ahora creamos la hoja "proveedores"
$hojaDeProveedores = $documento->createSheet();
$hojaDeProveedores->setTitle("Colaboradores");


# Crear un "escritor"
$writer = new Xlsx($documento);
# Le pasamos la ruta de guardado
$writer->save('./doc_exportados/Exportado_productos_proveedores.xlsx');
?>