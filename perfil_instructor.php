<?php
include("00ConexionDB.php");
session_start();

// Verificar si el usuario es un instructor y tiene su sesión iniciada
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 3 && isset($_SESSION['idUsuario'])) {
    $idInstructor = $_SESSION['idUsuario'];

    // Consulta para obtener los datos del instructor
    $queryInstructor = "SELECT NOMBRE, EMAIL, FOTO FROM usuario WHERE ID_USUARIO = ?";
    $stmtInstructor = $conex->prepare($queryInstructor);
    $stmtInstructor->bind_param("i", $idInstructor);
    $stmtInstructor->execute();
    $resultInstructor = $stmtInstructor->get_result();

    if ($resultInstructor->num_rows > 0) {
        $instructor = $resultInstructor->fetch_assoc();
    } else {
        echo "No se encontraron datos del instructor.";
        exit;
    }
    $stmtInstructor->close();

    // Consulta para obtener los cursos del instructor
    $queryCursos = "SELECT ID_CURSO, TITULO FROM curso WHERE ID_INSTRUCTOR = ?";
    $stmtCursos = $conex->prepare($queryCursos);
    $stmtCursos->bind_param("i", $idInstructor);
    $stmtCursos->execute();
    $resultCursos = $stmtCursos->get_result();
    $stmtCursos->close();
} else {
    // Redirigir al login si no hay sesión o no es instructor
    header('Location: login.php');
    exit;
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
        <!-- Sidebar -->
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

        <!-- Contenido del perfil -->
        <div class="profile-content">
            <h1>Bienvenido, <?php echo htmlspecialchars($instructor['NOMBRE']); ?>.</h1>
            <p>Correo Electrónico: <?php echo htmlspecialchars($instructor['EMAIL']); ?></p>
            <?php if (!empty($instructor['FOTO'])): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($instructor['FOTO']); ?>" alt="Foto de perfil" style="width: 150px; height: 150px; border-radius: 50%;">
            <?php else: ?>
                <img src="default-profile.png" alt="Foto de perfil predeterminada" style="width: 150px; height: 150px; border-radius: 50%;">
            <?php endif; ?>
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
