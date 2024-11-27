<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso - OmIso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="altacurso.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Editar Curso</h1>

        <form id="editarCursoForm" action="00EditarCurso.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="curso_id" name="curso_id"> <!-- Aquí se almacenará el curso ID -->

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
                    <label for="categoria" class="form-label">Categoría</label>
                    <select class="form-control" id="categoria" name="categoria" required>
                        <option value="" disabled selected>Seleccione una categoría</option>
                        <?php
                        // Conexión a la base de datos
                        include("00ConexionDB.php");

                        // Consulta para obtener las categorías
                        $query = "SELECT ID_CAT, NOMCAT FROM categoria";
                        $resultado = mysqli_query($conex, $query);

                        // Verificar si hay resultados
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo '<option value="' . htmlspecialchars($fila['ID_CAT']) . '">' . htmlspecialchars($fila['NOMCAT']) . '</option>';
                            }
                        } else {
                            echo '<option value="">No hay categorías disponibles</option>';
                        }

                        // Cerrar la conexión
                        mysqli_close($conex);
                        ?>
                    </select>

                </div>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Cargar Imagen</label>
                <input class="form-control" type="file" id="imagen" name="imagen">
            </div>

            <div id="nivelesContainer"></div>

            <div class="mb-3 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" id="agregarNivelBtn">Agregar Nivel</button>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" id="btnCancelar">Cancelar</button>
                <button type="submit" class="btn btn-success" id="btnGuardar">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <script src="editarcurso.js"></script>
</body>
</html>