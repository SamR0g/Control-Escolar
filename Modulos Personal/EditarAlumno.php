<?php

session_start();

// Verificar si el alumno ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../Modulos Personal/LogInPersonal.php");
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

    // Consulta SQL para obtener los datos del alumno a editar
    $sql = "SELECT * FROM alumnos WHERE Matricula='$matricula'";
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
        <form action="../php/EditarAlumno.php" method="POST">
            <!-- Cambio realizado: name="matricula" -> name="nuevaMatricula" -->
            <input type="hidden" name="matricula" value="<?php echo $fila['Matricula']; ?>">
            <label for="matricula">Matrícula:</label>
            <input type="text" name="nuevaMatricula" value="<?php echo $fila['Matricula']; ?>" readonly><br>
            <label for="nombreCompleto">Nombre Completo:</label>
            <input type="text" name="nombreCompleto" value="<?php echo $fila['NombreCompleto']; ?>"><br>
            <label for="apellidoPaterno">Apellido Paterno:</label>
            <input type="text" name="apellidoPaterno" value="<?php echo $fila['ApellidoPaterno']; ?>"><br>
            <label for="apellidoMaterno">Apellido Materno:</label>
            <input type="text" name="apellidoMaterno" value="<?php echo $fila['ApellidoMaterno']; ?>"><br>
            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fechaNacimiento" value="<?php echo $fila['FechaNacimiento']; ?>"><br>
            <label for="correoElectronico">Correo Electrónico:</label>
            <input type="email" name="correoElectronico" value="<?php echo $fila['CorreoElectronico']; ?>"><br>
            <label for="semestre">Semestre:</label>
            <input type="number" name="semestre" value="<?php echo $fila['Semestre']; ?>"><br>
            <label for="grupo">Grupo:</label>
            <input type="text" name="grupo" value="<?php echo $fila['Grupo']; ?>"><br>
            <label for="edad">Edad:</label>
            <input type="number" name="edad" value="<?php echo $fila['Edad']; ?>"><br>
            <label for="turno">Turno:</label>
            <input type="text" name="turno" value="<?php echo $fila['Turno']; ?>"><br>
            <label for="periodoEscolar">Periodo Escolar:</label>
            <input type="text" name="periodoEscolar" value="<?php echo $fila['periodo_escolar']; ?>"><br>
            <label for="curp">CURP:</label>
            <input type="text" name="curp" value="<?php echo $fila['CURP']; ?>"><br>
            <label for="lugarNacimiento">Lugar de Nacimiento:</label>
            <input type="text" name="lugarNacimiento" value="<?php echo $fila['lugar_nacimiento']; ?>"><br>
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
}
?>
