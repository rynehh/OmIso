<?php
include("00ConexionDB.php");
session_start();

// Verificar que el usuario haya iniciado sesión como administrador
if (!isset($_SESSION['idUsuario']) || $_SESSION['rol'] != 1) {
    header("Location: inicio.php");
    exit;
}

// Obtener usuarios activos según el filtro
if (isset($_GET['tipo_usuario'])) {
    $tipoUsuario = $_GET['tipo_usuario']; // 3 para maestros, 2 para alumnos
    if ($tipoUsuario == 3) {
        // Maestros
        $query = "
            SELECT 
                u.NOMBRE, 
                u.FREGISTRO AS FECHA_INGRESO,
                COUNT(c.ID_CURSO) AS CANTIDAD_CURSOS,
                COALESCE(SUM(v.INGRESOS), 0) AS GANANCIAS
            FROM usuario u
            LEFT JOIN curso c ON u.ID_USUARIO = c.ID_INSTRUCTOR
            LEFT JOIN venta v ON c.ID_CURSO = v.ID_CURSO
            WHERE u.ROL = 3 AND u.INHABILITADO = 0
            GROUP BY u.ID_USUARIO
        ";
    } elseif ($tipoUsuario == 2) {
        // Alumnos
        $query = "
            SELECT 
                u.NOMBRE, 
                u.FREGISTRO AS FECHA_INGRESO,
                COUNT(uc.ID_CURSO) AS CURSOS_INSCRITOS,
                (SELECT COUNT(*) FROM niveles_completados nc WHERE nc.ID_USUARIO = u.ID_USUARIO) AS CURSOS_TERMINADOS
            FROM usuario u
            LEFT JOIN usuario_curso uc ON u.ID_USUARIO = uc.ID_USUARIO
            WHERE u.ROL = 2 AND u.INHABILITADO = 0
            GROUP BY u.ID_USUARIO
        ";
    } else {
        echo json_encode(["error" => "Tipo de usuario inválido"]);
        exit;
    }

    $result = $conex->query($query);
    $usuarios = [];
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
    echo json_encode($usuarios);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>
    <link rel="stylesheet" href="reportesusuario.css">
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
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="profile-content">
            <h1>Reporte de Usuarios</h1>
            <form id="filtrosReporte">
                <label for="tipoUsuario">Filtrar por tipo de usuario:</label>
                <select id="tipoUsuario" onchange="obtenerReporteUsuarios()">
                    <option value="">Seleccione</option>
                    <option value="3">Maestros</option>
                    <option value="2">Alumnos</option>
                </select>
            </form>
            
            <table id="reporte-usuarios-table">
                <thead>
                    <tr id="encabezadoTabla">
                        <!-- Encabezados dinámicos -->
                    </tr>
                </thead>
                <tbody id="cuerpoTabla">
                    <!-- Datos dinámicos -->
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function obtenerReporteUsuarios() {
            const tipoUsuario = document.getElementById("tipoUsuario").value;
            if (!tipoUsuario) {
                alert("Seleccione un tipo de usuario");
                return;
            }

            fetch(`ReporteAdmin.php?tipo_usuario=${tipoUsuario}`)
                .then(response => response.json())
                .then(data => {
                    const encabezadoTabla = document.getElementById("encabezadoTabla");
                    const cuerpoTabla = document.getElementById("cuerpoTabla");

                    // Limpiar tabla
                    encabezadoTabla.innerHTML = "";
                    cuerpoTabla.innerHTML = "";

                    // Definir encabezados según el tipo de usuario
                    if (tipoUsuario == "3") {
                        encabezadoTabla.innerHTML = `
                            <th>Nombre</th>
                            <th>Fecha de Ingreso</th>
                            <th>Cantidad de Cursos Ofrecidos</th>
                            <th>Ganancias Totales</th>
                        `;
                        data.forEach(usuario => {
                            cuerpoTabla.innerHTML += `
                                <tr>
                                    <td>${usuario.NOMBRE}</td>
                                    <td>${usuario.FECHA_INGRESO}</td>
                                    <td>${usuario.CANTIDAD_CURSOS}</td>
                                    <td>$${usuario.GANANCIAS}</td>
                                </tr>
                            `;
                        });
                    } else if (tipoUsuario == "2") {
                        encabezadoTabla.innerHTML = `
                            <th>Nombre</th>
                            <th>Fecha de Ingreso</th>
                            <th>Cursos Inscritos</th>
                            <th>Cursos Terminados</th>
                        `;
                        data.forEach(usuario => {
                            cuerpoTabla.innerHTML += `
                                <tr>
                                    <td>${usuario.NOMBRE}</td>
                                    <td>${usuario.FECHA_INGRESO}</td>
                                    <td>${usuario.CURSOS_INSCRITOS}</td>
                                    <td>${usuario.CURSOS_TERMINADOS}</td>
                                </tr>
                            `;
                        });
                    }
                })
                .catch(error => {
                    console.error("Error al obtener los datos:", error);
                });
        }
    </script>
</body>
</html>
