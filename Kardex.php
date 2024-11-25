<?php
include("00ConexionDB.php");
session_start();

// Verificar que el usuario haya iniciado sesión.
if (!isset($_SESSION['idUsuario'])) {
    die("Error: Usuario no autenticado.");
}

// Cargar datos del Kardex desde la base de datos.
$idUsuario = $_SESSION['idUsuario'];
$query = "SELECT * FROM kardex WHERE id_usuario = ?";
$stmt = $conex->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();

$kardex_data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kardex_data[] = $row;
    }
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kardex</title>
    <link rel="stylesheet" href="kardex.css">
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

    <div class="sidebar">
            <ul>
                <li><a href="Kardex.php">Kardex</a></li>
                <li><a href="Compras.php">Cursos Comprados</a></li>
            </ul>
        </div>
    <main class="kardex-container">
        <h1>Tu Kardex</h1>
        <table>
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Calificación</th>
                    <th>Fecha de Inscripción</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($kardex_data)): ?>
                    <?php foreach ($kardex_data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['curso']) ?></td>
                            <td><?= htmlspecialchars($row['calificacion']) ?></td>
                            <td><?= htmlspecialchars($row['fecha_inscripcion']) ?></td>
                            <td><?= htmlspecialchars($row['estado']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay datos disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 OmIso. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
