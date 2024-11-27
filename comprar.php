<?php
session_start();
require '00ConexionDB.php'; // Conexión a la base de datos

// Capturar el ID del curso desde la URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Curso no válido.";
    exit;
}

$idCurso = intval($_GET['id']); // ID del curso pasado por la URL

// Obtener los datos del curso, incluyendo el costo
$queryCurso = "SELECT TITULO, COSTO FROM curso WHERE ID_CURSO = ?";
$stmt = $conex->prepare($queryCurso);
$stmt->bind_param("i", $idCurso);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $curso = $result->fetch_assoc();
    $tituloCurso = htmlspecialchars($curso['TITULO']);
    $costoCurso = number_format($curso['COSTO'], 2);
} else {
    echo "Curso no encontrado.";
    exit;
}

// Procesar el formulario si es enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre'], $_POST['email'], $_POST['tarjeta'], $_POST['expiracion'], $_POST['cvv'], $_POST['formaPago'], $_SESSION['idUsuario'])) {
        $idUsuario = $_SESSION['idUsuario']; // ID del usuario autenticado
        $formaPago = $_POST['formaPago']; // Forma de pago seleccionada
        $fechaHoy = date('Y-m-d');

        // Insertar en la tabla usuario_curso
        $queryInsert = "INSERT INTO usuario_curso (ID_USUARIO, ID_CURSO, FECHA_INSCRIPCION, FROMAPAGO, CALIFICACION) VALUES (?, ?, ?, ?, NULL)";
        $stmt = $conex->prepare($queryInsert);
        $stmt->bind_param("iiss", $idUsuario, $idCurso, $fechaHoy, $formaPago);

        if ($stmt->execute()) {
            echo "<p>¡Compra realizada con éxito! Ahora estás inscrito en el curso.</p>";
            header("Location: CursoCom.php?id={$idCurso}");
        } else {
            echo "<p>Error al procesar la compra. Por favor, intenta nuevamente.</p>";
        }
    } else {
        echo "<p>Por favor, completa todos los campos del formulario.</p>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Curso</title>
    <link rel="stylesheet" href="comprar.css">
</head>
<body>
    <div class="compra-container">
        <h1>Compra tu curso</h1>
        <p><strong>Curso:</strong> <?php echo $tituloCurso; ?></p>
        <p><strong>Monto a Pagar:</strong> $<?php echo $costoCurso; ?></p>
        <form method="POST" action="">
            <label for="nombre">Nombre completo:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="tarjeta">Número de tarjeta:</label>
            <input type="text" id="tarjeta" name="tarjeta" maxlength="16" required>

            <label for="expiracion">Fecha de expiración (MM/AA):</label>
            <input type="text" id="expiracion" name="expiracion" maxlength="5" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" maxlength="3" required>

            <label for="formaPago">Forma de Pago:</label>
            <select id="formaPago" name="formaPago" required>
            <option value="TARJETA CRÉDITO">TARJETA CRÉDITO</option>
            <option value="TARJETA DÉBITO">TARJETA DÉBITO</option>
            </select>


            <button type="submit" class="btn-comprar">Procesar pago</button>
        </form>
    </div>
</body>
</html>
