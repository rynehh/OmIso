<?php
include("00ConexionDB.php");

// Capturar los parámetros de los filtros
$categoria = isset($_GET['categoria']) ? intval($_GET['categoria']) : null;
$instructor = isset($_GET['instructor']) ? intval($_GET['instructor']) : null;
$fechaInicio = isset($_GET['fechaInicio']) ? $_GET['fechaInicio'] : null;
$fechaFin = isset($_GET['fechaFin']) ? $_GET['fechaFin'] : null;

// Construir la consulta base
$query = "SELECT ID_CURSO, TITULO, DESCRIPCURSO, COSTO, IMAGEN FROM CURSO WHERE 1=1";

// Agregar condiciones según los filtros
if ($categoria) {
    $query .= " AND ID_CAT = $categoria";
}

if ($instructor) {
    $query .= " AND ID_INSTRUCTOR = $instructor";
}

if ($fechaInicio && $fechaFin) {
    $query .= " AND FECHA_CREACION BETWEEN '$fechaInicio' AND '$fechaFin'";
}

// Ejecutar la consulta
$result = $conex->query($query);

// Preparar la respuesta
$cursos = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cursos[] = $row;
    }
}

// Devolver los datos como JSON
header("Content-Type: application/json");
echo json_encode($cursos);
?>
