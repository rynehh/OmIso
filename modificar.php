<?php
include("00ConexionDB.php");
session_start();
?>

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
                <form method="post" enctype="multipart/form-data" id="editForm" name="nameForm">
                    <h2>Modificar</h2>
                    <p>Modifica tu cuenta</p>

                    <label for="foto-perfil">Foto de Perfil:</label >
                        <div class="custom-file">
                        <input type="file" id="foto-perfil" value="<?php echo $_SESSION['pfp']; ?>" class="custom-file-input">
                       
                    </div>

                    <label for="name">Nombre completo:</label>
                    <input type="text" id="name" name="name" value="<?php echo $_SESSION['nom']; ?>"  placeholder="Ingresa tu nombre completo" required>

                    <label for="genero">Género:</label>
                    <select id="genero" name="genero" class="form-control"  value="<?php echo $_SESSION['gen']; ?>"  required>
                        <option value="" disabled selected>Selecciona tu género</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>

                    <label for="fecha-nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" value="<?php echo $_SESSION['naci']; ?>"  class="form-control" max="" required>


                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" value="<?php echo $_SESSION['contra']; ?>" placeholder="Ingresa tu contraseña" required>

                    <label for="confirm-password">Confirmar contraseña:</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirma tu contraseña" required>

                    <button type="submit" id="btnedit" name="btnedit">Modificar</button>

                    <p id="error-message" class="error-message"></p>

                    
                </form>
            </div>
            <!-- Sección del Logo a la derecha -->
            <div class="login-logo">
                <img src="logo.png" alt="Logo de la empresa">
            </div>
        </div>
    </div>
    <?php
	include ("00ConexionEditUser.php");
	?>
    <script src="editarPerfil.js"></script>
</body>
</html>
