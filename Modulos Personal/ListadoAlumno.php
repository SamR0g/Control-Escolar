<?php
session_start();

// Verificar si el alumno ha iniciado sesión
if (!isset($_SESSION['ID'])) {
    // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header("Location: ../Modulos Personal/LogInPersonal.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Alumnos</title>
    <link rel="stylesheet" href="../css/ListadoAlumnos.css">
</head>
<body>
    <h2>Lista de Alumnos de Primer Semestre</h2>
    
    <!-- Tabla de alumnos -->
    <table>
        <tr>
            <th>Matrícula</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha Nacimiento</th>
            <th>Correo Electrónico</th>
            <th>Semestre</th>
            <th>Grupo</th>
            <th>Turno</th>
            <th>Periodo Escolar</th>
            <th>CURP</th>
            <th>Lugar Nacimiento</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "controlescolar");
        // Verificar conexión
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Establecer el conjunto de caracteres a utf8mb4
        mysqli_set_charset($conexion, "utf8mb4");

        // Consulta SQL para obtener todos los alumnos de primer semestre
$consulta = "
SELECT 
    a.Matricula, 
    a.NombreCompleto, 
    a.ApellidoPaterno, 
    a.ApellidoMaterno, 
    a.FechaNacimiento, 
    a.CorreoElectronico, 
    g.semestre AS Semestre, 
    g.nombre_grupo AS Grupo, 
    g.turno AS Turno, 
    g.periodo_escolar AS periodo_escolar, 
    a.CURP, 
    a.lugar_nacimiento
FROM 
    alumnos a
LEFT JOIN 
    grupos g ON a.id_grupo = g.id_grupo
WHERE 
    g.semestre = '1'
";

$resultado = mysqli_query($conexion, $consulta);

        // Mostrar resultados en la tabla
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['Matricula'] . "</td>";
                echo "<td>" . $fila['NombreCompleto'] . "</td>";
                echo "<td>" . $fila['ApellidoPaterno'] . "</td>";
                echo "<td>" . $fila['ApellidoMaterno'] . "</td>";
                echo "<td>" . $fila['FechaNacimiento'] . "</td>";
                echo "<td>" . $fila['CorreoElectronico'] . "</td>";
                echo "<td>" . (isset($fila['Semestre']) ? $fila['Semestre'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Grupo']) ? $fila['Grupo'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['Turno']) ? $fila['Turno'] : 'N/A') . "</td>";
                echo "<td>" . (isset($fila['periodo_escolar']) ? $fila['periodo_escolar'] : 'N/A') . "</td>";
                echo "<td>" . $fila['CURP'] . "</td>";
                echo "<td>" . $fila['lugar_nacimiento'] . "</td>";
                echo "<td>";
                echo "<div class='btn-group'>";
                echo "<a class='edit-btn' href='./Editar.php?matricula=" . $fila['Matricula'] . "'>Editar</a>";
                echo "<a class='delete-btn' href='./Eliminar.php?matricula=" . $fila['Matricula'] . "'>Eliminar</a>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='14'>No se encontraron alumnos de primer semestre.</td></tr>";
        }

        // Cerrar conexión
        mysqli_close($conexion);
        ?>
    </table>

    <!-- Script para mostrar/ocultar formulario -->
    <script>
        document.getElementById('showFormBtn').addEventListener('click', function() {
            var form = document.getElementById('agregarAlumnoForm');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    </script>
</body>
</html>
