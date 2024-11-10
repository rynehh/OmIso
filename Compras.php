<?php
include("00ConexionDB.php");
session_start();
?>

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
                    <?php
                    // Asegurarse de que el usuario está autenticado
                    if (isset($_SESSION['idUsuario'])) {
                        $idUsuario = $_SESSION['idUsuario'];

                        // Consulta para obtener los cursos comprados por el usuario
                        $query = "SELECT CURSO.ID_CURSO, CURSO.TITULO, INSCRIPCION.FECHA_INSCRIPCION 
                                  FROM USUARIO_CURSO AS INSCRIPCION
                                  INNER JOIN CURSO ON INSCRIPCION.ID_CURSO = CURSO.ID_CURSO
                                  WHERE INSCRIPCION.ID_USUARIO = ?";
                        $stmt = $conex->prepare($query);
                        $stmt->bind_param("i", $idUsuario);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Verificar si hay resultados
                        if ($result && $result->num_rows > 0) {
                            while ($curso = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><a href='CursoCom.php?curso_id=" . htmlspecialchars($curso['ID_CURSO']) . "'>" . htmlspecialchars($curso['TITULO']) . "</a></td>";
                                echo "<td>" . htmlspecialchars($curso['FECHA_INSCRIPCION']) . "</td>";
                                echo "<td><a href='CursoCom.php?curso_id=" . htmlspecialchars($curso['ID_CURSO']) . "' class='btn-ver'>Ver Curso</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No tienes cursos comprados.</td></tr>";
                        }

                        $stmt->close();
                    } else {
                        echo "<tr><td colspan='3'>Usuario no autenticado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Chat y pie de página (sin cambios) -->
    <div class="chat-window" id="chat-window">
        <!-- Chat y usuarios conectados -->
    </div>
    <footer>
        <div class="container">
            <p>&copy; 2024 OmIso. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="compras.js"></script>
    <script src="chat.js"></script>
</body>
</html>
