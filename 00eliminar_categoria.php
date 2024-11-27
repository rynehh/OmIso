<?php
include("00ConexionDB.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $categoriaId = intval($_POST['categoriaId']);

    // Verifica si el ID de la categoría es válido
    if ($categoriaId <= 0) {
        echo json_encode(["success" => false, "message" => "ID de categoría inválido."]);
        exit;
    }

    // Llamar al procedimiento almacenado para realizar la baja lógica
    $stmt = $conex->prepare("CALL BajaLogicaCategoria(?)");
    $stmt->bind_param("i", $categoriaId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Categoría eliminada correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar la categoría."]);
    }

    $stmt->close();
}
?>
