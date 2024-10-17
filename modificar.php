<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar perfil - Plataforma de Videojuegos</title>
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <!-- Sección del Formulario de Registro -->
            <div class="login-form-container">
                <form id="registerForm">
                    <h2>Modificar</h2>
                    <p>Modifica tu cuenta</p>

                    <label for="foto-perfil">Foto de Perfil:</label >
                        <div class="custom-file">
                        <input type="file" id="foto-perfil" class="custom-file-input" required>
                       
                    </div>

                    <label for="name">Nombre completo:</label>
                    <input type="text" id="name" name="name" placeholder="Ingresa tu nombre completo" required>

                    <label for="genero">Género:</label>
                    <select id="genero" name="genero" class="form-control" required>
                        <option value="" disabled selected>Selecciona tu género</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>

                    <label for="fecha-nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" class="form-control" max="" required>


                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

                    <label for="confirm-password">Confirmar contraseña:</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirma tu contraseña" required>

                    <button type="submit" id="btnregistro">Registrarse</button>

                    <p id="error-message" class="error-message"></p>

                    
                </form>
            </div>
            <!-- Sección del Logo a la derecha -->
            <div class="login-logo">
                <img src="logo.jpg" alt="Logo de la empresa">
            </div>
        </div>
    </div>
    <script src="registro.js"></script>
</body>
</html>
