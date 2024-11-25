<?php
include("00ConexionDB.php");
session_start();

// Verifica que el rol sea 2 (alumno)
if ($_SESSION['rol'] != 2) {
    header("Location: inicio.php");
    exit;
}

if (!isset($_SESSION['idUsuario'])) {
    echo "Error: No se encontró el ID de usuario en la sesión.";
    exit;
}

$idUsuario = $_SESSION['idUsuario'];

// Obtener los instructores de los cursos en los que el alumno está inscrito
$query = "
    SELECT DISTINCT u.ID_USUARIO, u.NOMBRE
    FROM usuario u
    JOIN curso c ON u.ID_USUARIO = c.ID_INSTRUCTOR
    JOIN usuario_curso uc ON c.ID_CURSO = uc.ID_CURSO
    WHERE u.ROL = 3 AND uc.ID_USUARIO = $idUsuario
";

$result = $conex->query($query);

if (!$result) {
    die("Error en la consulta SQL: " . $conex->error);
}

$instructores = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $instructores[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Alumno</title>
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
                    <li><a href="00Cerrarsesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="chat-container">
        <div class="users-list">
            <h3>Instructores</h3>
            <ul id="user-list">
                <?php foreach ($instructores as $instructor): ?>
                    <li>
                        <button class="user-btn" data-id="<?= htmlspecialchars($instructor['ID_USUARIO']) ?>">
                            <?= htmlspecialchars($instructor['NOMBRE']) ?>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="chat-box">
            <div class="chat-header">
                <h3 id="chat-title">Selecciona un instructor</h3>
            </div>
            <div class="chat-messages" id="chat-messages"></div>
            <div class="chat-input">
                <textarea id="message-input" placeholder="Escribe tu mensaje..."></textarea>
                <button id="send-message">Enviar</button>
            </div>
        </div>
    </div>
    <script src="chat_alumno.js"></script>
</body>
</html>
