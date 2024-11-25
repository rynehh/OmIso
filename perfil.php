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
                    <li><a href="perfil.php">Perfil</a></li>
                    <li><a href="chat_alumno.php">Chat</a></li>
                  

                </ul>
            </div>
        </nav>
    </header>

    <main class="profile-container">
        <div class="sidebar">
            <ul>
                <li><a href="Kardex.php">Kardex</a></li>
                <li><a href="Compras.php">Cursos Comprados</a></li>
                <li><a href="modificar.php">Editar Perfil</a></li>
            </ul>
        </div>

        <div class="profile-content">
            <h1>Tu Perfil</h1>
            <p>Bienvenido, <?php echo $_SESSION['nom']; ?> <?php echo $_SESSION['idUsuario']; ?> </p>
            <p>Aquí puedes ver y gestionar tus cursos y acceder a tu información personal.</p>
        </div>
    </main>    
    <footer>
        <div class="container">
            <p>&copy; 2024 OmIso. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>

