<?php
include("00ConexionDB.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (strlen($_POST['email']) >= 1 && strlen($_POST['password']) >= 1) {
        $mail = trim($_POST['email']);
        $pssw = trim($_POST['password']);

       
        $sql = $conex->query("CALL IniciarSesion('$mail', '$pssw')");

        if ($sql->num_rows > 0 && $validacion = $sql->fetch_object()) {
            
            if (isset($validacion->ROL)) {
                
                $_SESSION['rol'] = $validacion->ROL;
                $_SESSION['contra'] = $validacion->CONTRASEÑA;
                $_SESSION['pfp'] = $validacion->FOTO;
                $_SESSION['nom'] = $validacion->NOMBRE;
                $_SESSION['naci'] = $validacion->FNACI;
                $_SESSION['Correo'] = $validacion->EMAIL;
                $_SESSION['gen'] = $validacion->GENERO;
                
                echo 'Inicio de sesión exitoso';
            } else {
                echo 'No se inició sesión: usuario o contraseña incorrectos';
            }
        } else {
            ?> 
            <h2 class="Error">No se inició sesión: Usuario o contraseña incorrectos.</h2>
            <?php
        }
    } else {
        ?>
        <h2 class="Error">Por favor, ingresa todos los campos.</h2>
        <?php
    }
}
?>
