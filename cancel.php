<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Cancelada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8d7da; /* Fondo rojo claro */
            color: #721c24; /* Texto rojo */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .cancel-container {
            text-align: center;
            padding: 20px;
            border: 2px solid #f5c6cb;
            border-radius: 10px;
            background-color: #ffffff; /* Fondo blanco */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
        }
        .cancel-container h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        .cancel-container p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .cancel-container a {
            display: inline-block;
            text-decoration: none;
            font-size: 1.1em;
            color: #ffffff;
            background-color: #dc3545; /* Rojo Bootstrap */
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .cancel-container a:hover {
            background-color: #c82333; /* Rojo oscuro al pasar el mouse */
        }
        .cancel-icon {
            font-size: 4em;
            color: #dc3545;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="cancel-container">
        <div class="cancel-icon">❌</div>
        <h1>Compra Cancelada</h1>
        <p>Lamentamos que no hayas completado tu compra.<br> Si cambias de opinión, puedes intentarlo nuevamente.</p>
        <a href="inicio.php">Volver al inicio</a>
    </div>
</body>
</html>
