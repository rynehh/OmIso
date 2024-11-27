<?php
include("00ConexionDB.php");
session_start();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $curso_id = intval($_GET['id']); // Convertir a entero para mayor seguridad

    // Obtener detalles del curso
    $sqlCurso = $conex->prepare("SELECT TITULO, DESCRIPCURSO, IMAGEN FROM CURSO WHERE ID_CURSO = ?");
    $sqlCurso->bind_param("i", $curso_id);
    $sqlCurso->execute();
    $resultCurso = $sqlCurso->get_result();

    if ($resultCurso->num_rows > 0) {
        $curso = $resultCurso->fetch_assoc();
    } else {
        echo "No se encontraron detalles para este curso.";
        exit;
    }
    $sqlCurso->close();

    // Obtener niveles del curso
    $sqlNiveles = $conex->prepare("SELECT ID_NIV, TITULO, CONTENIDO, VIDEO FROM NIVEL WHERE ID_CURSO = ? ORDER BY ID_NIV ASC");
    $sqlNiveles->bind_param("i", $curso_id);
    $sqlNiveles->execute();
    $resultNiveles = $sqlNiveles->get_result();

    // Obtener niveles completados del usuario
    $nivelesCompletados = [];
    $sqlCompletados = $conex->prepare("SELECT ID_NIV FROM niveles_completados WHERE ID_CURSO = ? AND ID_USUARIO = ?");
    $sqlCompletados->bind_param("ii", $curso_id, $_SESSION['idUsuario']);
    $sqlCompletados->execute();
    $resultCompletados = $sqlCompletados->get_result();

    while ($fila = $resultCompletados->fetch_assoc()) {
        $nivelesCompletados[] = $fila['ID_NIV'];
    }
    $sqlCompletados->close();

    // Determinar el último nivel completado
    $ultimoCompletado = !empty($nivelesCompletados) ? max($nivelesCompletados) : 0;

    // Calcular progreso inicial
    $totalNiveles = $resultNiveles->num_rows;
    $nivelesCompletadosCount = count($nivelesCompletados);
    $progreso = ($nivelesCompletadosCount / $totalNiveles) * 100;
} else {
    echo "ID de curso no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($curso['TITULO']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="CursoCom.css">
</head>
<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar">
            <div class="container-header">
                <a href="inicio.php" class="logo">OmIso</a>
                <ul class="nav-links">
                    <li><a href="inicio.php">Inicio</a></li>
                    <li><a href="cursos.php">Cursos</a></li>
                    <?php if (isset($_SESSION['rol'])): ?>
                        <?php if ($_SESSION['rol'] == 1): ?>
                            <li><a href="Admin.php">Perfil</a></li>
                        <?php elseif ($_SESSION['rol'] == 2): ?>
                            <li><a href="perfil.php">Perfil</a></li>
                        <?php elseif ($_SESSION['rol'] == 3): ?>
                            <li><a href="perfil_instructor.php">Perfil</a></li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!isset($_SESSION['rol'])): ?>
                        <li><a href="login.php">Iniciar sesión</a></li>
                        <li><a href="registro.php">Registrarse</a></li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['rol'])): ?>
                        <li><a href="00CerrarSesion.php">Cerrar sesión</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Contenido principal con columnas -->
    <div class="container mt-4">
        <div class="row">
            <!-- Columna principal izquierda -->
            <main class="col-md-8">
                <section class="mb-4">
                    <h1><?php echo htmlspecialchars($curso['TITULO']); ?></h1>
                    <p><?php echo htmlspecialchars($curso['DESCRIPCURSO']); ?></p>
                    <?php if (!empty($curso['IMAGEN'])): ?>
        <img src="data:image/jpeg;base64,<?php echo $curso['IMAGEN']; ?>" alt="Imagen del Curso" class="img-fluid">
    <?php else: ?>
        <img src="ruta_de_imagen_default.jpg" alt="Imagen Predeterminada" class="img-fluid">
    <?php endif; ?>

    <section class="mb-4">
    <h2>Contenido del curso</h2>
    <div class="niveles-container">
        <?php
        $nivelIndex = 1;
        if ($resultNiveles->num_rows > 0): 
            while ($nivel = $resultNiveles->fetch_assoc()) {
                $completado = in_array($nivel['ID_NIV'], $nivelesCompletados); // Verificar si el nivel está completado
                $deshabilitado = $completado ? "disabled" : ""; // Deshabilitar botón si ya está completado
                $visible = ($nivelIndex == 1 || $completado || $nivel['ID_NIV'] == $ultimoCompletado + 1) ? "" : "style='display: none;'";
        ?>
                <div class="level" data-nivel="<?php echo $nivel['ID_NIV']; ?>" <?php echo $visible; ?>>
                    <h4>Nivel <?php echo $nivelIndex; ?> - <?php echo htmlspecialchars($nivel['TITULO']); ?></h4>
                    <video controls>
                        <source src="<?php echo htmlspecialchars($nivel['VIDEO']); ?>" type="video/mp4">
                        Tu navegador no soporta este video.
                    </video>
                    <button class="btn-completar" <?php echo $deshabilitado; ?> data-nivel="<?php echo $nivel['ID_NIV']; ?>" data-curso="<?php echo $curso_id; ?>">
                        <?php echo $completado ? "Completado" : "Validar Nivel"; ?>
                    </button>
                </div>
        <?php
                $nivelIndex++;
            }
        else:
        ?>
            <p>No hay niveles disponibles para este curso.</p>
        <?php endif; ?>
    </div>
</section>





            </main>

            <!-- Barra lateral derecha -->
            <aside class="col-md-4">
                <section class="mb-4">
                    <h2>Progreso del curso</h2>
                    <div class="progress">
   <div class="progress">
    <div id="progress-bar" class="progress-bar" style="width: <?php echo round($progreso); ?>%;">
        <?php echo round($progreso); ?>%
    </div>
</div>
</div>

                </section>

                <section class="mb-4">
                    <h3>Recursos adicionales</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="extra-video01.mp4">Video Extra 1</a></li>
                        <li class="list-group-item"><a href="extra-pdf.pdf">Guía en PDF</a></li>
                    </ul>
                </section>
            </aside>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="CursoCom.js"></script>
</body>
</html>
