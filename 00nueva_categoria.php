<?php
include("00ConexionDB.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $stmt = $conex->prepare("CALL InsertarCategoria(?, ?)");
    $stmt->bind_param("ss", $nombre, $descripcion);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Categoría creada correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al crear la categoría."]);
    }

    $stmt->close();
}
?>
