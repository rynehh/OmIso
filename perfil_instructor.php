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
    $queryCursos = "SELECT ID_CURSO, TITULO FROM curso WHERE ID_INSTRUCTOR = ? AND BAJA = 0";
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

<?php
include("00ConexionDB.php");
session_start();

// Verificar si el usuario es un instructor y tiene su sesión iniciada
if (!isset($_SESSION['idUsuario']) || $_SESSION['rol'] != 3) {
    die("Error: Usuario no autenticado o no es un instructor.");
}

$idInstructor = $_SESSION['idUsuario'];

// Obtener los cursos, alumnos inscritos y total de ingresos (solo cursos propios del instructor)
$queryGeneral = "
    SELECT 
        c.TITULO AS nombre_curso,
        COUNT(uc.ID_USUARIO) AS alumnos_inscritos,
        COALESCE(SUM((SELECT COSTO FROM curso WHERE ID_CURSO = uc.ID_CURSO)), 0) AS ingresos_totales
    FROM curso c
    LEFT JOIN usuario_curso uc ON c.ID_CURSO = uc.ID_CURSO
    WHERE c.BAJA = 0 AND c.ID_INSTRUCTOR = ? -- Solo cursos activos del instructor autenticado
    GROUP BY c.TITULO;
";
$stmtGeneral = $conex->prepare($queryGeneral);
$stmtGeneral->bind_param("i", $idInstructor);
$stmtGeneral->execute();
$resultGeneral = $stmtGeneral->get_result();

// Obtener ingresos desglosados (solo cursos propios del instructor)
$queryDetalle = "
    SELECT 
        c.TITULO AS nombre_curso,
        uc.FECHA_INSCRIPCION,
        uc.FROMAPAGO AS forma_pago,
        (SELECT COSTO FROM curso WHERE ID_CURSO = uc.ID_CURSO) AS ingreso
    FROM usuario_curso uc
    INNER JOIN curso c ON uc.ID_CURSO = c.ID_CURSO
    WHERE c.ID_INSTRUCTOR = ? -- Solo cursos del instructor autenticado
";
$stmtDetalle = $conex->prepare($queryDetalle);
$stmtDetalle->bind_param("i", $idInstructor);
$stmtDetalle->execute();
$resultDetalle = $stmtDetalle->get_result();

// Calcular el total de ingresos (solo cursos propios del instructor)
$queryTotalIngresos = "
    SELECT SUM((SELECT COSTO FROM curso WHERE ID_CURSO = uc.ID_CURSO)) AS total_ingresos
    FROM usuario_curso uc
    INNER JOIN curso c ON uc.ID_CURSO = c.ID_CURSO
    WHERE c.ID_INSTRUCTOR = ? -- Solo cursos del instructor autenticado
";
$stmtTotal = $conex->prepare($queryTotalIngresos);
$stmtTotal->bind_param("i", $idInstructor);
$stmtTotal->execute();
$resultTotal = $stmtTotal->get_result();
$totalIngresos = $resultTotal->fetch_assoc()['total_ingresos'] ?? 0;

// Cerrar los statements
$stmtGeneral->close();
$stmtDetalle->close();
$stmtTotal->close();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Instructor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
                    <li><a href="00CerrarSesion.php">Cerrar sesión</a></li>
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
            <!-- Mostrar la imagen de perfil en caso de que exista -->
            <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($instructor['FOTO']); ?>" 
                alt="Foto de perfil" 
                style="width: 150px; height: 150px; border-radius: 50%;">
        <?php else: ?>
            <!-- Mostrar una imagen predeterminada si no hay foto cargada -->
            <img src="default-profile.png" 
                alt="Foto predeterminada" 
                style="width: 150px; height: 150px; border-radius: 50%;">
        <?php endif; ?>
            <p>Aquí puedes gestionar los cursos que estás impartiendo.</p>

            <!-- Botón para abrir el modal -->
            <button id="btnReportes" class="btn btn-primary">Ver Reporte General</button>

            <!-- Modal -->
            <div id="modalReportes" class="modal fade" tabindex="-1" aria-labelledby="modalReportesLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalReportesLabel">Reporte General de Cursos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Tabla general -->
                            <h6>Cursos Ofrecidos</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Alumnos Inscritos</th>
                                        <th>Ingresos Totales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($resultGeneral)): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['nombre_curso']) ?></td>
                                            <td><?= $row['alumnos_inscritos'] ?></td>
                                            <td>$<?= number_format($row['ingresos_totales'], 2) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                            <!-- Tabla desglosada -->
                            <h6>Ingresos Desglosados</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Fecha Inscripción</th>
                                        <th>Forma de Pago</th>
                                        <th>Ingreso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($resultDetalle)): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['nombre_curso']) ?></td>
                                            <td><?= $row['FECHA_INSCRIPCION'] ?></td>
                                            <td><?= $row['forma_pago'] ?></td>
                                            <td>$<?= number_format($row['ingreso'], 2) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                            <!-- Total de ingresos -->
                            <h6 class="mt-4">Total de Ingresos: <strong>$<?= number_format($totalIngresos, 2) ?></strong></h6>
                        </div>
                    </div>
                </div>
            </div>


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
