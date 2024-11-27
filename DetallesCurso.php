<?php
include("00ConexionDB.php");
session_start();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

// Obtener el ID del curso desde la URL
$idCurso = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar que el ID del curso sea válido
if ($idCurso <= 0) {
    die("Curso no válido.");
}

// Inicializar variables
$tituloCurso = "";
$descripcionCurso = "";
$mensajeComentario = "";
$mensajeCalificacion = "";

// Consultar los detalles del curso
$queryCurso = "SELECT TITULO, DESCRIPCURSO FROM curso WHERE ID_CURSO = ?";
$stmtCurso = $conex->prepare($queryCurso);
$stmtCurso->bind_param("i", $idCurso);
$stmtCurso->execute();
$resultCurso = $stmtCurso->get_result();

if ($resultCurso->num_rows > 0) {
    $row = $resultCurso->fetch_assoc();
    $tituloCurso = $row['TITULO'];
    $descripcionCurso = $row['DESCRIPCURSO'];
} else {
    die("No se encontraron detalles para este curso.");
}

$stmtCurso->close();

// Procesar comentarios
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comentario'])) {
    $comentario = trim($_POST['comentario']);
    $idUsuario = intval($_SESSION['idUsuario']);

    if (!empty($comentario)) {
        $queryComentario = "INSERT INTO comentario (ID_CURSO, ID_USUARIO, COMEN, FECHCRE) VALUES (?, ?, ?, NOW())";
        $stmtComentario = $conex->prepare($queryComentario);
        $stmtComentario->bind_param("iis", $idCurso, $idUsuario, $comentario);

        if ($stmtComentario->execute()) {
            $mensajeComentario = "Comentario enviado correctamente.";
        } else {
            $mensajeComentario = "Error al enviar el comentario.";
        }

        $stmtComentario->close();
    } else {
        $mensajeComentario = "El comentario no puede estar vacío.";
    }
}

// Procesar calificación
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calificacion'])) {
    $calificacion = intval($_POST['calificacion']);
    $idUsuario = intval($_SESSION['idUsuario']); // ID del usuario de la sesión

    // Validar la calificación
    if ($calificacion >= 1 && $calificacion <= 5) {
        // Verificar si existe un registro para este usuario y curso
        $querySelect = "SELECT ID_USUC FROM usuario_curso WHERE ID_USUARIO = ? AND ID_CURSO = ?";
        $stmtSelect = $conex->prepare($querySelect);
        $stmtSelect->bind_param("ii", $idUsuario, $idCurso);
        $stmtSelect->execute();
        $resultSelect = $stmtSelect->get_result();

        if ($resultSelect->num_rows > 0) {
            // Si existe, obtener el ID_USUC y realizar el UPDATE
            $row = $resultSelect->fetch_assoc();
            $idUsuc = $row['ID_USUC'];

            $queryUpdate = "UPDATE usuario_curso SET CALIFICACION = ? WHERE ID_USUC = ?";
            $stmtUpdate = $conex->prepare($queryUpdate);
            $stmtUpdate->bind_param("ii", $calificacion, $idUsuc);

            if ($stmtUpdate->execute()) {
                
                    $mensajeCalificacion = "Calificación actualizada correctamente y promedio recalculado.";
               
            } else {
                $mensajeCalificacion = "Error al actualizar la calificación.";
            }

            $stmtUpdate->close();
        } else {
            // Si no existe, mostrar un error
            $mensajeCalificacion = "No se encontró un registro para actualizar.";
        }

        $stmtSelect->close();
    } else {
        $mensajeCalificacion = "Por favor, selecciona una calificación válida.";
    }
}

$conex->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Curso</title>
    <link rel="stylesheet" href="DetallesCurso.css">
</head>
<body>
    <header>
        <div class="navbar">
            <a href="inicio.php" class="logo">OmIso</a>
            <nav>
                <a href="inicio.php">Inicio</a>
                <a href="cursos.php">Cursos</a>
                <a href="perfil.php">Perfil</a>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <h1 class="course-title"><?= htmlspecialchars($tituloCurso) ?></h1>
        <p class="course-description"><?= htmlspecialchars($descripcionCurso) ?></p>

        <!-- Mostrar mensajes -->
        <?php if (!empty($mensajeComentario)): ?>
            <div class="message">
                <p><?= htmlspecialchars($mensajeComentario) ?></p>
            </div>
        <?php endif; ?>
        <?php if (!empty($mensajeCalificacion)): ?>
            <div class="message">
                <p><?= htmlspecialchars($mensajeCalificacion) ?></p>
            </div>
        <?php endif; ?>

        <!-- Formulario de comentarios -->
        <div class="comments-section">
            <h2>Deja tu comentario</h2>
            <form method="POST" action="DetallesCurso.php?id=<?= htmlspecialchars($idCurso) ?>">
                <textarea name="comentario" placeholder="Escribe tu comentario aquí..." required></textarea>
                <button type="submit">Enviar Comentario</button>
            </form>
        </div>

        <!-- Formulario de calificación -->
        <div class="ratings-section">
            <h2>Califica este curso</h2>
            <form method="POST" action="DetallesCurso.php?id=<?= htmlspecialchars($idCurso) ?>">
                <select name="calificacion" required>
                    <option value="1">1 - Muy malo</option>
                    <option value="2">2 - Malo</option>
                    <option value="3">3 - Regular</option>
                    <option value="4">4 - Bueno</option>
                    <option value="5">5 - Excelente</option>
                </select>
                <button type="submit">Actualizar Calificación</button>
            </form>
        </div>
    </main>
</body>
</html>
