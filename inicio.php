<?php
include("00ConexionDB.php");
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Plataforma de Videojuegos</title>
    <link rel="stylesheet" href="inicio.css">
    <link rel="stylesheet" href="chat.css">
</head>

<body>
    <!-- Menú de navegación -->
    <header>
        <nav class="navbar">
            <div class="container">
                <a href="inicio.php" class="logo">OmIso</a>
                <ul class="nav-links">
                    <li><a href="inicio.php">Inicio</a></li>
                    <li><a href="cursos.php">Cursos</a></li>
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="#">Contacto</a></li>

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
                    <li><a href="00Cerrarsesion.php">Cerrar Sesion</a></li>
                    <?php endif; ?> 


                </ul>
            </div>
        </nav>
    </header>

    <!-- Contenido principal -->
    <main>
        <div class="container">
            <h1>Descubre Nuestros Cursos</h1>
            <p>Explora una variedad de cursos diseñados para mejorar tus habilidades</p>
            <div class="slide">
                <div class="slide-inner">
                    <input class="slide-open" type="radio" id="slide-1" name="slide" aria-hidden="true" hidden=""
                        checked="checked">
                    <div class="slide-item">
                        <img src="4.jpg">
                    </div>
                    <input class="slide-open" type="radio" id="slide-2" name="slide" aria-hidden="true" hidden="">
                    <div class="slide-item">
                        <img src="5.jpg">
                    </div>
                    <input class="slide-open" type="radio" id="slide-3" name="slide" aria-hidden="true" hidden="">
                    <div class="slide-item">
                        <img src="6.jpg">
                    </div>
                    <label for="slide-3" class="slide-control prev control-1">‹</label>
                    <label for="slide-2" class="slide-control next control-1">›</label>
                    <label for="slide-1" class="slide-control prev control-2">‹</label>
                    <label for="slide-3" class="slide-control next control-2">›</label>
                    <label for="slide-2" class="slide-control prev control-3">‹</label>
                    <label for="slide-1" class="slide-control next control-3">›</label>
                    <ol class="slide-indicador">
                        <li>
                            <label for="slide-1" class="slide-circulo">•</label>
                        </li>
                        <li>
                            <label for="slide-2" class="slide-circulo">•</label>
                        </li>
                        <li>
                            <label for="slide-3" class="slide-circulo">•</label>
                        </li>
                    </ol>
                </div>
            </div>


            <!-- Sección de cursos -->
            <div class="courses">
            <div class="courses">
<?php
// Consulta a la base de datos para obtener los cursos activos
$query = "SELECT ID_CURSO, TITULO, DESCRIPCURSO, COSTO, IMAGEN FROM CURSO WHERE BAJA = 0";
$result = $conex->query($query);

// Verifica si hay cursos disponibles
if ($result && $result->num_rows > 0) {
    while ($curso = $result->fetch_assoc()) {
        // Si el curso tiene una imagen guardada, la usa; si no, usa una imagen predeterminada
        $imagenSrc = !empty($curso["IMAGEN"]) ? 'uploads/' . htmlspecialchars($curso["IMAGEN"]) : 'path/to/default-image.jpg';

        echo '<div class="course-card">';
        echo '    <img src="' . $imagenSrc . '" alt="Curso ' . htmlspecialchars($curso["TITULO"]) . '">';
        echo '    <div class="course-info">';
        echo '        <h3>' . htmlspecialchars($curso["TITULO"]) . '</h3>';
        echo '        <p>' . htmlspecialchars($curso["DESCRIPCURSO"]) . '</p>';
        echo '        <span class="price">$' . htmlspecialchars($curso["COSTO"]) . '</span>';
        echo '        <a href="curso.php?id=' . htmlspecialchars($curso["ID_CURSO"]) . '" class="btn-comprar">Comprar ahora</a>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo '<p>No hay cursos disponibles en este momento.</p>';
}
?>
</div>



                <!-- Puedes agregar más cursos aquí -->
            </div>
        </div>
    </main>
    <div class="chat-window" id="chat-window">
        <div class="chat-body" id="chat-body">
            <div class="chat-header" id="chat-header">
                Chat con <span id="chat-username">Selecciona un usuario</span>
                <span id="chat-toggle">-</span>
            </div>
            <div class="messages" id="messages">
                <!-- Los mensajes aparecerán aquí -->
            </div>
            <form id="chat-form">
                <input type="text" id="chat-input" placeholder="Escribe tu mensaje..." autocomplete="off">
                <button type="submit">Enviar</button>
            </form>
        </div>

        <!-- Lista de usuarios a la derecha -->
        <div class="chat-users" id="chat-users">
            <div class="users-header" id="users-header">
                <h3>Usuarios</h3>
                <span id="users-toggle">-</span>
            </div>
            <ul id="user-list">
                <li><button class="user-btn" data-username="Juan">Juan</button></li>
                <li><button class="user-btn" data-username="María">María</button></li>
                <li><button class="user-btn" data-username="Carlos">Carlos</button></li>
                <li><button class="user-btn" data-username="Ana">Ana</button></li>
            </ul>
        </div>
    </div>

    <script src="chat.js"></script>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <p>&copy; 2024 OmIso. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="inicio.js"></script>
</body>

</html>