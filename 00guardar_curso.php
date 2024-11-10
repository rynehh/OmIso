<?php
include("00ConexionDB.php");
session_start();

$response = [];

// Verificar que se recibieron los datos del curso y que el usuario está autenticado
if (isset($_POST['titulo'], $_POST['descripcion'], $_POST['costo'], $_SESSION['idUsuario'])) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $instructorId = $_SESSION['idUsuario'];
    $categoria = 1; // Ajusta la categoría según sea necesario
    $calificacion = 0; // Calificación inicial
    $baja = 0;
    $nivelCount = 0;

    // Procesar imagen
    $rutaImagen = null;
    if (!empty($_FILES['imagen']['name'])) {
        $rutaImagen = "uploads/" . basename($_FILES['imagen']['name']);
        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            $response = ["status" => "error", "message" => "Error al guardar la imagen en el servidor."];
            echo json_encode($response);
            exit;
        }
    }

    // Llamar al procedimiento almacenado para insertar curso
    $sql = $conex->prepare("CALL sp_InsertarCurso(?, ?, ?, ?, ?, ?, ?, ?, ?, @p_id_curso)");
    if (!$sql) {
        $response = ["status" => "error", "message" => "Error en la preparación del SQL: " . $conex->error];
        echo json_encode($response);
        exit;
    }

    $sql->bind_param("isdssisi", $categoria, $titulo, $costo, $descripcion, $calificacion, $rutaImagen, $nivelCount, $baja, $instructorId);
    
    if (!$sql->execute()) {
        $response = ["status" => "error", "message" => "Error en la ejecución del SQL: " . $sql->error];
        echo json_encode($response);
        exit;
    }

    // Recuperar el ID del curso insertado
    $result = $conex->query("SELECT @p_id_curso AS id");
    if ($result) {
        $row = $result->fetch_assoc();
        $curso_id = $row['id'];
    } else {
        $response = ["status" => "error", "message" => "No se pudo recuperar el ID del curso."];
        echo json_encode($response);
        exit;
    }

    // Insertar niveles, si hay
    if (isset($_POST['niveles']) && is_array($_POST['niveles'])) {
        foreach ($_POST['niveles'] as $nivel) {
            $nivelTitulo = $nivel['titulo'];
            $nivelContenido = $nivel['contenido'];
            $nivelCosto = $nivel['costo'];

            $sqlNivel = $conex->prepare("CALL sp_InsertarNivel(?, ?, ?, ?)");
            if (!$sqlNivel) {
                $response = ["status" => "error", "message" => "Error en la preparación del SQL de nivel: " . $conex->error];
                echo json_encode($response);
                exit;
            }

            $sqlNivel->bind_param("issd", $curso_id, $nivelTitulo, $nivelContenido, $nivelCosto);
            
            if (!$sqlNivel->execute()) {
                $response = ["status" => "error", "message" => "Error al ejecutar el SQL de nivel: " . $sqlNivel->error];
                echo json_encode($response);
                exit;
            }

            $sqlNivel->close();
        }
    }

    $response = ["status" => "success", "message" => "Curso y niveles guardados exitosamente."];
} else {
    $response = ["status" => "error", "message" => "Datos incompletos o usuario no autenticado."];
}

echo json_encode($response);
?>
