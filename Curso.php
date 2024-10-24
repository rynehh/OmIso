<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso OmIso</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Curso.css">
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
                    <p class="lead">Descripción breve del curso donde se destaca el contenido y los objetivos.</p>
                </section>

                <section class="mb-4">
                    <h3>Contenido del curso</h3>

                    <div class="accordion" id="courseAccordion">
                        <!-- Nivel 1 -->
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="level1Heading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#level1Content" aria-expanded="false" aria-controls="level1Content">
                                    Nivel 1 - Introducción || XAMPP
                                </button>
                            </h4>
                            <div id="level1Content" class="accordion-collapse collapse" aria-labelledby="level1Heading" data-bs-parent="#courseAccordion">
                                <div class="accordion-body">
                                    <video controls src="BDM1.mp4" class="w-100 mb-3"></video>
                                    <p>Texto adicional del Nivel 1.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Nivel 2 -->
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="level2Heading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#level2Content" aria-expanded="false" aria-controls="level2Content">
                                    Nivel 2 - TABLAS
                                </button>
                            </h4>
                            <div id="level2Content" class="accordion-collapse collapse" aria-labelledby="level2Heading" data-bs-parent="#courseAccordion">
                                <div class="accordion-body">
                                    <video controls src="BDM2.mp4" class="w-100 mb-3"></video>
                                    <p>Texto adicional del Nivel 2.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Nivel 3 -->
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="level3Heading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#level3Content" aria-expanded="false" aria-controls="level3Content">
                                    Nivel 3 - DROP DATABASE
                                </button>
                            </h4>
                            <div id="level3Content" class="accordion-collapse collapse" aria-labelledby="level3Heading" data-bs-parent="#courseAccordion">
                                <div class="accordion-body">
                                    <video controls src="BDM3.mp4" class="w-100 mb-3"></video>
                                    <p>Texto adicional del Nivel 3.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                
                <section class="mb-4">
                    <h3>Comentarios/Reviews</h3>
                
                    <div class="comment d-flex justify-content-between align-items-center" id="comment1">
                        <p><strong>@Fulano69</strong> - Me gustó mucho <span class="rating">9/10</span></p>
                        <button class="btn btn-danger btn-sm ms-3" onclick="eliminarComentario('comment1')">
                            <i class="bi bi-trash"></i> <!-- Ícono de bote de basura -->
                        </button>
                    </div>
                    
                    <div class="comment d-flex justify-content-between align-items-center" id="comment2">
                        <p><strong>@Mengano27</strong> - Buen contenido, pero faltan ejemplos <span class="rating">8/10</span></p>
                        <button class="btn btn-danger btn-sm ms-3" onclick="eliminarComentario('comment2')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    
                    <div class="comment d-flex justify-content-between align-items-center" id="comment3">
                        <p><strong>@Sutano34</strong> - Excelente curso <span class="rating">10/10</span></p>
                        <button class="btn btn-danger btn-sm ms-3" onclick="eliminarComentario('comment3')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </section>
                
                
                
            </main>

            <!-- Barra lateral derecha -->
            <aside class="col-md-4">
                <section class="mb-4">
                    <video controls src="video-principal.mp4" class="w-100 mb-3"></video>
                </section>

                <section class="mb-4">
                    <h3>Precio: <span class="text-primary">$49.99</span></h3>
                    <button class="btn btn-primary btn-lg w-100" onclick="window.location.href='comprar.php';">
                    Comprar Curso</button>
                </section>

                <section>
                    <h3>Categorías</h3>
                    <ul class="list-group">
                        <li class="list-group-item">Estrategia</li>
                        <li class="list-group-item">Juegos</li>
                        <li class="list-group-item">Valorant</li>
                    </ul>
                </section>
            </aside>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 OmIso - Todos los derechos reservados</p>
    </footer>

    <script src="Curso.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
