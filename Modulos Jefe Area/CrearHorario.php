<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Horarios</title>
    <link rel="stylesheet" href="../css/HorarioEstilo.css">
</head>
<body>
    <div class="container">
        <h2>Formulario de Horarios</h2>
        <form action="../php/guardar_horario.php" method="POST" class="form">
            <div class="form-group">
                <label for="nombre_materia">Materia</label>
                <select id="nombre_materia" name="nombre_materia">
                    <option value="">Selecciona una materia</option>
                    <?php
                    // Conexión a la base de datos
                    $conexion = mysqli_connect("localhost", "root", "", "controlescolar");

                    // Verificar la conexión
                    if (mysqli_connect_errno()) {
                        echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
                        exit();
                    }

                    // Establecer el conjunto de caracteres a UTF-8
                    mysqli_set_charset($conexion, "utf8");

                    // Consulta para obtener las materias desde la tabla materias
                    $query = "SELECT id_materia, nombre_materia FROM materias";
                    $result = mysqli_query($conexion, $query);

                    // Iterar sobre los resultados y mostrar las opciones
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_materia'] . '">' . $row['nombre_materia'] . '</option>';
                    }

                    // Cerrar la conexión
                    mysqli_close($conexion);
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="grupo">Grupo</label>
                <select id="grupo" name="grupo">
                    <option value="">Selecciona un grupo</option>
                    <?php
                    // Conexión a la base de datos
                    $conexion = mysqli_connect("localhost", "root", "", "controlescolar");

                    // Verificar la conexión
                    if (mysqli_connect_errno()) {
                        echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
                        exit();
                    }

                    // Establecer el conjunto de caracteres a UTF-8
                    mysqli_set_charset($conexion, "utf8");

                    // Consulta para obtener los grupos desde la tabla grupos
                    $query = "SELECT id_grupo, nombre_grupo FROM grupos";
                    $result = mysqli_query($conexion, $query);

                    // Iterar sobre los resultados y mostrar las opciones
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_grupo'] . '">' . $row['nombre_grupo'] . '</option>';
                    }

                    // Cerrar la conexión
                    mysqli_close($conexion);
                    ?>
                </select>
            </div>
            <!-- Los demás campos del formulario siguen igual -->
            <div class="form-group">
                <label for="Lunes">Lunes</label>
                <input type="text" id="Lunes" name="Lunes" placeholder="Horario del Lunes (ej. 08:00 - 10:00)">
            </div>
            <div class="form-group">
                <label for="Martes">Martes</label>
                <input type="text" id="Martes" name="Martes" placeholder="Horario del Martes (ej. 08:00 - 10:00)">
            </div>
            <div class="form-group">
                <label for="Miercoles">Miércoles</label>
                <input type="text" id="Miercoles" name="Miercoles" placeholder="Horario del Miércoles (ej. 08:00 - 10:00)">
            </div>
            <div class="form-group">
                <label for="Jueves">Jueves</label>
                <input type="text" id="Jueves" name="Jueves" placeholder="Horario del Jueves (ej. 08:00 - 10:00)">
            </div>
            <div class="form-group">
                <label for="Viernes">Viernes</label>
                <input type="text" id="Viernes" name="Viernes" placeholder="Horario del Viernes (ej. 08:00 - 10:00)">
            </div>
            <div class="form-group">
                <label for="Sabado">Sábado</label>
                <input type="text" id="Sabado" name="Sabado" placeholder="Horario del Sábado (ej. 08:00 - 10:00)">
            </div>
            <div class="form-group">
                <label for="docente">Docente *</label>
                <input type="text" id="docente" name="docente" placeholder="Docente" required>
            </div>
            <button type="submit" class="btn-submit">Guardar Horario</button>
        </form>
    </div>
</body>
</html>
