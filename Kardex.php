<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kardex - Plataforma de Videojuegos</title>
    <link rel="stylesheet" href="Kardex.css">
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
                    <li><a href="courses.php">Cursos</a></li>
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="perfil.php">Perfil</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Contenedor principal -->

      

    <main class="profile-container">


        <div class="sidebar">
            <ul>
                <li><a href="Kardex.php">Kardex</a></li>
                <li><a href="Compras.php">Cursos Comprados</a></li>
            </ul>
        </div>
    

        <div class="Kardex-content">
            <h1>Kardex</h1>
            <table id="kardex-table">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Nivel</th>
                        <th>Última Conexión</th>
                        <th>Estado</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Término</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>LOL</td>
                        <td>3</td>
                        <td>2024-09-15</td>
                        <td>En Curso</td>
                        <td>2024-08-01</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>VALORANT</td>
                        <td>5</td>
                        <td>2024-09-12</td>
                        <td>Completado</td>
                        <td>2024-03-15</td>
                        <td>2024-08-30</td>
                        <td><a href="#" class="btn-certificado" onclick="abrirCertificado()">Ver Certificado</a></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </main>

      <!-- Filtros para el Kardex -->
      <div class="filtros-kardex">
        <!-- Filtro por rango de fechas -->
        <div class="filtro-fechas">
            <label for="fechaInicio">Desde:</label>
            <input type="date" id="fechaInicio" class="form-control">
        
            <label for="fechaFin">Hasta:</label>
            <input type="date" id="fechaFin" class="form-control">
        
            <button class="btn-filtrar" onclick="filtrarPorFecha()">Filtrar por Fecha</button>
        </div>
    
        <!-- Filtro por categoría -->
        <div class="filtro-categoria">
            <label for="categoria">Categoría:</label>
            <select id="categoria" class="form-control">
                <option value="todos">Todas las Categorías</option>
                <option value="estrategia">Estrategia</option>
                <option value="accion">Acción</option>
                <option value="aventura">Aventura</option>
            </select>
            <button class="btn-filtrar" onclick="filtrarPorCategoria()">Filtrar por Categoría</button>
        </div>
    
        <!-- Filtro por estado (completado o en curso) -->
        <div class="filtro-estado">
            <label for="estadoCurso">Estado del Curso:</label>
            <select id="estadoCurso" class="form-control">
                <option value="todos">Todos los Cursos</option>
                <option value="completado">Completado</option>
                <option value="en curso">En Curso</option>
            </select>
            <button class="btn-filtrar" onclick="filtrarPorEstado()">Filtrar por Estado</button>
        </div>
    </div>

    <!-- Sección del chat -->
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

        <!-- Lista de usuarios en el chat -->
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

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <p>&copy; 2024 OmIso. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="chat.js"></script>
    <script src="Kardex.js"></script>
</body>
</html>
