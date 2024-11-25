<?php
include("00ConexionDB.php");
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Cursos</title>
    <link rel="stylesheet" href="cursos.css">
</head>
<body>
    <!-- Header con navegación -->
    <header>
        <nav class="navbar">
            <div class="container">
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

                    <?php if (isset($_SESSION['rol'])): ?>
                        <?php if ($_SESSION['rol'] == 2): ?>
                            <li><a href="chat_alumno.php">Chat</a></li>
                        <?php elseif ($_SESSION['rol'] == 3): ?>
                            <li><a href="chat_instructor.php">Chat</a></li>
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
            </div>
        </nav>
    </header>

    <!-- Contenedor principal de búsqueda y resultados -->
    <main>
        <div class="container">
            <h1>Buscar Cursos</h1>
            
            <!-- Barra de búsqueda -->
            <div class="busqueda">
                <input type="text" id="buscar" placeholder="Buscar curso..." onkeyup="buscarCurso()">
            </div>

            <!-- Categoría (desplegable) -->
            <div class="categoria">
                <button class="categoria-btn">Categoría</button>
                <div class="dropdown-content">
                    <?php
                    include("00ConexionDB.php");

                    // Consulta para obtener las categorías
                    $queryCategorias = "SELECT NOMCAT FROM CATEGORIA";
                    $resultCategorias = $conex->query($queryCategorias);

                    if ($resultCategorias && $resultCategorias->num_rows > 0) {
                        while ($categoria = $resultCategorias->fetch_assoc()) {
                            echo '<button class="btn-etiqueta" onclick="filtrarPorEtiqueta(\'' . htmlspecialchars($categoria['NOMCAT']) . '\')">' . htmlspecialchars($categoria['NOMCAT']) . '</button>';
                        }
                    } else {
                        echo '<p>No hay categorías disponibles</p>';
                    }
                    ?>
                </div>
            </div>

            <!-- Filtro por fecha -->
            <div class="filtro-fechas">
                <button class="fecha-btn">Filtrar por fecha</button>
                <div class="dropdown-content-fecha">
                    <label for="fechaInicio">Desde:</label>
                    <input type="date" id="fechaInicio">
                    
                    <label for="fechaFin">Hasta:</label>
                    <input type="date" id="fechaFin">
                    
                    <button class="btn-filtrar-fecha" onclick="filtrarPorFecha()">Aplicar Filtro</button>
                </div>
            </div>

            <!-- Filtro por instructor -->
            <div class="filtro-instructor">
                <button class="instructor-btn">Filtrar por instructor</button>
                <div class="dropdown-content-instructor">
                    <label for="instructor">Seleccionar instructor:</label>
                    <select id="instructor" class="form-control" onchange="filtrarPorInstructor()">
                        <option value="" disabled selected>Selecciona un instructor</option>
                        <?php
                        // Consulta para obtener los nombres de los instructores
                        $queryInstructores = "SELECT DISTINCT NOMBRE FROM USUARIO WHERE ROL = 3";
                        $resultInstructores = $conex->query($queryInstructores);

                        if ($resultInstructores && $resultInstructores->num_rows > 0) {
                            while ($instructor = $resultInstructores->fetch_assoc()) {
                                echo '<option value="' . htmlspecialchars($instructor['NOMBRE']) . '">' . htmlspecialchars($instructor['NOMBRE']) . '</option>';
                            }
                        } else {
                            echo '<option disabled>No hay instructores disponibles</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <!-- Lista de cursos -->
            <div id="cursos-container">
    <?php
    // Consulta para obtener los cursos
    $queryCursos = "SELECT CURSO.ID_CURSO, CURSO.TITULO, CURSO.DESCRIPCURSO, CURSO.COSTO, CURSO.FECHA_CREACION, CURSO.IMAGEN, USUARIO.NOMBRE AS INSTRUCTOR, CATEGORIA.NOMCAT AS CATEGORIA 
    FROM CURSO
    INNER JOIN USUARIO ON CURSO.ID_INSTRUCTOR = USUARIO.ID_USUARIO
    INNER JOIN CATEGORIA ON CURSO.ID_CAT = CATEGORIA.ID_CAT";
$resultCursos = $conex->query($queryCursos);

if ($resultCursos && $resultCursos->num_rows > 0) {
while ($curso = $resultCursos->fetch_assoc()) {
echo '<div class="course-card" data-categoria="' . htmlspecialchars($curso['CATEGORIA']) . '" data-instructor="' . htmlspecialchars($curso['INSTRUCTOR']) . '" data-fecha="' . htmlspecialchars($curso['FECHA_CREACION']) . '">';

// Mostrar la imagen del curso desde la base de datos o una predeterminada si está vacía
$imagen = !empty($curso["IMAGEN"]) ? 'ruta/a/imagenes/' . htmlspecialchars($curso["IMAGEN"]) : 'ruta_de_imagen_default.jpg';
echo '    <img src="' . $imagen . '" alt="' . htmlspecialchars($curso["TITULO"]) . '">';

echo '    <div class="course-content">';
echo '        <h3>' . htmlspecialchars($curso["TITULO"]) . '</h3>';
echo '        <p>' . htmlspecialchars($curso["DESCRIPCURSO"]) . '</p>';
echo '        <span class="price">$' . htmlspecialchars($curso["COSTO"]) . '</span>';
echo '        <a href="curso.php?id=' . htmlspecialchars($curso["ID_CURSO"]) . '" class="btn-buy">Comprar ahora</a>';
echo '    </div>';
echo '</div>';
}
} else {
echo '<p>No hay cursos disponibles en este momento.</p>';
}
?>


</div>

        </div>
    </main>

    <script src="cursos.js"></script>
</body>
</html>
