<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras - Plataforma de Videojuegos</title>
    <link rel="stylesheet" href="Compras.css">
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

        <div class="Compras-content">
            <h1>Cursos Comprados</h1>
            <table id="compras-table">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Fecha de Compra</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="CursoCom.php">LOL</a></td>
                        <td>2024-08-01</td>
                        <td><a href="CursoCom.php">Ver Curso</a></td>
                    </tr>
                    <tr>
                        <td><a href="CursoCom.php">Valorant</a></td>
                        <td>2024-03-15</td>
                        <td><a href="CursoCom.php">Ver Curso</a></td>
                    </tr>
                </tbody>
            </table>
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

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <p>&copy; 2024 OmIso. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="chat.js"></script>
</body>
</html>
