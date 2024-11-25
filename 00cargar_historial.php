<?php
include("00ConexionDB.php");
session_start();

header("Content-Type: application/json");

$response = [];

if (!isset($_SESSION['idUsuario'])) {
    $response['error'] = "Usuario no autenticado.";
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['destinatario'])) {
        $response['error'] = "Faltan datos en la solicitud.";
        echo json_encode($response);
        exit;
    }

    $remitente = $_SESSION['idUsuario'];
    $destinatario = $input['destinatario'];

    $stmt = $conex->prepare("
        SELECT m.TEXT, m.FECHORMEN, 
               (CASE 
                    WHEN mu.REMITENTE = ? THEN 'Tú' 
                    ELSE u.NOMBRE 
               END) AS REMITENTE
        FROM mensaje m
        JOIN mensaje_usuario mu ON m.ID_M = mu.ID_M
        JOIN usuario u ON u.ID_USUARIO = mu.REMITENTE
        WHERE (mu.REMITENTE = ? AND mu.DESTINATARIO = ?)
           OR (mu.REMITENTE = ? AND mu.DESTINATARIO = ?)
        ORDER BY m.FECHORMEN ASC
    ");
    $stmt->bind_param("iiiii", $remitente, $remitente, $destinatario, $destinatario, $remitente);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }

    echo json_encode($response);
}
?>
