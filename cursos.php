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
                    <li><a href="perfil.php">Perfil</a></li>
                    <li><a href="cursos.php">Cursos</a></li>
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="#">Contacto</a></li>
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
                    <button class="btn-etiqueta" onclick="filtrarPorEtiqueta('estrategia')">Estrategia</button>
                    <button class="btn-etiqueta" onclick="filtrarPorEtiqueta('accion')">Acción</button>
                    <button class="btn-etiqueta" onclick="filtrarPorEtiqueta('aventura')">Aventura</button>
                    <button class="btn-etiqueta" onclick="filtrarPorEtiqueta('rpg')">RPG</button>
                    <button class="btn-etiqueta" onclick="filtrarPorEtiqueta('deportes')">Deportes</button>
                </div>
            </div>

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
                    <select id="instructor" class="form-control">
                        <option value="" disabled selected>Selecciona un instructor</option>
                        <option value="John Doe">John Doe</option>
                        <option value="Jane Smith">Jane Smith</option>
                        <option value="Carlos Pérez">Carlos Pérez</option>
                        <option value="Juan García">Juan García</option>
                    </select>
                    <button class="btn-filtrar-instructor" onclick="filtrarPorInstructor()">Aplicar Filtro</button>
                </div>
            </div>
            

            <!-- Lista de cursos -->
            <div id="cursos-container">
                <!-- Los cursos aparecerán aquí -->
            </div>
        </div>
    </main>

    <script src="cursos.js"></script>
</body>
</html>
