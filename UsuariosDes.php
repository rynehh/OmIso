<?php
include("00ConexionDB.php");
session_start();

// Verificar que el usuario haya iniciado sesión como administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['rol'] != 1) {
    header("Location: inicio.php");
    exit;
}

// Consultar usuarios deshabilitados
$query = "SELECT ID_USUARIO, NOMBRE, EMAIL FROM usuario WHERE INHABILITADO = 1";
$result = $conex->query($query);

$usuariosDeshabilitados = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuariosDeshabilitados[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Deshabilitados</title>
    <link rel="stylesheet" href="Admin.css"> <!-- Estilos principales -->
    <link rel="stylesheet" href="deshab.css"> <!-- Estilos para esta página -->
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
            </ul>
        </div>

        <!-- Contenido principal -->
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
                    <?php if (!empty($usuariosDeshabilitados)): ?>
                        <?php foreach ($usuariosDeshabilitados as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['NOMBRE']) ?></td>
                                <td><?= htmlspecialchars($usuario['EMAIL']) ?></td>
                                <td>
                                    <button 
                                        class="habilitar-btn" 
                                        data-id="<?= htmlspecialchars($usuario['ID_USUARIO']) ?>" 
                                        onclick="habilitarUsuario(this)">
                                        Habilitar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No hay usuarios deshabilitados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="deshab.js"></script>
    <footer>
        <div class="container">
            <p>&copy; 2024 OmIso. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
