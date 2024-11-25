<?php
include("00ConexionDB.php");
session_start();

// Verificar si el parámetro id está presente en la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $curso_id = $_GET['id'];

    // Consulta para obtener los detalles del curso
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

    // Consulta para obtener los niveles del curso
    $sqlNiveles = $conex->prepare("SELECT TITULO, TEXTO, VIDEO FROM NIVEL WHERE ID_CURSO = ?");
    $sqlNiveles->bind_param("i", $curso_id);
    $sqlNiveles->execute();
    $resultNiveles = $sqlNiveles->get_result();

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
    <title><?php echo htmlspecialchars($curso['TITULO']); ?> - OmIso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CursoCom.css">
</head>
<body>

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
                        <li><a href="00Cerrarsesion.php">Cerrar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </ul>
        </div>
    </nav>
</header>

<div class="container mt-4">
    <div class="row">
        <!-- Columna principal izquierda -->
        <main class="col-md-8">
            <section class="mb-4">
                <h2><?php echo htmlspecialchars($curso['TITULO']); ?></h2>
                <p><?php echo htmlspecialchars($curso['DESCRIPCURSO']); ?></p>
                <img src="<?php echo htmlspecialchars($curso['IMAGEN'] ?: 'ruta_de_imagen_default.jpg'); ?>" alt="Imagen del Curso" class="img-fluid">
            </section>

            <section class="mb-4">
                <h3>Contenido del curso</h3>

                <div class="accordion" id="courseAccordion">
                    <?php
                    $nivelIndex = 1;
                    while ($nivel = $resultNiveles->fetch_assoc()) {
                        echo '<div class="accordion-item">';
                        echo '    <h4 class="accordion-header" id="level' . $nivelIndex . 'Heading">';
                        echo '        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#level' . $nivelIndex . 'Content" aria-expanded="false" aria-controls="level' . $nivelIndex . 'Content">';
                        echo '            Nivel ' . $nivelIndex . ' - ' . htmlspecialchars($nivel['TITULO']);
                        echo '        </button>';
                        echo '    </h4>';
                        echo '    <div id="level' . $nivelIndex . 'Content" class="accordion-collapse collapse" aria-labelledby="level' . $nivelIndex . 'Heading" data-bs-parent="#courseAccordion">';
                        echo '        <div class="accordion-body">';
                        echo '            <video controls src="' . htmlspecialchars($nivel['VIDEO']) . '" class="w-100 mb-3"></video>';
                        echo '            <p>' . htmlspecialchars($nivel['TEXTO']) . '</p>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                        $nivelIndex++;
                    }
                    ?>
                </div>
            </section>
        </main>

        <!-- Barra lateral derecha -->
        <aside class="col-md-4">
            <section class="mb-4">
                <h3>Progreso del curso</h3>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                </div>
            </section>

            <section class="mb-4">
                <h3>Recursos adicionales</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="extra-video1.mp4">Video Extra 1</a></li>
                    <li class="list-group-item"><a href="extra-pdf.pdf">Guía en PDF</a></li>
                </ul>
            </section>
        </aside>
    </div>
</div>

<footer>
    <p>&copy; 2024 OmIso - Todos los derechos reservados</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$sqlNiveles->close();
?>
