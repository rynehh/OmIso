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
                    // Asegúrate de que el ID del usuario esté disponible
                    $idUsuario = $_SESSION['idUsuario'] ?? null;

                    if ($idUsuario) {
                        // Consulta para obtener los cursos comprados por el usuario
                        $sql = $conex->query("SELECT CURSO.ID_CURSO, CURSO.TITULO, INSCRIPCION.FECHA_INSCRIPCION
                                              FROM USUARIO_CURSO AS INSCRIPCION
                                              INNER JOIN CURSO ON INSCRIPCION.ID_CURSO = CURSO.ID_CURSO
                                              WHERE INSCRIPCION.ID_USUARIO = $idUsuario");

                        // Verificar si la consulta tuvo éxito
                        if ($sql && $sql->num_rows > 0) {
                            // Generar dinámicamente las filas de la tabla
                            while ($curso = $sql->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><a href='CursoCom.php?id=" . $curso['ID_CURSO'] . "'>" . $curso['TITULO'] . "</a></td>";
                                echo "<td>" . $curso['FECHA_INSCRIPCION'] . "</td>";
                                echo "<td><a href='CursoCom.php?id=" . $curso['ID_CURSO'] . "'>Ver Curso</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            // Mostrar un mensaje si no se encontraron cursos
                            echo "<tr><td colspan='3'>No tienes cursos comprados.</td></tr>";
                        }
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

    <script src="chat.js"></script>
</body>
</html>
