<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Curso - OmIso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="altacurso.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Nuevo Curso</h1>

        <!-- Formulario que envía los datos a 00guardar_curso.php -->
        <form id="nuevoCursoForm" action="00guardar_curso.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título del curso" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción del curso" required></textarea>
            </div>

            <div class="mb-3 d-flex">
                <div class="me-3">
                    <label for="costo" class="form-label">Costo</label>
                    <input type="number" class="form-control" id="costo" name="costo" placeholder="Costo del curso" required>
                </div>
                <div>
                    <label for="niveles" class="form-label">Número de Niveles</label>
                    <input type="number" class="form-control" id="niveles" name="niveles" value="0" readonly>
                </div>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Cargar Imagen</label>
                <input class="form-control" type="file" id="imagen" name="imagen">
            </div>

            <!-- Niveles dinámicos -->
            <div id="nivelesContainer"></div>

            <div class="mb-3 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" onclick="agregarNiveles()">Agregar Nivel</button>
            </div>

            <div class="mb-3">
                <label for="recursos" class="form-label">Recursos</label>
                <input class="form-control" type="file" id="recursos" name="recursos">
            </div>

            <!-- Botones de Guardar y Cancelar -->
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" id="btnCancelar">Cancelar</button>
                <button type="submit" class="btn btn-success" id="btnGuardar">Guardar Curso</button>
            </div>
        </form>
    </div>

    <script src="altacurso.js"></script>
</body>
</html>
