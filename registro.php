<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Plataforma de Videojuegos</title>
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <!-- Sección del Formulario de Registro -->
            <div class="login-form-container">
                <form method="post" enctype="multipart/form-data" id="registerForm" name="registerFrom">
                    <h2>Registro</h2>
                    <p>Crea una cuenta para acceder a tus cursos de videojuegos</p>

                    <label for="foto-perfil">Foto de Perfil:</label >
                        <div class="custom-file">
                        <input type="file" id="foto-perfil" name="foto-perfil" class="custom-file-input" required>
                       
                    </div>

                    <label for="name">Nombre completo:</label>
                    <input type="text" id="name" name="name" placeholder="Ingresa tu nombre completo" required>

                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu email" required>

                    <label for="genero">Género:</label>
                    <select id="genero" name="genero" class="form-control" required>
                        <option value="" disabled selected>Selecciona tu género</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                        <option value="3">Otro</option>
                    </select>

                    <label for="fecha-nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" class="form-control" max="" required>

                    <label for="cuenta">Tipo de Cuenta:</label>
                    <select id="cuenta" name="cuenta" class="form-control" required>
                        <option value="" disabled selected>Selecciona</option>
                        <option value="3">Maestro</option>
                        <option value="2">Estudiante</option>
                    </select>

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

                    <label for="confirm-password">Confirmar contraseña:</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirma tu contraseña" required>

                    <button type="submit" id="btnregistro" name="btnregistro">Registrarse</button>

                    <p id="error-message" class="error-message"></p>

                    <p class="extra-options">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
                </form>

                <?php
                include ("00ConexionNewUser.php");
                ?>
	
            </div>
            <!-- Sección del Logo a la derecha -->
            <div class="login-logo">
                <img src="logo.png" alt="Logo de la empresa">
            </div>
        </div>
    </div>

    <script src="registro.js"></script>

</body>
</html>
