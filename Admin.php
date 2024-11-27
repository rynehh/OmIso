<?php
include("00ConexionDB.php"); // Incluye la conexión a la base de datos
session_start();

// Verificar si el usuario tiene rol de administrador (ROL = 1) y está autenticado
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1 && isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];

    // Consultar la base de datos para obtener los datos del usuario
    $query = "SELECT NOMBRE, EMAIL, FOTO FROM usuario WHERE ID_USUARIO = ?";
    if ($stmt = $conex->prepare($query)) { // Usar $conex en lugar de $conn
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
        } else {
            echo "No se encontraron datos del usuario.";
            exit;
        }
        $stmt->close();
    } else {
        die("Error al preparar la consulta: " . $conex->error);
    }
} else {
    // Redirigir al login si no hay sesión o no es administrador
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Plataforma de Videojuegos</title>
    <link rel="stylesheet" href="Admin.css">
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
        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li><a href="UsuariosDes.php">Usuarios Deshabilitados</a></li>
                <li><a href="Categorias.php">Categorías</a></li>
                <li><a href="ReporteAdmin.php">Reportes de Usuario</a></li>
                <li><a href="modificar.php">Editar Perfil</a></li>
            </ul>
        </div>

        <!-- Contenido del perfil -->
        <div class="profile-content">
            <h1>Tu Perfil</h1>
            <p>Bienvenido, <?php echo htmlspecialchars($usuario['NOMBRE']); ?>.</p>
            <p>Correo Electrónico: <?php echo htmlspecialchars($usuario['EMAIL']); ?></p>
            <?php if (!empty($usuario['FOTO'])): ?>
            <!-- Mostrar la imagen de perfil en caso de que exista -->
            <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($usuario['FOTO']); ?>" 
                alt="Foto de perfil" 
                style="width: 150px; height: 150px; border-radius: 50%;">
        <?php else: ?>
            <!-- Mostrar una imagen predeterminada si no hay foto cargada -->
            <img src="default-profile.png" 
                alt="Foto predeterminada" 
                style="width: 150px; height: 150px; border-radius: 50%;">
        <?php endif; ?>
            <p>Gestiona Usuarios y Categorías desde este panel.</p>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Everdwell. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
