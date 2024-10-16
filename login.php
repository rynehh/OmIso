<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Plataforma de Videojuegos</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <!-- Sección del Formulario -->
            <div class="login-form-container">
                <form id="loginForm">
                    <h2>Iniciar Sesión</h2>
                    <p>Accede a tus cursos de videojuegos</p>

                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu email" required>

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

                    <button type="submit" id="btnini">Iniciar Sesión</button>

                    <p id="error-message" class="error-message"></p>

                    <p class="extra-options">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
                </form>
            </div>
            <!-- Sección del Logo a la derecha -->
            <div class="login-logo">
                <img src="logo.jpg" alt="Logo de la empresa">
            </div>
        </div>
    </div>
    <script src="login.js"></script>
</body>
</html>
