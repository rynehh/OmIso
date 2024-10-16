<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="reportes.css">
</head>
<body>
    <!-- Header con navegación -->
    <header>
    <nav class="navbar">
        <div class="container">
            <a href="inicio.php" class="logo">Everdwell</a>
            <ul class="nav-links">
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="perfil.php">Perfil</a></li>
                <li><a href="cursos.php">Cursos</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>
</header>

    <!-- Contenedor principal de reportes -->
    <div class="container mt-4">
        <h1>Reportes de Usuarios</h1>

        <!-- Seleccionar tipo de usuario -->
        <div class="mb-3">
            <label for="tipoUsuario" class="form-label">Seleccionar Tipo de Usuario</label>
            <select class="form-select" id="tipoUsuario" onchange="mostrarReporte()">
                <option value="">Selecciona un tipo de usuario</option>
                <option value="instructor">Instructor</option>
                <option value="estudiante">Estudiante</option>
            </select>
        </div>

        <!-- Contenedor para mostrar el reporte -->
        <div id="reporteContainer" class="mt-4">
            <!-- Aquí se mostrará el reporte dependiendo del tipo de usuario -->
        </div>
    </div>

    <script src="reportes.js"></script>
</body>
</html>
