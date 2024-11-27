<?php
include("00ConexionDB.php");
session_start();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['idUsuario'])) {
    die("Error: Usuario no autenticado.");
}

// Validar que se pase el parámetro ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: ID del curso no válido.");
}

$idCurso = intval($_GET['id']);

// Consulta para obtener la información del certificado desde la tabla `kardex`
$queryCertificado = "
    SELECT 
        u_alumno.NOMBRE AS nombre_alumno,
        u_instructor.NOMBRE AS nombre_instructor,
        c.TITULO AS nombre_curso,
        k.FEUTERM AS fecha_termino
    FROM kardex k
    INNER JOIN usuario u_alumno ON k.ID_USUARIO = u_alumno.ID_USUARIO
    INNER JOIN curso c ON k.ID_CURSO = c.ID_CURSO
    INNER JOIN usuario u_instructor ON c.ID_INSTRUCTOR = u_instructor.ID_USUARIO
    WHERE k.ID_CURSO = ? AND k.ID_USUARIO = ? AND k.ESTATUS = 'completado'
";

$stmtCertificado = $conex->prepare($queryCertificado);
$stmtCertificado->bind_param("ii", $idCurso, $_SESSION['idUsuario']);
$stmtCertificado->execute();
$resultCertificado = $stmtCertificado->get_result();

if ($resultCertificado->num_rows === 0) {
    die("Error: No tienes el curso completado o no existe el curso.");
}

$row = $resultCertificado->fetch_assoc();

// Datos para el certificado
$nombreAlumno = htmlspecialchars($row['nombre_alumno']);
$nombreInstructor = htmlspecialchars($row['nombre_instructor']);
$nombreCurso = htmlspecialchars($row['nombre_curso']);
$fechaFinalizacion = htmlspecialchars($row['fecha_termino']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de Finalización</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="certificado.css">
</head>
<body>
    <div class="certificate">
        <div class="header">
            <img src="logo.png" alt="Logo" class="logo">
            <h1>Certificado de Finalización</h1>
        </div>

        <div class="content">
            <h2><?= $nombreCurso ?></h2>
            <p>Instructor: <strong><?= $nombreInstructor ?></strong></p>
        </div>

        <div class="footer">
            <p><strong><?= $nombreAlumno ?></strong></p>
            <p>Fecha de Finalización: <strong><?= $fechaFinalizacion ?></strong></p>
        </div>
    </div>
</body>
</html>
