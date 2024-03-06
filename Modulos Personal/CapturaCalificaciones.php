<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Calificaciones</title>
    <link rel="stylesheet" href="../css/CapturaCalificacion.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Calificaciones</h2>
        <form action="../php/CapturarCalificaciones.php" method="post">
            <div class="form-group">
                <label for="id_materia">ID Materia:</label>
                <input type="text" id="id_materia" name="id_materia" required>
            </div>
            <div class="form-group">
    <label for="materia">Materia:</label>
    <input type="text" id="materia" name="materia" required>
</div>
            <div class="form-group">
                <label for="calificacion">Calificación:</label>
                <input type="number" id="calificacion" name="calificacion" min="0" max="100" required>
            </div>
            <div class="form-group">
                <label for="asistencia">Asistencia:</label>
                <input type="number" id="asistencia" name="asistencia" min="0" max="100" required>
            </div>
            <div class="form-group">
                <label for="matricula">Matrícula del Alumno:</label>
                <input type="text" id="matricula" name="matricula" required>
            </div>
            <button type="submit">Guardar</button>
        </form>
    </div>
</body>
</html>
