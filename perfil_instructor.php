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
                    <li><a href="perfil.php">Perfil</a></li>
                    <li><a href="cursos.php">Cursos</a></li>
                    <li><a href="#">Ofertas</a></li>
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
                <li><button class="btn-curso" onclick="mostrarDetallesCurso('lol')">Curso de League of Legends</button></li>
                <li><button class="btn-curso" onclick="mostrarDetallesCurso('valorant')">Curso de Valorant</button></li>
                <li><button class="btn-curso" onclick="mostrarDetallesCurso('fortnite')">Curso de Fortnite</button></li>
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
