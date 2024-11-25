<?php
include("00ConexionDB.php");
session_start();

// Verificar si el usuario es un instructor y tiene su sesión iniciada
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 3 && isset($_SESSION['idUsuario'])) {
    $idInstructor = $_SESSION['idUsuario'];

    // Consulta para obtener los cursos del instructor
    $queryCursos = "SELECT ID_CURSO, TITULO FROM CURSO WHERE ID_INSTRUCTOR = ?";
    $stmt = $conex->prepare($queryCursos);
    $stmt->bind_param("i", $idInstructor);
    $stmt->execute();
    $resultCursos = $stmt->get_result();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Instructor</title>
    <link rel="stylesheet" href="perfil_instructor.css">
</head>
<body>
    <!-- Menú de navegación -->
    <header>
        <nav class="navbar">
            <div class="container">
                <a href="inicio.php" class="logo">OmIso</a>
                <ul class="nav-links">
                    <li><a href="inicio.php">Inicio</a></li>
                    <li><a href="perfil_instructor.php">Perfil</a></li>
                    <li><a href="cursos.php">Cursos</a></li>
                    <li><a href="modificar.php">Editar Perfil</a></li>
                    <?php if (isset($_SESSION['rol'])): ?>
                        <?php if ($_SESSION['rol'] == 2): ?>
                            <li><a href="chat_alumno.php">Chat</a></li>
                        <?php elseif ($_SESSION['rol'] == 3): ?>
                            <li><a href="chat_instructor.php">Chat</a></li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <li><a href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Contenedor principal -->
    <main class="profile-container">
        <div class="sidebar">
            <h3>Tus Cursos</h3>
            <ul>
                <?php
                if ($resultCursos && $resultCursos->num_rows > 0) {
                    // Mostrar los cursos obtenidos de la base de datos
                    while ($curso = $resultCursos->fetch_assoc()) {
                        echo '<li><button class="btn-curso" onclick="mostrarDetallesCurso(' . htmlspecialchars($curso['ID_CURSO']) . ')">' . htmlspecialchars($curso['TITULO']) . '</button></li>';
                    }
                } else {
                    echo '<li>No tienes cursos registrados.</li>';
                }
                ?>
            </ul>
            <button class="btn-alta-curso" onclick="window.location.href='AltaCurso.php'">Dar de Alta un Curso Nuevo</button>
        </div>

        <div class="profile-content">
            <h1>Bienvenido, Instructor</h1>
            <p>Aquí puedes gestionar los cursos que estás impartiendo.</p>
            <div id="detalles-curso" class="detalles-curso">
                <!-- Aquí se mostrarán los detalles de los cursos -->
                <p>Haz clic en un curso para ver los alumnos inscritos, el pago y las actividades.</p>
            </div>
            <div id="detalles-alumno" class="detalles-alumno">
                <!-- Aquí se mostrarán los detalles del alumno seleccionado -->
            </div>
        </div>
    </main>

    <script src="perfil_instructor.js"></script>
</body>
</html>
