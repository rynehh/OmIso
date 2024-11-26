<?php
include("00ConexionDB.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['titulo'], $_POST['descripcion'], $_POST['costo'], $_SESSION['idUsuario'])
    ) {
        $titulo = trim($_POST['titulo']);
        $descripcion = trim($_POST['descripcion']);
        $costo = trim($_POST['costo']);
        $instructorId = $_SESSION['idUsuario'];
        $categoria = trim($_POST['categoria']);
        $calificacion = 0; 
        $baja = 0;

        if (isset($_POST['niveles']) && is_numeric($_POST['niveles'])) {
            $nivelCount = (int)$_POST['niveles']; // Convertir el valor a entero
        } else {
            $nivelCount = 0; // Valor predeterminado si no está definido o no es válido
        }

        // Procesar imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $Foto = base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
        } else {
            echo "<h2 class='Error'>-No se seleccionó imagen</h2>";
            exit;
        }

        // Llamar al procedimiento almacenado para insertar curso
        $insertar = "CALL sp_InsertarCurso(?, ?, ?, ?, ?, ?, ?, ?, ?, @p_id_curso)";
        $sql = $conex->prepare($insertar);

        if (!$sql) {
            echo "<h2 class='Error'>Error en la preparación del SQL: " . $conex->error . "</h2>";
            exit;
        }

        $sql->bind_param("isdsdsiii", $categoria, $titulo, $costo, $descripcion, $calificacion, $Foto, $nivelCount, $baja, $instructorId);

        if (!$sql->execute()) {
            echo "<h2 class='Error'>Error en la ejecución del SQL: " . $sql->error . "</h2>";
            exit;
        }

        // Recuperar el ID del curso insertado
        $result = $conex->query("SELECT @p_id_curso AS id");
        if ($result) {
            $row = $result->fetch_assoc();
            $curso_id = $row['id'];
        } else {
            echo "<h2 class='Error'>No se pudo recuperar el ID del curso.</h2>";
            exit;
        }

        // Insertar niveles, si hay
        if (isset($_POST['niveles']) && is_array($_POST['niveles'])) {
            foreach ($_POST['niveles'] as $index => $nivel) {
                $nivelTitulo = trim($nivel['titulo']);
                $nivelContenido = trim($nivel['texto']);
                $nivelCosto = trim($nivel['costo']);

                $rutaVideo = null;
                if (
                    isset($_FILES['niveles']['name'][$index]['video']) &&
                    !empty($_FILES['niveles']['name'][$index]['video'])
                ) {
                    $directorio = "uploads/";
                    if (!is_dir($directorio)) {
                        mkdir($directorio, 0777, true); // Crear carpeta si no existe
                    }

                    $nombreArchivo = basename($_FILES['niveles']['name'][$index]['video']);
                    $rutaVideo = $directorio . $nombreArchivo;

                    // Validaciones para el archivo de video
                    $uploadOk = 1;
                    $fileType = strtolower(pathinfo($rutaVideo, PATHINFO_EXTENSION));

                    // Verificar si el archivo ya existe
                    if (file_exists($rutaVideo)) {
                        echo "<h2 class='Error'>El archivo $nombreArchivo ya existe en el servidor.</h2>";
                        $uploadOk = 0;
                    }

                    // Verificar el tamaño del archivo (limite: 10MB)
                    if ($_FILES['niveles']['size'][$index]['video'] > 10000000) {
                        echo "<h2 class='Error'>El archivo $nombreArchivo es demasiado grande (máximo 10MB).</h2>";
                        $uploadOk = 0;
                    }

                    // Verificar el tipo de archivo
                    $tiposPermitidos = ['mp4', 'avi', 'mkv', 'mov'];
                    if (!in_array($fileType, $tiposPermitidos)) {
                        echo "<h2 class='Error'>El archivo $nombreArchivo tiene un formato no permitido. Solo se permiten MP4, AVI, MKV y MOV.</h2>";
                        $uploadOk = 0;
                    }

                    // Intentar mover el archivo si pasa todas las validaciones
                    if ($uploadOk == 1) {
                        if (!move_uploaded_file($_FILES['niveles']['tmp_name'][$index]['video'], $rutaVideo)) {
                            echo "<h2 class='Error'>Error al subir el archivo $nombreArchivo al servidor.</h2>";
                            $rutaVideo = null; // No guardar ruta si no se subió correctamente
                        } else {
                            echo "<h2 class='Exitoso'>El archivo $nombreArchivo se subió correctamente.</h2>";
                        }
                    } else {
                        $rutaVideo = null; // No guardar ruta si hubo algún problema
                    }
                }

                $sqlNivel = $conex->prepare("CALL sp_InsertarNivel(?, ?, ?, ?, ?)");
                if (!$sqlNivel) {
                    echo "<h2 class='Error'>Error en la preparación del SQL de nivel: " . $conex->error . "</h2>";
                    exit;
                }

                $sqlNivel->bind_param("issds", $curso_id, $nivelTitulo, $nivelContenido, $nivelCosto, $rutaVideo);

                if (!$sqlNivel->execute()) {
                    echo "<h2 class='Error'>Error al ejecutar el SQL de nivel: " . $sqlNivel->error . "</h2>";
                    exit;
                }

                $sqlNivel->close();
            }
        }

        echo "<h2 class='Exitoso'>¡Curso y niveles guardados exitosamente!</h2>";
    } else {
        echo "<h2 class='Error'>Datos incompletos o usuario no autenticado.</h2>";
    }
}
?>
