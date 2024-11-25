<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Deshabilitados</title>
    <link rel="stylesheet" href="Admin.css"> <!-- Mantendremos los estilos del perfil -->
    <link rel="stylesheet" href="deshab.css"> <!-- Incluimos los estilos de la tabla -->
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <a href="inicio.php" class="logo">OmIso</a>
                <ul class="nav-links">
                    <li><a href="inicio.php">Inicio</a></li>
                    <li><a href="cursos.php">Cursos</a></li>
                    <li><a href="Admin.php">Perfil</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="profile-container">
        <!-- Sidebar se mantiene igual -->
        <div class="sidebar">
            <ul>
                <li><a href="UsuariosDes.php">Usuarios Deshabilitados</a></li>
                <li><a href="Categorias.php">Categorias</a></li>
            </ul>
        </div>

        <!-- Aquí mostramos la tabla de usuarios deshabilitados en lugar del perfil -->
        <div class="profile-content">
            <h1>Usuarios Deshabilitados</h1>
            <table id="usuarios-deshabilitados-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Habilitar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ejemplo1</td>
                        <td>ejemplo1@correo.com</td>
                        <td><button class="habilitar-btn" onclick="habilitarUsuario(this)">Habilitar</button></td>
                    </tr>
                    <tr>
                        <td>Ejemplo2</td>
                        <td>ejemplo2@correo.com</td>
                        <td><button class="habilitar-btn" onclick="habilitarUsuario(this)">Habilitar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <script src="admin.js"></script> <!-- Mantiene el script de perfil -->
    <script src="deshab.js"></script> <!-- Script para manejar habilitar usuarios -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Everdwell. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
