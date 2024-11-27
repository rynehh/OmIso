<?php
include("00ConexionDB.php");
session_start();

// Verificar si el usuario tiene sesión iniciada
if (isset($_SESSION['idUsuario']) && isset($_SESSION['nom'])) {
    $idUsuario = $_SESSION['idUsuario'];

    // Consulta para obtener los datos del usuario
    $queryUsuario = "SELECT NOMBRE, EMAIL, FOTO FROM usuario WHERE ID_USUARIO = ?";
    $stmtUsuario = $conex->prepare($queryUsuario);
    $stmtUsuario->bind_param("i", $idUsuario);
    $stmtUsuario->execute();
    $resultUsuario = $stmtUsuario->get_result();

    if ($resultUsuario->num_rows > 0) {
        $usuario = $resultUsuario->fetch_assoc();
    } else {
        echo "No se encontraron datos del usuario.";
        exit;
    }
    $stmtUsuario->close();
} else {
    // Redirigir al login si no hay sesión activa
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
    <p>Bienvenido, <?php echo htmlspecialchars($usuario['NOMBRE']); ?>.</p>
    <p>Correo Electrónico: <?php echo htmlspecialchars($usuario['EMAIL']); ?></p>

    <?php if (!empty($usuario['FOTO'])): ?>
            <img src="data:image/jpeg;base64,<?php echo $usuario['FOTO']; ?>" alt="Foto de perfil" style="width: 150px; height: 150px; border-radius: 50%;">
        <?php else: ?>
            <img src="default-profile.png" alt="Foto predeterminada" style="width: 150px; height: 150px; border-radius: 50%;">
        <?php endif; ?>
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
