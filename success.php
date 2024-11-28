<?php
session_start();
require '00ConexionDB.php'; // Conexión a la base de datos

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['idUsuario'])) {
    echo "Usuario no autenticado.";
    exit;
}

$idUsuario = $_SESSION['idUsuario']; // ID del usuario autenticado

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

// Insertar en la tabla usuario_curso después del pago exitoso
$fechaHoy = date('Y-m-d');
$formaPago = "STRIPE/TARJETA"; // Definir Stripe como forma de pago

$queryInsert = "INSERT INTO usuario_curso (ID_USUARIO, ID_CURSO, FECHA_INSCRIPCION, FROMAPAGO, CALIFICACION) VALUES (?, ?, ?, ?, NULL)";
$stmt = $conex->prepare($queryInsert);
$stmt->bind_param("iiss", $idUsuario, $idCurso, $fechaHoy, $formaPago);

if ($stmt->execute()) {


} else {
    echo "<p>Error al procesar la compra. Por favor, intenta nuevamente.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Exitosa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d4edda; /* Fondo verde claro */
            color: #155724; /* Texto verde oscuro */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .success-container {
            text-align: center;
            padding: 20px;
            border: 2px solid #c3e6cb;
            border-radius: 10px;
            background-color: #ffffff; /* Fondo blanco */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
        }
        .success-container h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        .success-container p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .success-container a {
            display: inline-block;
            text-decoration: none;
            font-size: 1.1em;
            color: #ffffff;
            background-color: #28a745; /* Verde Bootstrap */
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .success-container a:hover {
            background-color: #218838; /* Verde oscuro al pasar el mouse */
        }
        .success-icon {
            font-size: 4em;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">✔️</div>
        <h1>¡Compra Exitosa!</h1>
        <p>Ahora estás inscrito en el curso <strong><?php echo $tituloCurso; ?></strong>.</p>
        <p>¡Comienza tu aprendizaje ahora mismo!</p>
        <a href="CursoCom.php?id=<?php echo $idCurso; ?>">Ir al curso</a>
    </div>
</body>
</html>
