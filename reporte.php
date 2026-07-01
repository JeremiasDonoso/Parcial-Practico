<?php

require_once "clases/myConexionPDO.php";

$sql = new mod_db();

$datos = $sql->obtenerReporte();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Reporte</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-4">

<h2>Reporte de Inscriptores</h2>

<a href="index.php" class="btn btn-primary mb-3">Nuevo</a>

<a href="exportarExcel.php" class="btn btn-success mb-3">Exportar Excel</a>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Documento</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Edad</th>
<th>Sexo</th>
<th>Residencia</th>
<th>Nacionalidad</th>
<th>Correo</th>
<th>Celular</th>
<th>Temas</th>
<th>Integridad</th>

</tr>

</thead>

<tbody>

<?php foreach($datos as $d){ ?>

<tr>

<td><?= $d["id"] ?></td>
<td><?= $d["documento"] ?></td>
<td><?= $d["nombre"] ?></td>
<td><?= $d["apellido"] ?></td>
<td><?= $d["edad"] ?></td>
<td><?= $d["sexo"] ?></td>
<td><?= $d["residencia"] ?></td>
<td><?= $d["nacionalidad"] ?></td>
<td><?= $d["correo"] ?></td>
<td><?= $d["celular"] ?></td>
<td><?= $d["temas"] ?></td>
<td>

<?php if($sql->verificarFirma($d)){ ?>

<span class="badge bg-success">✔ Íntegro</span>

<?php }else{ ?>

<span class="badge bg-danger">✘ Alterado</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</body>

</html>