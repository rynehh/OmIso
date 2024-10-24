<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso Comprado - OmIso</title>
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
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href="perfil.php">Perfil</a></li>
                    <li><a href="login.php">Iniciar sesión</a></li>
                    <li><a href="registro.php">Registrarse</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <div class="row">
            <!-- Columna principal izquierda -->
            <main class="col-md-8">
                <section class="mb-4">
                    <h2>Nombre del Curso</h2>
                </section>

                <section class="mb-4">
                    <h3>Contenido del curso</h3>

                    <div class="accordion" id="courseAccordion">
                        <!-- Nivel 1 -->
                        <div class="accordion-item" id="level1Heading">
                            <h4 class="accordion-header" id="level1Heading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#level1Content" aria-expanded="false" aria-controls="level1Content">
                                Nivel 1 - Introducción
                            </button>
                        </h4>
                        <div id="level1Content" class="accordion-collapse collapse" aria-labelledby="level1Heading" data-bs-parent="#courseAccordion">
                            <div class="accordion-body">
                            <video controls src="nivel1.mp4" class="w-100 mb-3"></video>
                            <p>Este nivel cubre los conceptos básicos.</p>
                            </div>
                        </div>

                        <!-- Nivel 2 -->
                        <div class="accordion-item" id="level2Heading">
                            <h4 class="accordion-header" id="level2Heading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#level2Content" aria-expanded="false" aria-controls="level2Content">
                                Nivel 2 - Estrategias Avanzadas
                            </button>
                        </h4>
                        <div id="level2Content" class="accordion-collapse collapse" aria-labelledby="level2Heading" data-bs-parent="#courseAccordion">
                            <div class="accordion-body">
                            <video controls src="nivel2.mp4" class="w-100 mb-3"></video>
                            <p>Este nivel cubre estrategias más avanzadas.</p>
                            </div>
                        </div>
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
