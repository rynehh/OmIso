<?php
include("00ConexionDB.php");

$val = 0;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(
        isset($_POST['genero']) &&
        isset($_POST['name']) &&
        isset($_POST['fecha-nacimiento']) &&
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['confirm-password']) &&
        isset($_POST['cuenta']) 
    ) {
        
        $Gen = trim($_POST['genero']);
        $Name = trim($_POST['name']);
        $Nac = trim($_POST['fecha-nacimiento']);
        $mail = trim($_POST['email']);
        $pssw = trim($_POST['password']);
        $tipo = trim($_POST['cuenta']);
        $pssw2 = trim($_POST['confirm-password']);

                  
                    if(!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $Name)) {
                        ?>
                        <h2 class="Error">-El nombre solo pueden contener letras y espacios</h2>
                        <?php
                    }
                    else{
                        $val++;
                    }

                 
                    $DATEVER = trim($_POST['fecha-nacimiento']);
                    $FEC = DateTime::createFromFormat('Y-m-d', $DATEVER);
                    $TDY = new DateTime();
                    if(!$FEC || $FEC > $TDY) {
                        ?>
                        <h2 class="Error">-La fecha de nacimiento no es válida</h2>
                        <?php
                    }
                    else{
                        $val++;
                    }

                    
                    $PSWVER = trim($_POST['password']);
                    if(!preg_match('/^(?=.*[a-záéíóú])(?=.*[A-ZÁÉÍÓÚ])(?=.*\d)(?=.*[\W_])[\da-zA-ZáéíóúÁÉÍÓÚ\W_]{8,}$/', $PSWVER)) {
                    ?>
                    <h2 class="Error">-La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial</h2>
                    <?php

                    }
                    else
                    {
                        $val++;
                    }
           
            if($pssw==$pssw2)
            {
                $val++;
            }
            else{
                ?>
                <h2 class="Error">-Las contraseñas no coinciden.</h2>
                <?php
            }

            //IMAGEN
            if (isset($_FILES['foto-perfil']) && $_FILES['foto-perfil']['error'] === UPLOAD_ERR_OK) {
                $val++;
                $Foto = base64_encode(file_get_contents($_FILES['foto-perfil']['tmp_name']));

                
            } else {
            
                ?> 
                        <h2 class="Error">-No se selecciono imagen</h2>           
                        <?php
            }
        if($val >= 5) {

            $insertar = "CALL AltaUsuario ('$mail','$Name','$Gen','$Nac', '$tipo', '$Foto','$pssw')";
            $resultado = mysqli_query($conex, $insertar);
            if($resultado) {
                ?>
                <h2 class="Existoso">¡Registro Exitoso!</h2>
                <?php
            } else {
                ?>
                <h2 class="Error">Error al registrar la cuenta.</h2>
                <?php
            }
        } else {
            ?>
            <h2 class="Error">Debe seleccionar una imagen.</h2>
            <?php
        }
    } else {
        ?>
        <h2 class="Error">Por favor, complete todos los campos.</h2>
        <?php
    }
}
?><?php
include("00ConexionDB.php");

$val = 0;
$response = ["errors" => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['genero']) && !empty($_POST['name']) && !empty($_POST['fecha-nacimiento']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password']) && !empty($_POST['cuenta'])) {
        $Gen = trim($_POST['genero']);
        $Name = trim($_POST['name']);
        $Nac = trim($_POST['fecha-nacimiento']);
        $mail = trim($_POST['email']);
        $pssw = trim($_POST['password']);
        $tipo = trim($_POST['cuenta']);
        $pssw2 = trim($_POST['confirm-password']);

        // Validaciones
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $Name)) {
            $response["errors"][] = "El nombre solo pueden contener letras y espacios";
        } else { $val++; }

        $DATEVER = trim($_POST['fecha-nacimiento']);
        $FEC = DateTime::createFromFormat('Y-m-d', $DATEVER);
        $TDY = new DateTime();
        if (!$FEC || $FEC > $TDY) {
            $response["errors"][] = "La fecha de nacimiento no es válida";
        } else { $val++; }

        if (!preg_match('/^(?=.*[a-záéíóú])(?=.*[A-ZÁÉÍÓÚ])(?=.*\d)(?=.*[\W_])[\da-zA-ZáéíóúÁÉÍÓÚ\W_]{8,}$/', $pssw)) {
            $response["errors"][] = "La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial";
        } else { $val++; }

        if ($pssw !== $pssw2) {
            $response["errors"][] = "Las contraseñas no coinciden";
        } else { $val++; }

        if ($val >= 4) {
            $Foto = isset($_FILES['foto-perfil']) ? base64_encode(file_get_contents($_FILES['foto-perfil']['tmp_name'])) : null;
            $hashed_password = password_hash($pssw, PASSWORD_BCRYPT);

            $insertar = "CALL AltaUsuario ('$mail','$Name','$Gen','$Nac', '$tipo', '$Foto','$hashed_password')";
            $resultado = mysqli_query($conex, $insertar);
            
            $response["message"] = $resultado ? "Registro Exitoso" : "Error al registrar la cuenta";
        }
         } else {
        $response["errors"][] = "Por favor, complete todos los campos";
         }
}

/*echo json_encode($response);*/
?>
