<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captura de Horarios</title>
    <link rel="stylesheet" href="HorarioValidacion.css">
</head>
<body>
    <h1>Captura de Horarios</h1>

    <?php
    // Configuración de la conexión a la base de datos
    $servidor = "localhost";
    $usuario = "root"; // Cambiar por tu nombre de usuario de MySQL
    $contrasena = ""; // Cambiar por tu contraseña de MySQL
    $basedatos = "controlescolar"; // Cambiar por el nombre de tu base de datos

    // Conexión a la base de datos
    $conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);

    // Verificar la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Consulta para obtener las materias desde la base de datos
    $materiasQuery = "SELECT id_materia, nombre_materia FROM materias";
    $materiasResult = mysqli_query($conexion, $materiasQuery);

    if (!$materiasResult) {
        die("Error en la consulta de materias: " . mysqli_error($conexion));
    }
    ?>

    <form id="horarioForm" method="post">
        <label for="materia">Materia:</label>
        <select id="materia" name="materia" required>
            <option value="">Seleccione una materia</option>
            <?php
            // Mostrar las materias en el selector de lista
            while ($row = mysqli_fetch_assoc($materiasResult)) {
                echo '<option value="' . $row['id_materia'] . '">' . $row['nombre_materia'] . '</option>';
            }
            ?>
        </select>
        
        <label for="grupo">Grupo:</label>
        <select id="grupo" name="grupo" required>
            <option value="">Seleccione un grupo</option>
            <?php
            // Consulta para obtener los grupos desde la base de datos
            $gruposQuery = "SELECT id_grupo, nombre_grupo FROM grupos";
            $gruposResult = mysqli_query($conexion, $gruposQuery);

            if (!$gruposResult) {
                die("Error en la consulta de grupos: " . mysqli_error($conexion));
            }

            // Mostrar los grupos en el selector de lista
            while ($row = mysqli_fetch_assoc($gruposResult)) {
                echo '<option value="' . $row['id_grupo'] . '">' . $row['nombre_grupo'] . '</option>';
            }
            ?>
        </select>
        
        <label for="docente">Docente:</label>
        <input type="text" id="docente" name="docente" required>
        
        <div id="horarios">
            <label for="lunes">Lunes:</label>
            <input type="text" id="lunes" name="lunes">
            
            <label for="martes">Martes:</label>
            <input type="text" id="martes" name="martes">
            
            <label for="miércoles">Miércoles:</label>
            <input type="text" id="miércoles" name="miércoles">
            
            <label for="jueves">Jueves:</label>
            <input type="text" id="jueves" name="jueves">
            
            <label for="viernes">Viernes:</label>
            <input type="text" id="viernes" name="viernes">
            
            <label for="sábado">Sábado:</label>
            <input type="text" id="sábado" name="sábado">
        </div>
        
        <button type="submit">Agregar Horario</button>
    </form>

    <div id="horariosCapturados">
        <!-- Aquí se mostrarán los horarios capturados -->
    </div>

    <script src="script.js"></script>
</body>
</html>
