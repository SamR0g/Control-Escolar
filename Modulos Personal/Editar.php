<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    header("Location: ../Modulos Jefe Area/LogInJefe.php");
    exit;
}

// Verificar si se recibió la matrícula del alumno a editar
if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "controlescolar");

    // Verificar conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Establecer el conjunto de caracteres a utf8mb4
    mysqli_set_charset($conexion, "utf8mb4");

    // Consulta SQL para obtener los datos del alumno a editar
    $sql = "
        SELECT 
            a.Matricula, 
            a.NombreCompleto, 
            a.ApellidoPaterno, 
            a.ApellidoMaterno, 
            a.FechaNacimiento, 
            a.CorreoElectronico, 
            a.Edad, 
            a.CURP, 
            a.lugar_nacimiento, 
            g.semestre AS Semestre, 
            g.nombre_grupo AS Grupo, 
            g.turno AS Turno, 
            g.periodo_escolar AS periodo_escolar 
        FROM 
            alumnos a 
        LEFT JOIN 
            grupos g ON a.id_grupo = g.id_grupo 
        WHERE 
            a.Matricula='$matricula'
    ";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
    <link rel="stylesheet" href="../css/EditarAlumno.css">
</head>
<body>
    <div class="form-container">
        <h2>Editar Alumno</h2>
        <form action="actualizar_alumno.php" method="POST" onsubmit="return confirm('¿Estás seguro de editar el alumno?');">
            <input type="hidden" name="matricula" value="<?php echo $fila['Matricula']; ?>">
            <label for="nombreCompleto">Nombre Completo:</label>
            <input type="text" name="nombreCompleto" value="<?php echo $fila['NombreCompleto']; ?>" required><br>
            <label for="apellidoPaterno">Apellido Paterno:</label>
            <input type="text" name="apellidoPaterno" value="<?php echo $fila['ApellidoPaterno']; ?>" required><br>
            <label for="apellidoMaterno">Apellido Materno:</label>
            <input type="text" name="apellidoMaterno" value="<?php echo $fila['ApellidoMaterno']; ?>" required><br>
            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fechaNacimiento" value="<?php echo $fila['FechaNacimiento']; ?>" required><br>
            <label for="correoElectronico">Correo Electrónico:</label>
            <input type="email" name="correoElectronico" value="<?php echo $fila['CorreoElectronico']; ?>" required><br>
            <label for="edad">Edad:</label>
            <input type="number" name="edad" value="<?php echo $fila['Edad']; ?>" required><br>
            <label for="curp">CURP:</label>
            <input type="text" name="curp" value="<?php echo $fila['CURP']; ?>" required><br>
            <label for="lugarNacimiento">Lugar de Nacimiento:</label>
            <input type="text" name="lugarNacimiento" value="<?php echo $fila['lugar_nacimiento']; ?>" required><br>
            <label for="id_grupo">Grupo:</label>
            <select name="id_grupo" required>
                <?php
                // Obtener todos los grupos para el dropdown
                $grupos_sql = "SELECT id_grupo, nombre_grupo FROM grupos";
                $grupos_resultado = mysqli_query($conexion, $grupos_sql);
                while ($grupo = mysqli_fetch_assoc($grupos_resultado)) {
                    $selected = $grupo['id_grupo'] == $fila['id_grupo'] ? 'selected' : '';
                    echo "<option value='{$grupo['id_grupo']}' $selected>{$grupo['nombre_grupo']}</option>";
                }
                ?>
            </select><br>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        echo "Alumno no encontrado.";
    }

    // Cerrar conexión
    mysqli_close($conexion);
} else {
    echo "No se recibió la matrícula del alumno.";
}
?>
