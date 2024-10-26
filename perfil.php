<?php
include("00ConexionDB.php");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Plataforma de Videojuegos</title>
    <link rel="stylesheet" href="perfil.css">
    <link rel="stylesheet" href="chat.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <a href="inicio.php" class="logo">OmIso</a>
                <ul class="nav-links">
                    <li><a href="inicio.php">Inicio</a></li>
                    <li><a href="cursos.php">Cursos</a></li>
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href="perfil.php">Perfil</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="profile-container">
        <div class="sidebar">
            <ul>
                <li><a href="Kardex.php">Kardex</a></li>
                <li><a href="Compras.php">Cursos Comprados</a></li>
            </ul>
        </div>

        <div class="profile-content">
            <h1>Tu Perfil</h1>
            <p>Bienvenido, <?php echo $_SESSION['nom']; ?> <?php echo $_SESSION['idUsuario']; ?> </p>
            <p>Aquí puedes ver y gestionar tus cursos y acceder a tu información personal.</p>
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
    <footer>
        <div class="container">
            <p>&copy; 2024 OmIso. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>

